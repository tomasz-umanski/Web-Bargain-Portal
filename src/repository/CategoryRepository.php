<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Category.php';

class CategoryRepository extends Repository {

    private function fetchCategoriesByQuery(string $query): array {
        $result = [];
        $statement = $this->database->connect()->prepare($query);
        $statement->execute();
        $categories = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($categories as $category) {
            $result[] = $this->createCategoryFromData($category);
        }

        return $result;
    }

    private function createCategoryFromData(array $category): Category {
        return new Category(
            $category['id'],
            $category['name'],
            $category['url'],
            $category['icon']
        );
    }

    public function getCategories(): array {
        $query = '
            SELECT *
            FROM category c;
        ';
        return $this->fetchCategoriesByQuery($query);
    }

    public function getCategoryByUrl($url): ?Category {
        $query = '
            SELECT *
            FROM category
            WHERE url = :url;
        ';

        $statement = $this->database->connect()->prepare($query);
        $statement->bindParam(':url', $url, PDO::PARAM_STR);
        $statement->execute();
        $category = $statement->fetch(PDO::FETCH_ASSOC);

        if ($category === false) {
            return null;
        }

        return $this->createCategoryFromData($category);
    }
}