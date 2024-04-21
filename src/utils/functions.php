<?php

require_once 'Session.php';

function old($key, $defaul = null) {
    return Session::get('old')[$key] ?? $default;
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