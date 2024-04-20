<?php

require_once 'ContentController.php';

class NewPostController extends ContentController {

    public function newPost() {
        $this->render("new-post");
    }
}
