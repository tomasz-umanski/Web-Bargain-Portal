<?php

require_once 'src/controllers/NotFoundController.php';
require_once 'src/controllers/HomeController.php';
require_once 'src/controllers/FavouritesController.php';
require_once 'src/controllers/NewPostController.php';
require_once 'src/controllers/CategoryController.php';
require_once 'src/controllers/SearchController.php';
require_once 'src/controllers/AuthController.php';
require_once 'middleware/Middleware.php';

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

    public function delete($uri, $controller) {
        return $this->add('DELETE', $uri, $controller);
    }

    public function only($key) {
        $lastRoute = end($this->routes);
        $lastRouteKey = key($this->routes);
        $this->routes[$lastRouteKey][array_key_last($lastRoute)]['middleware'] = $key;
        return $this;
    }
    public function previousUrl() {
        return $_SERVER['HTTP_REFERER'];
    }

    public function run($uri, $method) {
        $action = explode("/", $uri)[0];
        $route = $this->routes[$method][$action];
        $controllerName = $route['controller'];
        
        if (!class_exists($controllerName)) {
            $controller = new NotFoundController();
            http_response_code(404);
            $controller->renderNotFoundPage();
            die();
        }

        Middleware::resolve($route['middleware']);
        $controller = new $controllerName();
        $action = $action ?: 'index';
        $id = explode("/", $uri)[1] ?? '';
        $controller->$action($id);
    } 
}
