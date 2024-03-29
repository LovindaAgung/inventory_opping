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

Route::get('/home', 'InventoryController@index')->name('home');
Route::get('/users/logout','Auth\LoginController@userLogout')->name('user.logout');

Route::prefix('admin')->group(function() {
  Route::get('/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
  Route::post('/login','Auth\AdminLoginController@login')->name('admin.login.submit');
  Route::get('/', 'AdminController@index')->name('admin.dashboard');
  Route::get('/logout','Auth\AdminLoginController@logout')->name('admin.logout');

  // password reset routes
  Route::get('/password/reset','Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
  Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
  Route::post('/password/reset','Auth\AdminResetPasswordController@reset')->name('admin.password.update');
  Route::get('/password/reset/{token}','Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

  Route::match(['put', 'patch'],'/inventory/approve/{inventory}','AdminController@approveRequest')->name('admin.approve');
  Route::get('admin/item-list','AdminController@getItem')->name('admin.itemlist');
  Route::get('admin/user-list','AdminController@getUser')->name('admin.userlist');

  Route::match(['put', 'patch'],'/user/disable/{user}','HomeController@disableUser')->name('user.disable');
  Route::delete('user/{user}','HomeController@destroy')->name('user.destroy');
  // Route::match(['put', 'patch'],'thing/{id}', 'ThingsController@update');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

//crud user
Route::resource('inventory', 'InventoryController');
