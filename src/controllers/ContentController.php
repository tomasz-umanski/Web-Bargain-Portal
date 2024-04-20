<?php

require_once 'AppController.php';

require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../repository/CategoryRepository.php';
require_once __DIR__ . '/../models/Post.php';
require_once __DIR__ . '/../repository/PostRepository.php';

class ContentController extends AppController {
    protected $categoryRepository;
    protected $postRepository;

    public function __construct() {
        parent::__construct();
        $this->categoryRepository = new CategoryRepository();
        $this->postRepository = new PostRepository();
    }

    protected function render(string $template = null, array $variables = []) {
        $categories = $this->categoryRepository->getCategories();
        $variables['categories'] = $categories;
        parent::render($template, $variables);
    }
}