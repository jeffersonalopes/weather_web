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


Route::get('/city/create', 'CitiesController@Create');
Route::get('/config/seed', 'CitiesController@Seed');
Route::get('/ajx/cities_by_country/{code}','CitiesController@cities_by_country');
Route::post('/city/store', 'CitiesController@Store');
Route::get("/cities/list", 'CitiesController@list');
Route::get("/city/{code}",'CitiesController@show');
Route::get("/", 'CitiesController@list');