<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Post.php';

class PostRepository extends Repository {
    private function fetchPostsByQuery(string $query): array {
        $result = [];
        $statement = $this->database->connect()->prepare($query);
        $statement->execute();
        $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($posts as $post) {
            $result[] = new Post(
                $post['title'],
                $post['description'],
                $post['old_price'],
                $post['new_price'],
                $post['delivery_price'],
                $post['likes_count'],
                $post['offer_url'],
                $post['image_url'],
                $post['creation_date'],
                $post['end_date'],
                $post['user_name']
            );
        }

        return $result;
    }

    public function getHotPosts(): array {
        $query = '
            SELECT p.*, u.name as user_name
            FROM post p
            JOIN users u ON p.created_by = u.id
            WHERE p.end_date > NOW()
            ORDER BY p.likes_count DESC;
        ';
        return $this->fetchPostsByQuery($query);
    }

    public function getNewPosts(): array {
        $query = '
            SELECT p.*, u.name as user_name
            FROM post p
            JOIN users u ON p.created_by = u.id
            WHERE p.end_date > NOW()
            ORDER BY p.creation_date DESC;
        ';
        return $this->fetchPostsByQuery($query);
    }

    public function getLastCallPosts(): array {
        $query = '
            SELECT p.*, u.name as user_name
            FROM post p
            JOIN users u ON p.created_by = u.id
            WHERE p.end_date > NOW()
            ORDER BY p.end_date ASC;
        ';
        return $this->fetchPostsByQuery($query);
    }

    public function getProjectByQueryString($searchString): array {
        $searchString = '%' . strtolower($searchString) . '%';
        $query = $this->database->connect()->prepare('
            SELECT p.*, u.name as user_name
            FROM post p
            JOIN users u ON p.created_by = u.id
            WHERE p.end_date > NOW() AND (LOWER(p.title) LIKE :search OR LOWER(p.description) LIKE :search)
            ORDER BY p.end_date ASC;
        ');
        $query->bindParam(':search', $searchString, PDO::PARAM_STR);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
