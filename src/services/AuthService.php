<?php

require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../models/User.php';

class AuthService {
    
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function validateSignIn($username, $password) {
        $validationErrors = [];

        if (empty($username)) {
            $validationErrors['username'] = 'Username is required!';
        }
        if (empty($password)) {
            $validationErrors['password'] = 'Password is required!';
        }

        return $validationErrors;
    }

    public function signIn($username, $password) {
        $user = $this->userRepository->getUser($username);
        if (!$user || !password_verify($password, $user->getPassword())) {
            return false;
        }
        return $user;
    }

    public function validateSignUp($username, $email, $password, $confirmPassword) {
        $validationErrors = [];

        if (empty($username)) {
            $validationErrors['username'] = 'Username is required!';
        }
        if (empty($email)) {
            $validationErrors['email'] = 'Email is required!';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $validationErrors['email'] = 'Invalid email format!';
        }
        if (empty($password)) {
            $validationErrors['password'] = 'Password is required!';
        } elseif ($password !== $confirmPassword) {
            $validationErrors['confirm_password'] = 'Passwords do not match!';
        }

        return $validationErrors;
    }

    public function signUp($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user = new User(0, $username, $email, $hashedPassword);
        $createdUserId = $this->userRepository->createUser($user);
        $user->setId($createdUserId);
        return $user;
    }
}
