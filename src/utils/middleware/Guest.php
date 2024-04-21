<?php

require_once __DIR__.'/../Session.php';


class Guest {
    public function handle() {
        if (Session::has('user')) {
            redirect("/");
        }
    }
}