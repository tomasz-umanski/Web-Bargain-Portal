<?php

require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../repository/CategoryRepository.php';
require_once __DIR__ . '/../models/Post.php';
require_once __DIR__ . '/../repository/PostRepository.php';

class AppController {
    private $request;
    protected $categoryRepository;
    protected $postRepository;

    public function __construct() {
        $this->request = $_SERVER['REQUEST_METHOD'];
        $this->categoryRepository = new CategoryRepository();
        $this->postRepository = new PostRepository();
    }

    protected function isGet(): bool {
        return $this->request === 'GET';
    }

    protected function isPost(): bool {
        return $this->request === 'POST';
    }

    protected function render(string $template = null, array $variables = []) {
        $templatePath = 'public/views/'. $template.'.php';
        $output = 'File not found';

        $categories = $this->categoryRepository->getCategories();
        $variables['categories'] = $categories;

        if(file_exists($templatePath)){
            extract($variables);
            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }
        print $output;
    }
}
