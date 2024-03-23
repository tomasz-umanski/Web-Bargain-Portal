<?php

require_once 'src/controller/AppController.php';

$controller = new AppController();

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);
$action = explode("/", $path)[0];

$controller->render($action);