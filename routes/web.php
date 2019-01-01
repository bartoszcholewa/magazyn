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

Route::get('/', function () {
    return view('index');
});
*/

Route::get('/', 'PagesController@index');
Route::get('/materials/{id}/raport', 'MaterialsController@raport');
Route::resource('materials', 'MaterialsController');
Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
Route::resource('suppliers', 'SuppliersController');
Route::resource('rolls', 'RollsController');
Route::resource('orders', 'OrdersController');
