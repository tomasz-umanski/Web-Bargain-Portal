<?php

require_once 'ContentController.php';

class SearchController extends ContentController {

    public function search($searchString) {
        $posts = $this->postRepository->getPostByQueryString($searchString);
        $this->render("search", ['searchInput' => $searchString, 'posts' => $posts]);
    }
}
