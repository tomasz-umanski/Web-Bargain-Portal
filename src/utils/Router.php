<?php

require_once 'src/controllers/NotFoundController.php';
require_once 'src/controllers/HomeController.php';
require_once 'src/controllers/FavouritesController.php';
require_once 'src/controllers/NewPostController.php';
require_once 'src/controllers/CategoryController.php';
require_once 'src/controllers/SearchController.php';
require_once 'src/controllers/AuthController.php';
require_once 'src/controllers/ContentController.php';
require_once 'src/controllers/AdminPanelController.php';
require_once 'middleware/Middleware.php';

class Router {
    protected $routes = [];

    public function add($method, $uri, $controller, $middleware) {
        $this->routes[$method][$uri] = [
            'controller' => $controller,
            'middleware' => $middleware
        ];
        return $this;
    }

    public function get($uri, $controller, $middleware = null) {
        return $this->add('GET', $uri, $controller, $middleware);
    }

    public function post($uri, $controller, $middleware = null) {
        return $this->add('POST', $uri, $controller, $middleware);
    }

    public function delete($uri, $controller, $middleware = null) {
        return $this->add('DELETE', $uri, $controller, $middleware);
    }

    public function previousUrl() {
        return $_SERVER['HTTP_REFERER'];
    }

    public function run($uri, $method) {
        $action = explode("/", $uri)[0];
        $route = $this->routes[$method][$action];
        $controllerName = $route['controller'];
        if (!class_exists($controllerName)) {
            $controller = NotFoundController::getInstance();
            http_response_code(404);
            $controller->renderNotFoundPage();
            die();
        }

        Middleware::resolve($route['middleware']);
        $controller = $controllerName::getInstance();
        $action = $action ?: 'index';
        $id = explode("/", $uri)[1] ?? '';
        $controller->$action($id);
    } 
}
