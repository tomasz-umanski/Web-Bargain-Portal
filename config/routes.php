<?php

$router->get('', 'HomeController');
$router->get('new', 'HomeController');
$router->get('lastCall', 'HomeController');

$router->get('', 'HomeController');
$router->get('new', 'HomeController');
$router->get('lastCall', 'HomeController');

$router->get('category', 'CategoryController');

$router->get('search', 'SearchController');

$router->get('favourites', 'FavouritesController','auth');
$router->get('favouriteSearches', 'FavouritesController', 'auth');
$router->get('favouriteDeals', 'FavouritesController', 'auth');

$router->get('newPost', 'NewPostController', 'auth');
$router->post('createPost', 'NewPostController', 'auth');
$router->get('createdPost', 'NewPostController', 'auth');

$router->get('signIn', 'AuthController', 'guest');
$router->post('login', 'AuthController', 'guest');
$router->get('signUp', 'AuthController', 'guest');
$router->post('register', 'AuthController', 'guest');
$router->delete('logout', 'AuthController', 'auth');

// $router->get('favourites', 'FavouritesController','auth')->only('auth');
// $router->get('favouriteSearches', 'FavouritesController')->only('auth');
// $router->get('favouriteDeals', 'FavouritesController')->only('auth');

// $router->get('newPost', 'NewPostController')->only('auth');
// $router->post('createPost', 'NewPostController')->only('auth');

// $router->get('signIn', 'AuthController')->only('guest');
// $router->post('login', 'AuthController')->only('guest');
// $router->get('signUp', 'AuthController')->only('guest');
// $router->post('register', 'AuthController')->only('guest');
// $router->delete('logout', 'AuthController')->only('auth');