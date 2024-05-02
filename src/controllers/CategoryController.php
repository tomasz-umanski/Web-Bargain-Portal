<?php

require_once 'ContentController.php';

class CategoryController extends ContentController {
    private static $instance = null;

    private function __construct() {
        parent::__construct();
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new CategoryController();
        }
        return self::$instance;
    }

    public function category($url) {
        $selectedCategory = $this->categoryService->getCategoryByUrl($url);
        if ($selectedCategory != null) {
            $posts = $this->postService->getPostsByCategory($selectedCategory->getId());
            $this->render("category", ['selectedCategory' => $selectedCategory, 'posts' => $posts]);
        } else {
            $this->render('not-found');
        }
    }
}
