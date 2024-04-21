<?php

require_once 'AppController.php';
require_once __DIR__ . '/../services/AuthService.php';

class AuthController extends AppController {
    private $authService;

    public function __construct()
    {
        parent::__construct();
        $this->authService = new AuthService();
    }

    public function logout() {
        $this->authService->logout();
        $this->redirect('/');
    }

    public function signIn() {
        if (!$this->isPost()) {
            return $this->render("sign-in");
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->authService->signIn($username, $password);
        if (!$user) {
            sleep(1);
            $validationErrors['userNotExists'] = 'User not found or wrong password!';
            return $this->render('sign-in', ['validations' => $validationErrors]);
        }

        $this->authService->startSession($user);
        $this->redirect('/');
    }

    public function signUp() {
        if (!$this->isPost()) {
            return $this->render("sign-up");
        }

        $email = $_POST['email'] ?? '';
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        $user = $this->authService->signUp($username, $email, $password);
        if (!$user) {
            sleep(1);
            $validationErrors['userExists'] = 'User with this username or email already exists!';
            return $this->render('sign-up', ['validations' => $validationErrors]);
        }

        $this->authService->startSession($user);
        $this->redirect('/');
    }

    private function redirect($path) {
        $url = "http://$_SERVER[HTTP_HOST]$path";
        header("Location: {$url}");
        exit();
    }
}