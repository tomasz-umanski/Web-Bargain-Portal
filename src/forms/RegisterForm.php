<?php

require_once 'Form.php';
require_once __DIR__ . '/../utils/Validator.php';

class RegisterForm extends Form { 

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validateEmail($attributes['email']);
        $this->validateUsername($attributes['username']);
        $this->validatePassword($attributes['password']);
        $this->validateConfirmPassword($attributes['password'], $attributes['confirmPassword']);
    }

    private function validateEmail($email) {
        if (!Validator::string($email)) {
            $this->errors['email'] = 'Email is required.';
        } else if (!Validator::email($email)) {
            $this->errors['email'] = 'Provide a valid email address.';
        }
    }

    private function validateUsername($username) {
        if (!Validator::string($username)) {
            $this->errors['username'] = 'Username is required.';
        } else if (!Validator::string($username, 3)) {
            $this->errors['username'] = 'Username must be at least 3 characters.';
        }
    }

    private function validatePassword($password) {
        if (!Validator::string($password)) {
            $this->errors['password'] = 'Password is required.';
        } else if (!Validator::string($password, 8)) {
            $this->errors['password'] = 'Password must be at least 8 characters.';
        }
    }

    private function validateConfirmPassword($password, $confirmPassword) {
        if (!Validator::string($confirmPassword)) {
            $this->errors['confirmPassword'] = 'Confirm your password.';
        } else if ($password != $confirmPassword) {
            $this->errors['confirmPassword'] = "Passwords don't match.";
        }
    }
}
