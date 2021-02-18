<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });


$router->group(["prefix" => "user"], function() use ($router){
    $router->post('register', 'Auth\UserAuthController@register');
    $router->post('login', 'Auth\UserAuthController@login');
    $router->get('view-profile', 'Auth\UserAuthController@viewProfile');
    $router->get('logout', 'Auth\UserAuthController@logout');
    $router->post('refresh-token', 'Auth\UserAuthController@refreshToken');
});

$router->group(["prefix" => "admin"], function() use ($router){
    $router->post('register', 'Auth\AdminAuthController@register');
    $router->post('login', 'Auth\AdminAuthController@login');
    $router->get('view-profile', 'Auth\AdminAuthController@viewProfile');
    $router->get('logout', 'Auth\AdminAuthController@logout');
    $router->post('refresh-token', 'Auth\AdminAuthController@refreshToken');
});

$router->post('categories', 'MenuCategoryController@store');
$router->put('categories/{id}', 'MenuCategoryController@update');
$router->delete('categories/{id}', 'MenuCategoryController@destroy');
$router->get('categories', 'MenuCategoryController@index');
$router->get('categories/{id}', 'MenuCategoryController@show');

$router->post('menus', 'MenuController@store');
$router->put('menus/{id}', 'MenuController@update');
$router->delete('menus/{id}', 'MenuController@destroy');
$router->get('menus', 'MenuController@index');
$router->get('menus/{id}', 'MenuController@show');