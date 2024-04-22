<?php

require_once 'ContentController.php';
require_once __DIR__ . '/../forms/NewPostForm.php';

class NewPostController extends ContentController {

    public function createPost() {
        $form = NewPostForm::validate($attributes = [
            'url' => $_POST['url'],
            'title' => $_POST['title'],
            'category' => $_POST['category'],
            'price' => $_POST['price'],
            'oldPrice' => $_POST['old-price'],
            'deliveryPrice' => $_POST['delivery-price'],
            'endDate' => $_POST['end-date'],
            'description' => $_POST['description'],
            'file' => $_FILES['file']
        ]);
    }

    public function newPost() {
        $validationErrors = Session::get('validations');
        return $this->render('new-post', ['validations' => $validationErrors]);
    }
}
