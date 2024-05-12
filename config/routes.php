<?php

$router->get('', 'HomeController');
$router->get('new', 'HomeController');
$router->get('lastCall', 'HomeController');

$router->get('', 'HomeController');
$router->get('new', 'HomeController');
$router->get('lastCall', 'HomeController');

$router->get('category', 'CategoryController');

$router->post('search', 'SearchController');

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

$router->post('togglePostLike', 'ContentController', 'auth');
$router->get('getPostLikeStatus', 'ContentController');
$router->post('togglePostFavourite', 'ContentController', 'auth');
$router->get('getPostFavouriteStatus', 'ContentController');

$router->get('adminApproval', 'AdminPanelController', 'admin');
$router->post('approvePost', 'AdminPanelController', 'admin');
$router->post('rejectPost', 'AdminPanelController', 'admin');