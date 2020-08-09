<?php

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('key', function () use ($router) {
    $length = 32;    
    return substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
});

$router->group(['prefix' => 'users'], function () use ($router) {
    $router->get('/',  ['uses' => 'UserController@showAllusers']);
  
    $router->get('/{id}', ['uses' => 'UserController@showOneUser']);
  
    $router->post('/', ['uses' => 'UserController@create']);
  
    $router->delete('/{id}', ['uses' => 'UserController@delete']);
  
    $router->put('/{id}', ['uses' => 'UserController@update']);
  });