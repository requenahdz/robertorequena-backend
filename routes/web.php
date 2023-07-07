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

Route::post('login', 'AuthController@login');

$router->get('/', function () use ($router) {
    return 'Apis';
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'auth'
], function ($router) {

    //Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});


$router->group(['middleware' => 'apikey'], function () use ($router) {
      //offers
      $router->get('/offers', 'OfferController@index');
      $router->get('/offers/{id}', 'OfferController@show');
      $router->post('/offers', 'OfferController@store');
      $router->put('/offers/{id}', 'OfferController@update');
      $router->delete('/offers/{id}', 'OfferController@delete');
  
      //ToDo
      $router->get('/todo', 'ToDoController@index');
      $router->get('/todo/{id}', 'ToDoController@show');
      $router->post('/todo', 'ToDoController@store');
      $router->put('/todo/{id}', 'ToDoController@update');
      $router->delete('/todo/{id}', 'ToDoController@delete');
});
