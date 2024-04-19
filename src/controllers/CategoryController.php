<?php

require_once 'AppController.php';

class CategoryController extends AppController {

    public function category($url) {
        $selectedCategory = $this->categoryRepository->getCategoryByUrl($url);
        if ($selectedCategory != null) {
            $posts = $this->postRepository->getPostsByCategory($selectedCategory->getId());
            $this->render("category", ['selectedCategory' => $selectedCategory, 'posts' => $posts]);
        } else {
            $this->render('not-found');
        }
    }
}
