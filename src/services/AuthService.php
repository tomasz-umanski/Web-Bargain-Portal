<?php

require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../models/User.php';

class AuthService {
    
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();;
    }

    public function signIn($username, $password) {
        $user = $this->userRepository->getUser($username);
        if (!$user || !password_verify($password, $user->getPassword())) {
            return false;
        }
        return $user;
    }

    public function signUp($username, $email, $password) {
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
        $createdUserId = $this->userRepository->createUser($user);
        $user->setId($createdUserId);
        return $user;
    }

    public function startSession($user) {
        $_SESSION['user'] = [
            'id' => $user->getId(),
            'email' => $user->getEmail()
        ];
        session_regenerate_id(true);
    }

    public function logout() {
        $_SESSION = [];
        session_destroy();
        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
}
