<?php
require 'Router.php';

session_start();

$uri = trim($_SERVER['REQUEST_URI'], '/');
$uri = parse_url($uri, PHP_URL_PATH);

Router::get('', 'HomeController');
Router::get('new', 'HomeController');
Router::get('lastCall', 'HomeController');

Router::get('category', 'CategoryController');

Router::get('search', 'SearchController');

Router::get('favourites', 'FavouritesController');
Router::get('favouriteSearches', 'FavouritesController');
Router::get('favouriteDeals', 'FavouritesController');

Router::get('newPost', 'NewPostController');

Router::post('signIn', 'AuthController');
Router::post('signUp', 'AuthController');

Router::run($uri);