<?php

require_once 'Guest.php';
require_once 'Authenticated.php';
require_once 'Admin.php';

class Middleware {
    public const MAP = [
        'guest' => Guest::class,
        'auth' => Authenticated::class,
        'admin' => Admin::class
    ];

    public static function resolve($key) {
        if (!$key) {
            return;
        }

        $middleware = static::MAP[$key] ?? false;

        if (!$middleware) {
            throw new Exception("No matching middleware found for key '{$key}'.");
        }

        (new $middleware)->handle();
    }
}