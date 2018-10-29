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

Auth::routes(['verify' => true]);
Route::get('register/sell', 'Auth\RegisterController@showRegistrationSellForm')->name('register.sell');

Route::view('/add-new-wine', 'add-new-wine')->name('add-new-wine');
Route::view('/cart', 'cart')->name('cart');
Route::view('/get-paid', 'get-paid')->name('get-paid');
Route::view('/hot-sellers', 'hot-sellers')->name('hot-sellers');
Route::view('/local-pickup', 'local-pickup')->name('local-pickup');
Route::view('/my-wine', 'my-wine')->name('my-wine');
Route::view('/new-arrivals', 'new-arrivals')->name('new-arrivals');
Route::view('/order-track', 'order-track')->name('order-track');
Route::view('/wb-experience', 'wb-experience')->name('wb-experience');
Route::view('/winery', 'winery')->name('winery');
Route::view('/wishlist', 'wishlist')->name('wishlist');


Route::get('/wineries', 'WineryController@list')->name('wineries');

Route::get('/wines', 'WineController@list')->name('wine.list');
Route::get('/wine/{wine}', 'WineController@show')->name('wine.show');

Route::get('/search', 'SearchController@search')->name('search');

Route::get('/varietals', 'WineController@varietals')->name('varietals');

Route::get('/test', 'TestController@index')->name('test');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/startup', 'StartupController@show')->name('startup');
    Route::post('/startup', 'StartupController@store');

    Route::post('/winery/profile', 'WineryController@profile');
    Route::post('/winery/cover', 'WineryController@cover');

    Route::post('/wine/store', 'WineController@store')->name('wine.store');
    Route::post('/wine/update/{id}', 'WineController@update')->name('wine.update');
    Route::delete('/wine/delete/{id}', 'WineController@delete')->name('wine.delete');
    Route::post('/wine/clone/{id}', 'WineController@clone')->name('wine.clone');

    Route::get('/profile', 'ProfileController@show')->name('profile.show');
    Route::post('/profile/update', 'ProfileController@update')->name('profile.update');
    Route::post('/profile/password', 'ProfileController@password')->name('profile.password');

    Route::get('/my-wines', 'MyWinesController@show')->name('my-wines.list')->middleware('can:list,App\Wine');
});