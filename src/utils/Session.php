<?php

class Session {

    public static function has($key) {
        return isset($_SESSION[$key]);
    }

    public static function userHasRole($role) {
        $user = self::get('user');
        return isset($user['role']) && $user['role'] === $role;
    }

    public static function put($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function get($key, $default = null) {
        return $_SESSION['_flash'][$key] ?? $_SESSION[$key] ?? $default;
    }

    public static function flash($key, $value) {
        $_SESSION['_flash'][$key] = $value;
    }

    public static function unflash() {
        unset($_SESSION['_flash']);
    }

    public static function flush() {
        $_SESSION = [];
    }

    public static function startUserSession($user) {
        self::put('user', [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'username' => $user->getUserName(),
            'role' => $user->getRole(),
        ]);
        session_regenerate_id(true);
    }

    public static function destroy() {
        self::flush();
        session_destroy();
        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
}