<?php

require_once 'AppController.php';
require_once __DIR__ . '/../services/AuthService.php';
require_once __DIR__ . '/../utils/Session.php';
require_once __DIR__ . '/../forms/LoginForm.php';
require_once __DIR__ . '/../forms/RegisterForm.php';

class AuthController extends AppController {
    private $authService;

    public function __construct()
    {
        parent::__construct();
        $this->authService = new AuthService();
    }

    public function login() {
        $form = LoginForm::validate($attributes = [
            'username' => $_POST['username'],
            'password' => $_POST['password'],
        ]);

        $signedIn = $this->authService->signInAttempt(
            $attributes['username'], $attributes['password']
        );

        if(!$signedIn) {
            sleep(1);
            $form->error(
                'auth', 'No matching account found.'
            )->throw();
        }

        redirect('/');
    }

    public function signIn() {
        $validationErrors = Session::get('validations');
        return $this->render('sign-in', ['validations' => $validationErrors]);
    }

    public function register() {
        $form = RegisterForm::validate($attributes = [
            'email' => $_POST['email'],
            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'confirmPassword' => $_POST['confirm_password'],
        ]);

        $signedUp = $this->authService->signUpAttempt(
            $attributes['username'], $attributes['email'], $attributes['password']
        );

        if(!$signedUp) {
            sleep(1);
            $form->error(
                'auth', 'User with this email or username already exists.'
            )->throw();
        }

        redirect('/');
    }

    public function signUp() {
        $validationErrors = Session::get('validations');
        return $this->render('sign-up', ['validations' => $validationErrors]);
    }

    public function logout() {
        $this->authService->logout();
        redirect('/');
    }
}