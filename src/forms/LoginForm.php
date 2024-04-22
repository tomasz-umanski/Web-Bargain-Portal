<?php

require_once 'Form.php';
require_once __DIR__ . '/../utils/Validator.php';

class LoginForm extends Form { 

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validateUsername($attributes['username']);
        $this->validatePassword($attributes['password']);
    }

    private function validateUsername($username) {
        if (!Validator::string($username)) {
            $this->errors['username'] = 'Username is required.';
        }
    }

    private function validatePassword($password) {
        if (!Validator::string($password)) {
            $this->errors['password'] = 'Password is required.';
        }
    }
}
