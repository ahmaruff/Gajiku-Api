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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'golongan'], function() use($router){
    $router->get('/','GolonganController@index');
    $router->get('/all','GolonganController@index');
    $router->get('/{id}','GolonganController@getGolonganById');
    $router->post('/add','GolonganController@storeGolongan');
    $router->put('/update/{id}','GolonganController@updateGolonganById');
    $router->delete('/delete/{id}','GOlonganController@deleteGolonganById');
});

$router->group(['prefix'=>'pegawai'],function() use($router){
    $router->get('/','PegawaiController@index');
    $router->get('/all','PegawaiController@index');
    $router->get('/{id}','PegawaiController@getPegawaiById');
    $router->post('/add','PegawaiController@storePegawai');
    $router->put('/update/{id}','PegawaiController@updatePegawaiById');
    $router->delete('/delete/{id}','PegawaiController@deleteGolonganById');
});