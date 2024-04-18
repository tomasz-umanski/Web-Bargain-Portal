<?php

require_once 'AppController.php';

class SearchController extends AppController {

    public function search($searchString) {
        $posts = $this->postRepository->getPostByQueryString($searchString);
        $this->render("search", ['searchInput' => $searchString, 'posts' => $posts]);
    }
}
