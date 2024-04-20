<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../services/AuthService.php';

class AuthController extends AppController {

    private $authService;

    public function __construct()
    {
        parent::__construct();
        $this->authService = new AuthService();
    }

    public function signIn() {
        if (!$this->isPost()) {
            return $this->render("sign-in");
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        $validationErrors = $this->authService->validateSignIn($username, $password);

        if (!empty($validationErrors)) {
            return $this->render('sign-in', ['validations' => $validationErrors]);
        }

        $user = $this->authService->signIn($username, $password);
        if (!$user) {
            $validationErrors['userExists'] = 'User not found or wrong password!';
            return $this->render('sign-in', ['validations' => $validationErrors]);
        }

        $this->startSession($user);
        $this->redirect('/');
    }

    public function signUp() {
        if (!$this->isPost()) {
            return $this->render("sign-up");
        }

        $email = $_POST['email'];
        $userName = $_POST['username'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

        $validationErrors = $this->authService->validateSignUp($userName, $email, $password, $confirmPassword);

        if (!empty($validationErrors)) {
            return $this->render('sign-up', ['validations' => $validationErrors]);
        }

        $user = $this->authService->signUp($userName, $email, $password);
        $this->startSession($user);
        $this->redirect('/');
    }

    private function startSession($user) {
        $_SESSION['user'] = [
            'id' => $user->getId(),
            'email' => $user->getEmail()
        ];
    }

    private function redirect($path) {
        $url = "http://$_SERVER[HTTP_HOST]$path";
        header("Location: {$url}");
        exit();
    }
}
