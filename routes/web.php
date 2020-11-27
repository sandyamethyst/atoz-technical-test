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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'OrdersController@index');
Route::post('/', 'OrdersController@index');

Route::get('/product', 'ProductsController@index');
Route::post('/product', 'ProductsController@store');

Route::get('/prepaid-balance', 'PrepaidsController@index');
Route::post('/prepaid-balance', 'PrepaidsController@store');

Route::get('/order', 'OrdersController@index');
Route::get('/success', 'OrdersController@success');
Route::post('/payment', 'OrdersController@payment');
Route::patch('/payment', 'OrdersController@processPayment');
