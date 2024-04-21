<?php

require_once 'core/Session.php';

class Authenticated {
    public function handle() {
        if (!Session::has('user')) {
            $url = "http://$_SERVER[HTTP_HOST]$path";
            header("Location: {$url}/signIn");
            exit();
        }
    }
}