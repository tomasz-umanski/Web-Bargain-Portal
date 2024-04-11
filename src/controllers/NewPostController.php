<?php

require_once 'AppController.php';

class NewPostController extends AppController {

    public function newPost() {
        $this->render("new-post");
    }
}
