<?php

require_once 'ContentController.php';
require_once __DIR__ . '/../forms/NewPostForm.php';
require_once __DIR__ . '/../services/FileService.php';
require_once __DIR__ . '/../services/PostService.php';

class NewPostController extends ContentController {
    private static $instance = null;

    private function __construct() {
        parent::__construct();
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new NewPostController();
        }
        return self::$instance;
    }

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

        $fileName = FileService::moveUploadedFile($attributes['file']);

        if (!$fileDestination) {
            $form->error(
                'file', "Can't move uploaded file."
            )->throw();
        }
        
        $this->postService->createPostAttempt(
            $attributes['url'],
            $attributes['title'],
            $attributes['category'],
            $attributes['price'],
            $attributes['oldPrice'],
            $attributes['deliveryPrice'],
            $attributes['endDate'],
            $attributes['description'],
            $fileName
        );

        redirect('/');
    }
    
    public function newPost() {
        $validationErrors = Session::get('validations');
        return $this->render('new-post', ['validations' => $validationErrors]);
    }
}
