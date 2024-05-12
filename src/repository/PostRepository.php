<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Post.php';
require_once __DIR__ . '/../models/PostDto.php';

class PostRepository extends Repository {

    public function createPost(Post $post) : void {
        $conn = $this->database->connect();
        $conn->beginTransaction();
        try {
            $statement = $conn->prepare('
                WITH inserted_post AS (
                    INSERT INTO public.post (
                        user_id, 
                        category_id, 
                        status, 
                        likes_count, 
                        end_date
                    )
                    VALUES (?, ?, ?, ?, ?)
                    RETURNING id
                )
                INSERT INTO public.post_details (
                    post_id, 
                    title, 
                    description, 
                    new_price, 
                    old_price, 
                    delivery_price, 
                    offer_url, 
                    image_url
                )
                SELECT 
                    inserted_post.id, 
                    ?, 
                    ?, 
                    ?, 
                    ?, 
                    ?, 
                    ?, 
                    ?
                FROM inserted_post
            ');

            $statement->execute([
                $post->getUserId(),
                $post->getCategoryId(),
                $post->getStatus(),
                $post->getLikesCount(),
                $post->getEndDate()->format('Y-m-d H:i:s'),
                $post->getTitle(),
                $post->getDescription(),
                $post->getNewPrice(),
                $post->getOldPrice(),
                $post->getDeliveryPrice(),
                $post->getOfferUrl(),
                $post->getImageUrl()
            ]);

            $conn->commit();
        } catch (Exception $e) {
            var_dump($e);
            die();
            $conn->rollBack();
            throw new Exception("Error creating post: " . $e->getMessage());
        }
    }

    public function getHotPosts(): array {
        $query = "
            SELECT p.*, pd.title, pd.description, pd.new_price, pd.old_price, pd.delivery_price, pd.offer_url, pd.image_url, u.user_name, c.name AS category_name
            FROM post p
            JOIN post_details pd ON p.id = pd.post_id
            JOIN users u ON p.user_id = u.id
            JOIN category c ON p.category_id = c.id
            WHERE p.end_date > NOW() AND p.status = 'active'
            ORDER BY p.likes_count DESC;
        ";
        return $this->fetchPostsByQuery($query);
    }

    public function getNewPosts(): array {
        $query = "
            SELECT p.*, pd.title, pd.description, pd.new_price, pd.old_price, pd.delivery_price, pd.offer_url, pd.image_url, u.user_name, c.name AS category_name
            FROM post p
            JOIN post_details pd ON p.id = pd.post_id
            JOIN users u ON p.user_id = u.id
            JOIN category c ON p.category_id = c.id
            WHERE p.end_date > NOW() AND p.status = 'active'
            ORDER BY p.creation_date DESC;
        ";
        return $this->fetchPostsByQuery($query);
    }

    public function getLastCallPosts(): array {
        $query = "
            SELECT p.*, pd.title, pd.description, pd.new_price, pd.old_price, pd.delivery_price, pd.offer_url, pd.image_url, u.user_name, c.name AS category_name
            FROM post p
            JOIN post_details pd ON p.id = pd.post_id
            JOIN users u ON p.user_id = u.id
            JOIN category c ON p.category_id = c.id
            WHERE p.end_date > NOW() AND p.status = 'active'
            ORDER BY p.end_date ASC;
        ";
        return $this->fetchPostsByQuery($query);
    }

    public function getPostsByCategory($categoryId): ?array {
        $query = $this->database->connect()->prepare("
            SELECT p.*, pd.title, pd.description, pd.new_price, pd.old_price, pd.delivery_price, pd.offer_url, pd.image_url, u.user_name, c.name AS category_name
            FROM post p
            JOIN post_details pd ON p.id = pd.post_id
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

    public function changePostStatus(int $postId, string $lastUpdated, string $status): bool {
        $pdo = $this->database->connect();

        $stmt = $pdo->prepare("
            SELECT update_post_status(:post_id, :last_updated, :status) AS result
        ");
        $stmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
        $stmt->bindParam(':last_updated', $lastUpdated, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return (bool)$result['result'];
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
            SELECT p.*, pd.title, pd.description, pd.new_price, pd.old_price, pd.delivery_price, pd.offer_url, pd.image_url, u.user_name, c.name AS category_name
            FROM post p
            JOIN post_details pd ON p.id = pd.post_id
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
            SELECT p.*, pd.title, pd.description, pd.new_price, pd.old_price, pd.delivery_price, pd.offer_url, pd.image_url, u.user_name, c.name AS category_name
            FROM post p
            JOIN post_details pd ON p.id = pd.post_id
            JOIN users u ON p.user_id = u.id
            JOIN category c ON p.category_id = c.id
            WHERE p.end_date > NOW() AND p.status = 'active' AND (LOWER(pd.title) LIKE :search OR LOWER(pd.description) LIKE :search)
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

    public function getPostsToApprove() {
        $query = "
            SELECT p.*, pd.title, pd.description, pd.new_price, pd.old_price, pd.delivery_price, pd.offer_url, pd.image_url, u.user_name, c.name AS category_name
            FROM post p
            JOIN post_details pd ON p.id = pd.post_id
            JOIN users u ON p.user_id = u.id
            JOIN category c ON p.category_id = c.id
            WHERE p.end_date > NOW() AND p.status = 'pending'
            ORDER BY p.likes_count DESC;
        ";
        return $this->fetchPostsByQuery($query);
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
            $post['status'],
            $post['last_updated']
        );
    }
}