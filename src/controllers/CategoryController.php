<?php

require_once 'AppController.php';

class CategoryController extends AppController {

    public function category($url) {
        $selectedCategory = $this->categoryRepository->getCategoryByUrl($url);
        $posts = $this->postRepository->getPostsByCategory($selectedCategory->getId());
        $this->render("category", ['selectedCategory' => $selectedCategory, 'posts' => $posts]);
    }
}
