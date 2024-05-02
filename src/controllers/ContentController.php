<?php

require_once 'AppController.php';

require_once __DIR__ . '/../services/PostService.php';
require_once __DIR__ . '/../services/CategoryService.php';

class ContentController extends AppController {
    protected $categoryService;
    protected $postService;

    public function __construct() {
        parent::__construct();
        $this->categoryService = new CategoryService();
        $this->postService = new PostService();
    }

    protected function render(string $template = null, array $variables = []) {
        $variables['categories'] = $this->categoryService->getCategories();
        parent::render($template, $variables);
    }
}