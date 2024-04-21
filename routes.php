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
$router->get('signUp', 'AuthController')->only('guest');
$router->post('signIn', 'AuthController')->only('guest');
$router->post('signUp', 'AuthController')->only('guest');