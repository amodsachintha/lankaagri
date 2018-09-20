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

Route::get('/item/{id}','ItemsController@showItem');
Route::get('/items/search','ItemsController@search');
Route::get('/items/add','ItemsController@showAdd');
Route::post('/items/add','ItemsController@storeItem');
Route::get('/items/update','ItemsController@showUpdate');
Route::post('/items/update','ItemsController@doUpdate');
Route::get('/items/delete','ItemsController@doDelete');

Route::get('/cart','CartController@show');
Route::get('/cart/update/quantity','CartController@updateQuantity');
Route::get('/cart/delete','CartController@deleteItemFromCart');
Route::get('/cart/add','CartController@addToCart');


Route::get('/checkout','CartController@checkout');
Route::post('/checkout','CartController@storeCheckout');


Route::get('/order/show/{orderId}','OrderController@show');

Route::get('/orderline/fulfill/{orderlineId}','OrderController@fulfillOrderline');