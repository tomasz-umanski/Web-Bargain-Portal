<?php

require_once 'Form.php';
require_once __DIR__ . '/../utils/Validator.php';

class LoginForm extends Form { 

    public function __construct($attributes) {
        parent::__construct($attributes);

        if (!Validator::string($attributes['username'])) {
            $this->errors['username'] = 'Field is required.';
        }
        
        if (!Validator::string($attributes['password'])) {
            $this->errors['password'] = 'Password is required.';
        }
    }
}