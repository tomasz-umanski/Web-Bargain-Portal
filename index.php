<?php

require 'src/utils/Router.php';
require_once 'src/utils/Session.php';
require_once 'src/utils/functions.php';

session_start();

$uri = getUri($_SERVER['REQUEST_URI']);
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router = new Router();
require 'config/routes.php';

try {
    $router->run($uri, $method);
} catch (ValidationException $exception) {
    Session::flash('old', $exception->getOld());
    Session::flash('validations', $exception->getErrors());

    $previousUri = getUri($router->previousUrl());
    return redirect($previousUri);
}

Session::unflash();