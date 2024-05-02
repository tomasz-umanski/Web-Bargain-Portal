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

    public function getPostByQueryString(string $searchString): array {
        $result = [];
        $searchString = '%' . strtolower($searchString) . '%';
        $query = $this->database->connect()->prepare('
            SELECT p.*, u.user_name
            FROM post p
            JOIN users u ON p.user_id = u.id
            WHERE p.end_date > NOW() AND (LOWER(p.title) LIKE :search OR LOWER(p.description) LIKE :search)
            ORDER BY p.end_date ASC;
        ');
        $query->bindParam(':search', $searchString, PDO::PARAM_STR);
        $query->execute();

        $posts = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($posts as $post) {
            $result[] = $this->createPostFromData($post);
        }

        return $result;
    }
}