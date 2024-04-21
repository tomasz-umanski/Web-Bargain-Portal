<?php

require_once 'core/Session.php';

function old($key, $defaul = null) {
    return Session::get('old')[$key] ?? $default;
}

function userSessionExists() {
    return Session::has('user');
}