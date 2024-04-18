<?php

require_once 'src/controllers/NotFoundController.php';
require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/FavouritesController.php';
require_once 'src/controllers/NewPostController.php';
require_once 'src/controllers/CategoryController.php';
require_once 'src/controllers/SearchController.php';

class Router {
    private static $routes;

    public static function get($uri, $controller)
    {
        self::$routes[$uri] = $controller;
    }

    public static function post($uri, $controller)
    {
        self::$routes[$uri] = $controller;
    }

    public static function run($uri) {
        $uriParts = explode("/", $uri);
        $action = $uriParts[0];

        if (!array_key_exists($action, self::$routes)) {
            $controller = new NotFoundController();
            http_response_code(400);
            $controller->renderNotFoundPage();
            die();
        }

        $controller = self::$routes[$action];
        $object = new $controller;
        $action = $action ?: 'index';

        $id = $uriParts[1] ?? '';

        $object->$action($id);
    }
}