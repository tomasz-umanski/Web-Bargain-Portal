<?php

require_once 'AppController.php';

class CategoryController extends AppController {

    public function category($url) {
        $selectedCategory = $this->categoryRepository->getCategoryByUrl($url);
        $this->render("category", ['selectedCategory' => $selectedCategory]);
    }
}
