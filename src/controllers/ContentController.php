<?php

require_once 'AppController.php';

require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../repository/CategoryRepository.php';
require_once __DIR__ . '/../services/PostService.php';

class ContentController extends AppController {
    protected $categoryRepository;
    protected $postService;

    public function __construct() {
        parent::__construct();
        $this->categoryRepository = new CategoryRepository();
        $this->postService = new PostService();
    }

    protected function render(string $template = null, array $variables = []) {
        $categories = $this->categoryRepository->getCategories();
        $variables['categories'] = $categories;
        parent::render($template, $variables);
    }
}