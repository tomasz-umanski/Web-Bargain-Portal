<?php

require_once 'AppController.php';

class CategoryController extends AppController {

    public function category($id) {
        $categoryDetails = [
            "title" => "Technology"
        ];
        $this->render("category", ['categoryDetails' => $categoryDetails]);
    }
}
