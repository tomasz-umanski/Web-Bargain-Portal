<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Post.php';

class PostRepository extends Repository {

    private function determineDeliveryPriceString($deliveryPrice): string {
        return ($deliveryPrice == 0) ? 'Free delivery' : $deliveryPrice . ' zł';
    }
    
    private function toDiffDateString($dateString): string {
        $date = new DateTime($dateString);
        $currentDate = new DateTime();
        $interval = $date->diff($currentDate);
        $totalHours = $interval->days * 24 + $interval->h;
        if ($interval->days > 0) {
            return "$interval->days d $interval->h h";
        } else {
            return "$totalHours h";
        }
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

    private function createPostFromData(array $post): Post {
        return new Post(
            $post['id'],
            $post['title'],
            $post['description'],
            $post['old_price'],
            $post['new_price'],
            $this->determineDeliveryPriceString($post['delivery_price']),
            $post['likes_count'],
            $post['offer_url'],
            $post['image_url'],
            $this->toDiffDateString($post['creation_date']),
            $this->toDiffDateString($post['end_date']),
            $post['user_name']
        );
    }

    public function getHotPosts(): array {
        $query = '
            SELECT p.*, u.user_name
            FROM post p
            JOIN users u ON p.user_id = u.id
            WHERE p.end_date > NOW()
            ORDER BY p.likes_count DESC;
        ';
        return $this->fetchPostsByQuery($query);
    }

    public function getNewPosts(): array {
        $query = '
            SELECT p.*, u.user_name
            FROM post p
            JOIN users u ON p.user_id = u.id
            WHERE p.end_date > NOW()
            ORDER BY p.creation_date DESC;
        ';
        return $this->fetchPostsByQuery($query);
    }

    public function getLastCallPosts(): array {
        $query = '
            SELECT p.*, u.user_name
            FROM post p
            JOIN users u ON p.user_id = u.id
            WHERE p.end_date > NOW()
            ORDER BY p.end_date ASC;
        ';
        return $this->fetchPostsByQuery($query);
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

    public function getPostsByCategory($categoryId): array {
        $result = [];
        $query = $this->database->connect()->prepare('
            SELECT p.*, u.user_name
            FROM post p
            JOIN users u ON p.user_id = u.id
            WHERE p.end_date > NOW() AND (p.category_id = :category_id)
            ORDER BY p.end_date ASC;
        ');
        $query->bindParam(':category_id', $categoryId, PDO::PARAM_STR);
        $query->execute();

        $posts = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($posts as $post) {
            $result[] = $this->createPostFromData($post);
        }

        return $result;
    }
}
