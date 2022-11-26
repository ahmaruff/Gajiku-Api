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
    // $router->post('/','GolonganController@storeGolongan');
    $router->get('/{id:[\d]+}','GolonganController@getGolonganById');
    $router->put('/edit/{id:[\d]+}','GolonganController@updateGolonganById');
    $router->delete('/delete/{id:[\d]+}','GOlonganController@deleteGolonganById');
});

$router->group(['prefix'=>'pegawai'],function() use($router){
    $router->get('/','PegawaiController@index');
    $router->post('/','PegawaiController@storePegawai');
    $router->get('/{id:[\d]+}','PegawaiController@getPegawaiById');
    $router->put('/edit/{id:[\d]+}','PegawaiController@updatePegawaiById');
    $router->delete('/delete/{id:[\d]+}','PegawaiController@deleteGolonganById');
});