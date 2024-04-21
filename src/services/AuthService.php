<?php

require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../../core/Session.php';

class AuthService {
    
    private $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();;
    }

    public function signIn($username, $password) {
        Session::flash('old', [
            'username' => $username,
            'password' => $password
        ]);
        $user = $this->userRepository->getUser($username);
        if (!$user || !password_verify($password, $user->getPassword())) {
            $validationErrors['userNotExists'] = 'User not found or wrong password!';
            Session::flash('validations', $validationErrors);
            return false;
        }
        return $user;
    }

    public function signUp($username, $email, $password) {
        Session::flash('old', [
            'username' => $username,
            'password' => $password,
            'confirmPassword' => $password,
            'email' => $email
        ]);
        $userNameExists = $this->userRepository->userNameExists($username);
        if ($userNameExists) {
            $validationErrors['userNameExists'] = 'User with this username already exists!';
            Session::flash('validations', $validationErrors);
            return false;
        } 
        $emailExists = $this->userRepository->emailExists($email);
        if ($emailExists) {
            $validationErrors['emailExists'] = 'User with this email already exists!';
            Session::flash('validations', $validationErrors);
            return false;
        }
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user = new User(0, $username, $email, $hashedPassword);
        $createdUserId = $this->userRepository->createUser($user);
        $user->setId($createdUserId);
        return $user;
    }

    public function startSession($user) {
        Session::startUserSession($user);
    }

    public function logout() {
        Session::destroy();
    }
}
