<?php
require 'Router.php';


$uri = trim($_SERVER['REQUEST_URI'], '/');
$uri = parse_url($uri, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('new', 'DefaultController');
Router::get('lastCall', 'DefaultController');
Router::post('search', 'DefaultController');

Router::get('favourites', 'FavouritesController');
Router::get('favouriteSearches', 'FavouritesController');
Router::get('favouriteDeals', 'FavouritesController');

Router::get('newPost', 'NewPostController');

Router::get('category', 'CategoryController');

Router::run($uri);