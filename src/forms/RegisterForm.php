<?php

require_once 'Form.php';
require_once __DIR__ . '/../utils/Validator.php';

class RegisterForm extends Form { 

    public function __construct($attributes) {
        parent::__construct($attributes);

        if (!Validator::string($attributes['email'])) {
            $this->errors['email'] = 'Email is required.';
        } else if (!Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Provide a valid email address.';
        }

        if (!Validator::string($attributes['username'])) {
            $this->errors['username'] = 'Username is required.';
        }
        
        if (!Validator::string($attributes['password'])) {
            $this->errors['password'] = 'Password is required.';
        } else if (!Validator::string($attributes['password'], 8)) {
            $this->errors['password'] = 'Password must be at least 8 characters.';
        }

        if (!Validator::string($attributes['confirmPassword'])) {
            $this->errors['confirmPassword'] = 'Confirm your password.';
        } else if ($attributes['password'] != $attributes['confirmPassword']) {
            $this->errors['confirmPassword'] = "Passwords don't match.";
        }
    }
}