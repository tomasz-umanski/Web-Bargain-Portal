<?php

require 'core/Router.php';

session_start();

$uri = trim($_SERVER['REQUEST_URI'], '/');
$uri = parse_url($uri, PHP_URL_PATH);
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router = new Router();
require 'routes.php';

$router->run($uri, $method);