<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Post.php';
require_once __DIR__ . '/../models/PostDto.php';

class PostRepository extends Repository {

    public function createPost(Post $post) : void {
        $statement = $this->database->connect()->prepare('
            INSERT INTO public.post (
                title, 
                description, 
                new_price, 
                old_price, 
                delivery_price, 
                likes_count, 
                offer_url, 
                image_url, 
                creation_date, 
                end_date, 
                user_id, 
                category_id, 
                status
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ');

        $statement->execute([
            $post->getTitle(),
            $post->getDescription(),
            $post->getNewPrice(),
            $post->getOldPrice(),
            $post->getDeliveryPrice(),
            $post->getLikesCount(),
            $post->getOfferUrl(),
            $post->getImageUrl(),
            $post->getCreationDate()->format('Y-m-d H:i:s'),
            $post->getEndDate()->format('Y-m-d H:i:s'),
            $post->getUserId(),
            $post->getCategoryId(),
            $post->getStatus()
        ]);
    }

    public function getHotPosts(): array {
        $query = "
            SELECT p.*, u.user_name, c.name AS category_name
            FROM post p
            JOIN users u ON p.user_id = u.id
            JOIN category c ON p.category_id = c.id
            WHERE p.end_date > NOW() AND p.status = 'active'
            ORDER BY p.likes_count DESC;
        ";
        return $this->fetchPostsByQuery($query);
    }

    public function getNewPosts(): array {
        $query = "
            SELECT p.*, u.user_name, c.name AS category_name
            FROM post p
            JOIN users u ON p.user_id = u.id
            JOIN category c ON p.category_id = c.id
            WHERE p.end_date > NOW() AND p.status = 'active'
            ORDER BY p.creation_date DESC;
        ";
        return $this->fetchPostsByQuery($query);
    }

    public function getLastCallPosts(): array {
        $query = "
            SELECT p.*, u.user_name, c.name AS category_name
            FROM post p
            JOIN users u ON p.user_id = u.id
            JOIN category c ON p.category_id = c.id
            WHERE p.end_date > NOW() AND p.status = 'active'
            ORDER BY p.end_date ASC;
        ";
        return $this->fetchPostsByQuery($query);
    }

    public function getPostsByCategory($categoryId): ?array {
        $query = $this->database->connect()->prepare("
            SELECT p.*, u.user_name, c.name AS category_name
            FROM post p
            JOIN users u ON p.user_id = u.id
            JOIN category c ON p.category_id = c.id
            WHERE p.end_date > NOW() AND p.status = 'active' AND (c.id = :category_id)
            ORDER BY p.end_date ASC;
        ");
        $query->bindParam(':category_id', $categoryId, PDO::PARAM_STR);
        $query->execute();

        $posts = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($posts as $post) {
            $result[] = $this->createPostFromData($post);
        }

        return $result;
    }

    public function togglePostLike(int $postId, string $userId): string {
        $pdo = $this->database->connect();
    
        $toggleStmt = $pdo->prepare("CALL toggle_post_like(:user_id, :post_id)");
        $toggleStmt->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $toggleStmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
        $toggleStmt->execute();
    
        return $this->getPostLikeStatus($postId, $userId) ? "liked" : "disliked";
    }
    
    public function getPostLikeStatus(int $postId, string $userId): bool {
        $pdo = $this->database->connect();
    
        $checkStmt = $pdo->prepare("
            SELECT EXISTS (
                SELECT 1
                FROM likes 
                WHERE user_id = :user_id AND post_id = :post_id
            ) as liked
        ");
        $checkStmt->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $checkStmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
        $checkStmt->execute();
        $row = $checkStmt->fetch(PDO::FETCH_ASSOC);
    
        return $row['liked'];
    }

    public function togglePostFavourite(int $postId, string $userId): string {
        $pdo = $this->database->connect();
    
        $toggleStmt = $pdo->prepare("CALL toggle_post_favourite(:user_id, :post_id)");
        $toggleStmt->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $toggleStmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
        $toggleStmt->execute();
    
        return $this->getPostFavouriteStatus($postId, $userId) ? "favourited" : "unfavourited";
    }
    
    public function getPostFavouriteStatus(int $postId, string $userId): bool {
        $pdo = $this->database->connect();
    
        $checkStmt = $pdo->prepare("
            SELECT EXISTS (
                SELECT 1
                FROM favourites 
                WHERE user_id = :user_id AND post_id = :post_id
            ) as favourited
        ");
        $checkStmt->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $checkStmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
        $checkStmt->execute();
        $row = $checkStmt->fetch(PDO::FETCH_ASSOC);
    
        return $row['favourited'];
    }

    public function getFavouritePosts($userId): array {
        $result = [];
        $query = $this->database->connect()->prepare("
            SELECT p.*, u.user_name, c.name AS category_name
            FROM post p
            JOIN users u ON p.user_id = u.id
            JOIN category c ON p.category_id = c.id
            INNER JOIN favourites f ON p.id = f.post_id
            WHERE p.end_date > NOW() AND p.status = 'active' AND f.user_id = :user_id
            ORDER BY p.end_date ASC;
        ");
        $query->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $query->execute();

        $posts = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($posts as $post) {
            $result[] = $this->createPostFromData($post);
        }

        return $result;
    }

    public function getPostByQueryString(string $searchString): array {
        $result = [];
        $searchString = '%' . strtolower($searchString) . '%';
        $query = $this->database->connect()->prepare("
            SELECT p.*, u.user_name, c.name AS category_name
            FROM post p
            JOIN users u ON p.user_id = u.id
            JOIN category c ON p.category_id = c.id
            WHERE p.end_date > NOW() AND p.status = 'active' AND (LOWER(p.title) LIKE :search OR LOWER(p.description) LIKE :search)
            ORDER BY p.likes_count DESC;
        ");
        $query->bindParam(':search', $searchString, PDO::PARAM_STR);
        $query->execute();

        $posts = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($posts as $post) {
            $result[] = $this->createPostFromData($post);
        }

        return $result;
    }

    private function fetchPostsByQuery(string $query): array {
        $result = [];
        $statement = $this->database->connect()->prepare($query);
        $statement->execute();
        $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($posts as $post) {
            $result[] = $this->createPostFromData($post);
        }

        return $result;
    }

    private function createPostFromData(array $post): PostDto {
        return new PostDto(
            $post['id'],
            $post['title'],
            $post['description'],
            $post['new_price'],
            $post['old_price'],
            $post['delivery_price'],
            $post['likes_count'],
            $post['offer_url'],
            $post['image_url'],
            $post['creation_date'],
            $post['end_date'],
            $post['user_name'],
            $post['category_name'],
            $post['status']
        );
    }
}