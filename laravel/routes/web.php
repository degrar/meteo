<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('/current_weather', 'WeatherController@index');
Route::get('/current_weather/{id}', 'WeatherController@show');


Route::get('/','PostsController@index');