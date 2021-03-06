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
Route::patch('/orders/{id}', 'OrdersController@wydrukowane');
Route::get('/orders/{id}/verified', 'OrdersController@verified');
Route::resource('orders', 'OrdersController');
Route::get('/planplastykow', 'PlanPlastykowController@podglad')->name('planplastykow.podglad');
Route::get('/planplastykow/edycja', 'PlanPlastykowController@edycja')->name('planplastykow.edycja');
Route::put('/planplastykow', 'PlanPlastykowController@updateOrders')->name('planplastykow.updateOrders');
Route::patch('/planplastykow/{id}', 'PlanPlastykowController@updateNiezaplanowane')->name('planplastykow.updateNiezaplanowane');
// redirect from register page to home page
Route::get('/register', function () {
    return redirect('/');
});
Route::group(['middleware' => 'App\Http\Middleware\CheckIfAdmin'], function()
{
    Route::get('/users/{id}/changepassword', 'UsersController@changepassword')->name('users.changepassword');
    Route::put('/users/{id}/updatepassword', 'UsersController@updatepassword')->name('users.updatepassword');
    Route::resource('users', 'UsersController');
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::resource('options', 'OptionsController');
    Route::get('/config-cache', function() {
        $exitCode = Artisan::call('config:cache');
        return redirect(config('options.siteurl').'options')->with('success', "Zaktualizowano ustawienia ogólne");
    });

});
Route::post('deploy', 'DeployController@deploy');