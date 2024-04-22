<?php

require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../utils/Session.php';

class AuthService {
    
    private $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();;
    }

    public function signInAttempt($username, $password) {
        $user = $this->userRepository->getUser($username);
        if (!$user || !password_verify($password, $user->getPassword())) {
            return false; 
        }
        Session::startUserSession($user);
        return true;
    }

    public function signUpAttempt($username, $email, $password) {
        $userNameExists = $this->userRepository->userNameExists($username);
        if ($userNameExists) {
            return false;
        } 
        $emailExists = $this->userRepository->emailExists($email);
        if ($emailExists) {
            return false;
        }
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user = new User(0, $username, $email, $hashedPassword);
        $this->userRepository->createUser($user);
        $user->setId($createdUserId);
        Session::startUserSession($user);
        return true;
    }

    public function logout() {
        Session::destroy();
    }
}
