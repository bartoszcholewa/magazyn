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
Route::get('lang/{locale}', 'LocalizationController@index');
Route::get('/', 'PagesController@index');
Route::get('/materials/{id}/raport', 'MaterialsController@raport');
Route::resource('materials', 'MaterialsController');
Auth::routes(['verify' => true]);

Route::get('/dashboard', 'DashboardController@index');
Route::resource('suppliers', 'SuppliersController');
Route::resource('rolls', 'RollsController');
Route::get('/rolls/get/{id}', 'OrdersController@getRolls');
Route::resource('orders', 'OrdersController');
Route::get('/planplastykow', 'PlanPlastykowController@podglad')->name('planplastykow.podglad');
Route::get('/planplastykow/edycja', 'PlanPlastykowController@edycja')->name('planplastykow.edycja');
Route::put('/planplastykow', 'PlanPlastykowController@updateOrders')->name('planplastykow.updateOrders');
Route::patch('/planplastykow/{id}', 'PlanPlastykowController@updateNiezaplanowane')->name('planplastykow.updateNiezaplanowane');
Route::get('/users/{id}/changepassword', 'UsersController@changepassword')->name('users.changepassword');
Route::put('/users/{id}/updatepassword', 'UsersController@updatepassword')->name('users.updatepassword');
Route::resource('users', 'UsersController');
