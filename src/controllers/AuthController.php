<?php

require_once 'AppController.php';
require_once __DIR__ . '/../services/AuthService.php';
require_once __DIR__ . '/../../core/Session.php';

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

    public function login() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->authService->signIn($username, $password);
        if (!$user) {
            sleep(1);
            return $this->redirect('/signIn');
        }

        $this->authService->startSession($user);
        $this->redirect('/');
    }

    public function signIn() {
        $validationErrors = Session::get('validations');
        return $this->render('sign-in', ['validations' => $validationErrors]);
    }

    public function register() {
        $email = $_POST['email'] ?? '';
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        $user = $this->authService->signUp($username, $email, $password);
        if (!$user) {
            sleep(1);
            return $this->redirect('/signUp');
        }

        $this->authService->startSession($user);
        $this->redirect('/');
    }

    public function signUp() {
        $validationErrors = Session::get('validations');
        return $this->render('sign-up', ['validations' => $validationErrors]);
    }

    private function redirect($path) {
        $url = "http://$_SERVER[HTTP_HOST]$path";
        header("Location: {$url}");
        exit();
    }
}