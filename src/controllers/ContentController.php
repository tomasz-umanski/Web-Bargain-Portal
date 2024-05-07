<?php

require_once 'AppController.php';

require_once __DIR__ . '/../services/PostService.php';
require_once __DIR__ . '/../services/CategoryService.php';

class ContentController extends AppController {
    private static $instance = null;
    protected $categoryService;
    protected $postService;

    protected function __construct() {
        parent::__construct();
        $this->categoryService = new CategoryService();
        $this->postService = new PostService();
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new ContentController();
        }
        return self::$instance;
    }

    public function togglePostLike(int $postId) {
        $this->postService->togglePostLike($postId);
    }

    public function getPostLikeStatus(int $postId) {
        $this->postService->getPostLikeStatus($postId);
    }

    public function togglePostFavourite(int $postId) {
        $this->postService->togglePostFavourite($postId);
    }

    public function getPostFavouriteStatus(int $postId) {
        $this->postService->getPostFavouriteStatus($postId);
    }

    protected function render(string $template = null, array $variables = []) {
        $variables['categories'] = $this->categoryService->getCategories();
        parent::render($template, $variables);
    }
}