<?php

require_once __DIR__.'/../Session.php';

class Authenticated {
    public function handle() {
        if (!Session::has('user')) {
            redirect("/signIn");
        }
    }
}