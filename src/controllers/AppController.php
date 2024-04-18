<?php

require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../repository/CategoryRepository.php';

class AppController {
    protected $categoryRepository;

    public function __construct() {
        $this->categoryRepository = new CategoryRepository();
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
