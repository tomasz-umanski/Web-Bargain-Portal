<?php

class Guest {
    public function handle() {
        if (isset($_SESSION['user'])) {
            $url = "http://$_SERVER[HTTP_HOST]$path";
            header("Location: {$url}/");
            exit();
        }
    }
}