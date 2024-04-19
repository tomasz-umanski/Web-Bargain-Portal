<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class AuthenticationController extends AppController {

    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function signIn() {
        if (!$this->isPost()) {
            return $this->render("sign-in");
        }

        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $user = $this->userRepository->getUser($email);

        if (!$user) {
            return $this->render('sign-in', ['validations' => ['User not found!']]);
        }

        if ($user->getPassword() !== $password) {
            return $this->render('sign-in', ['validations' => ['Wrong password!']]);
        }
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/");
    }

    public function signUp() {
        $this->render("sign-up");
    }
}
