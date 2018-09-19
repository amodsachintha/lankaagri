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


Auth::routes();


Route::get('/', 'HomeController@index');
Route::get('/profile','ProfileController@index');


Route::get('/test','ItemsController@show');
Route::post('/user/update','ProfileController@update');

Route::get('/items/search','ItemsController@search');

Route::get('/cart','CartController@show');
Route::get('/cart/update/quantity','CartController@updateQuantity');
Route::get('/cart/delete','CartController@deleteItemFromCart');