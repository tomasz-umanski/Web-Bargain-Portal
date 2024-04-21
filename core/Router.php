<?php

require_once 'src/controllers/NotFoundController.php';
require_once 'src/controllers/HomeController.php';
require_once 'src/controllers/FavouritesController.php';
require_once 'src/controllers/NewPostController.php';
require_once 'src/controllers/CategoryController.php';
require_once 'src/controllers/SearchController.php';
require_once 'src/controllers/AuthController.php';
require_once 'core/middleware/Middleware.php';


class Router {
    protected $routes = [];

    public function add($method, $uri, $controller, $middleware = null) {
        $this->routes[$method][$uri] = [
            'controller' => $controller,
            'middleware' => $middleware
        ];
        return $this;

    }

    public function get($uri, $controller) {
        return $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller) {
        return $this->add('POST', $uri, $controller);
    }

    public function only($key) {
        $lastRoute = end($this->routes);
        $lastRouteKey = key($this->routes);
        $this->routes[$lastRouteKey][array_key_last($lastRoute)]['middleware'] = $key;
        return $this;
    }

    public function run($uri, $method) {
        $action = explode("/", $uri)[0];
        $route = $this->routes[$method][$action];
        $controllerName = $route['controller'] ?? NotFoundController::class;
        
        if (!class_exists($controllerName)) {
            $controllerName = NotFoundController::class;
            http_response_code(404);
        }

        Middleware::resolve($route['middleware']);
        // $middleware = $route['middleware'] ?? null;
        // if ($middleware == 'auth') {
        //     if (!isset($_SESSION['user'])) {
        //         $url = "http://$_SERVER[HTTP_HOST]$path";
        //         header("Location: {$url}/signIn");
        //         exit();
        //     }
        // }
        $controller = new $controllerName();
        $action = $action ?: 'index';
        $id = explode("/", $uri)[1] ?? '';
        $controller->$action($id);
    } 
}
