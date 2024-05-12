<?php

require_once __DIR__.'/../Session.php';

class Admin {
    public function handle() {
        if (!Session::has('user') || !Session::userHasRole('admin')) {
            redirect("/");
        }
    }
}