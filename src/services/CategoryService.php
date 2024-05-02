<?php

require_once __DIR__ . '/../repository/CategoryRepository.php';
require_once __DIR__ . '/../models/Category.php';

class CategoryService {

    private $categoryRepository;
    
    public function __construct() {
        $this->categoryRepository = new CategoryRepository();
    }

    public function getCategories() {
        return $this->categoryRepository->getCategories();
    }

    public function getCategoryByUrl($url) {
        return $this->categoryRepository->getCategoryByUrl($url);
    }
}