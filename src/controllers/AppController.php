<?php

class AppController {

    private $categories;

    public function __construct() {
        $this->categories = [
            ["url" => "/category/technology", "name" => "Technology", "icon" => "bi bi-laptop"]
        ];
    }

    protected function render(string $template = null, array $variables = []) {
        $templatePath = 'public/views/'. $template.'.php';
        $output = 'File not found';

        $variables['categories'] = $this->categories;

        if(file_exists($templatePath)){
            extract($variables);
            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }
        print $output;
    }
}
