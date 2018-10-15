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

Route::view('/', 'home')->name('home');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::get('register/sell', 'Auth\RegisterController@showRegistrationSellForm')->name('register.sell');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::view('/add-new-wine', 'add-new-wine')->name('add-new-wine');
Route::view('/cart', 'cart')->name('cart');
Route::view('/get-paid', 'get-paid')->name('get-paid');
Route::view('/hot-sellers', 'hot-sellers')->name('hot-sellers');
Route::view('/local-pickup', 'local-pickup')->name('local-pickup');
Route::view('/my-wine', 'my-wine')->name('my-wine');
Route::view('/new-arrivals', 'new-arrivals')->name('new-arrivals');
Route::view('/order-track', 'order-track')->name('order-track');
Route::view('/wb-experience', 'wb-experience')->name('wb-experience');
Route::view('/wineries', 'wineries')->name('wineries');
Route::view('/winery', 'winery')->name('winery');
Route::view('/wishlist', 'wishlist')->name('wishlist');

Route::get('/wines', 'WineController@list')->name('wine.list');
Route::get('/wine/{wine}', 'WineController@show')->name('wine.show');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/startup', 'StartupController@show')->name('startup');
    Route::post('/startup', 'StartupController@store');

    Route::post('/wine/store', 'WineController@store')->name('wine.store');
    Route::post('/wine/update/{wine}', 'WineController@update')->name('wine.update');
    Route::delete('/wine/delete/{wine}', 'WineController@delete')->name('wine.delete');
    Route::post('/wine/clone/{wine}', 'WineController@clone')->name('wine.clone');

    Route::get('/profile', 'ProfileController@show')->name('profile.show');
    Route::post('/profile/update', 'ProfileController@update')->name('profile.update');
});