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

Route::view('/', 'home');

Auth::routes();

Route::view('/add-new-wine', 'add-new-wine');
Route::view('/cart', 'cart');
Route::view('/customer-sign-up', 'customer-sign-up');
Route::view('/get-paid', 'get-paid');
Route::view('/hot-sellers', 'hot-sellers');
Route::view('/local-pickup', 'local-pickup');
Route::view('/my-wine', 'my-wine');
Route::view('/new-arrivals', 'new-arrivals');
Route::view('/order-track', 'order-track');
Route::view('/profile', 'profile');
Route::view('/sign-up-to-sell', 'sign-up-to-sell');
Route::view('/startup', 'startup');
Route::view('/wb-experience', 'wb-experience');
Route::view('/wineries', 'wineries');
Route::view('/winery', 'winery');
Route::view('/wines-single', 'wines-single');
Route::view('/wines', 'wines');
Route::view('/wishlist', 'wishlist');