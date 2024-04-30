<?php

require_once 'Session.php';

function old($key, $defaul = null) {
    return Session::get('old')[$key] ?? $default;
}

function getFromSession($key) {
    return Session::get($key);
}

function userSessionExists() {
    return Session::has('user');
}

function redirect($path) {
    $url = "http://$_SERVER[HTTP_HOST]$path";
    header("Location: {$url}");
    exit();
}

function getUri($path) {
    $uri = trim($path, '/');
    return parse_url($uri, PHP_URL_PATH);
}

function alert($alertMessage) {
    $code = "<script>alert('$alertMessage');</script>";
    echo $code;
} 