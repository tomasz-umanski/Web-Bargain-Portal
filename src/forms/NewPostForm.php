<?php

require_once 'Form.php';
require_once __DIR__ . '/../utils/Validator.php';

class NewPostForm extends Form {

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validateUrl($attributes['url']);
        $this->validateTitle($attributes['title']);
        $this->validateCategory($attributes['category']);
        $this->validatePrice($attributes['price'], 'price');
        $this->validatePrice($attributes['oldPrice'], 'oldPrice');
        $this->validatePrice($attributes['deliveryPrice'], 'deliveryPrice');
        $this->validateEndDate($attributes['endDate']);
        $this->validateDescription($attributes['description']);
        $this->validateFile($attributes['file']);
    }

    private function validateUrl($url) {
        if (!Validator::string($url)) {
            $this->errors['url'] = 'Url is required.';
        } else if (!Validator::string($url, 1, 200)) {
            $this->errors['url'] = 'Url should not exceed 200 characters.';
        } else if (!Validator::url($url)) {
            $this->errors['url'] = 'Provide a valid url.';
        }
    }

    private function validateTitle($title) {
        if (!Validator::string($title)) {
            $this->errors['title'] = 'Title is required.';
        } else if (!Validator::string($title, 1, 100)) {
            $this->errors['title'] = 'Title should not exceed 100 characters.';
        }
    }

    private function validateCategory($category) {
        if (!Validator::string($category)) {
            $this->errors['category'] = 'Category is required.';
        }
    }

    private function validatePrice($price, $field) {
        if (!Validator::price($price, true, true)) {
            $this->errors[$field] = 'Price should be a positive numeric value with up to two decimal places and not exceed 10 million.';
        }
    }

    private function validateEndDate($endDate) {
        if (!Validator::date($endDate)) {
            $this->errors['endDate'] = 'Date should be in the future.';
        }
    }

    private function validateDescription($description) {
        if (!Validator::string($description)) {
            $this->errors['description'] = 'Description is required.';
        } else if (!Validator::string($description, 1, 500)) {
            $this->errors['description'] = 'Description should not exceed 500 characters.';
        }
    }

    private function validateFile($file) {
        if (!Validator::file($file)) {
            $this->errors['file'] = 'Please upload a valid image file (max 2MB).';
        }
    }
}
