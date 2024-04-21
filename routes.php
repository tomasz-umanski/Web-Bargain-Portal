<?php

$router->get('', 'HomeController');
$router->get('new', 'HomeController');
$router->get('lastCall', 'HomeController');

$router->get('', 'HomeController');
$router->get('new', 'HomeController');
$router->get('lastCall', 'HomeController');

$router->get('category', 'CategoryController');

$router->get('search', 'SearchController');

$router->get('favourites', 'FavouritesController')->only('auth');
$router->get('favouriteSearches', 'FavouritesController')->only('auth');
$router->get('favouriteDeals', 'FavouritesController')->only('auth');

$router->get('newPost', 'NewPostController')->only('auth');

$router->get('signIn', 'AuthController')->only('guest');
$router->post('login', 'AuthController')->only('guest');
$router->get('signUp', 'AuthController')->only('guest');
$router->post('register', 'AuthController')->only('guest');
$router->delete('logout', 'AuthController')->only('auth');