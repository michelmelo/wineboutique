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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes(['verify' => true]);
Route::get('register/sell', 'Auth\RegisterController@showRegistrationSellForm')->name('register.sell');

Route::get('/redirect/{service}', 'Auth\LoginController@redirectProvider');
Route::get('/callback', 'Auth\LoginController@handleGoogleProviderCallback');
Route::get ( '/callbackFB', 'Auth\LoginController@FacebookCallback' );

Route::view('/get-paid', 'get-paid')->name('get-paid');
Route::view('/local-pickup', 'local-pickup')->name('local-pickup');
Route::view('/my-wine', 'my-wine')->name('my-wine');
Route::view('/order-track', 'order-track')->name('order-track');
Route::view('/wb-experience', 'wb-experience')->name('wb-experience');
Route::view('/wishlist', 'wishlist')->name('wishlist');

Route::get('/new-arrivals', 'GeneralPagesController@new_arrivals')->name('new-arrivals');
Route::get('/hot-sellers', 'GeneralPagesController@hot_sellers')->name('hot-sellers');
Route::view('/privacy-policy', 'privacy-policy')->name('privacy-policy');
Route::view('/terms-and-conditions', 'terms-and-conditions')->name('terms-and-conditions');
Route::view('/faq', 'faq')->name('faq');
Route::view('/about-us', 'about-us')->name('about-us');

Route::get('/wineries', 'WineryController@list')->name('wineries');
Route::get('/winery/{winery}', 'WineryController@show')->name('winery');

Route::get('/wines', 'WineController@list')->name('wine.list');
Route::get('/wine/{wine}', 'WineController@show')->name('wine.show');
Route::get('/wines/top-rated', 'WineController@topRated')->name('wine.rating');

Route::get('/search', 'SearchController@search')->name('search');

Route::get('/varietals', 'WineController@varietals')->name('varietals');

Route::get('/test', 'TestController@index')->name('test');

Route::post('/addresses/default', 'AddressController@isDefaultSet');
Route::get('/addresses/default/{id}', 'AddressController@changeDefault');

Route::get('/images/wine/{slug}', 'ImageController@wineImage')->name('images.wine');

Route::resource('/wine-image', 'WineImageController')->only(['store', 'destroy']);

Route::post('/totalWines', 'WineController@totalWines');
Route::post('/totalWineries', 'WineryController@totalWineries');

Route::post('/newsletter', 'NewsletterController@store');
Route::get('/states', 'Api\LocationsController@regions');

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
    
    Route::post('favorite/{wine}', 'FavoriteWineController@favoriteWine');
    Route::post('unfavorite/{wine}', 'FavoriteWineController@unFavoriteWine');
    
    Route::post('rate-wine/{wine}', 'RateWineController@rate');
    Route::post('rate-winery/{winery}', 'RateWineryController@rate');
    
    Route::get('/cart/get', 'CartController@get');
    
    Route::resource('cart', 'CartController', [
        'parameters' => [
            'cart' => 'wine'
        ]
    ]);

    Route::resource('addresses', 'AddressController');

    Route::get('/checkout', 'CheckoutController@get');
    Route::post('/checkout/complete', 'CheckoutController@complete');
    Route::get('/checkout/done/{order}', 'CheckoutController@done');

    Route::get('my-favorites', 'UsersController@myFavorites');
    
    Route::get('/my-orders', 'MyOrdersController@show')->name('my-order.show');

    Route::get('/my-payments/default/{payment}', 'MyPaymentsController@update')->name('my-payments.update');
    Route::get('/my-payments', 'MyPaymentsController@show')->name('my-payments.show');
    Route::post('/my-payments', 'MyPaymentsController@store')->name('my-payments.store');

    Route::get('/my-address', 'MyAddressController@show')->name('my-address.show');
    Route::post('/my-address', 'MyAddressController@store')->name('my-address.store');
    Route::post('/my-address/{address}', 'MyAddressController@update')->name('my-address.update');
    Route::delete('/my-address/{address}', 'MyAddressController@destroy')->name('my-address.delete');

    Route::resource('/add-new-wine', 'AddNewWineController')->except(['show'])->parameters([
        'add-new-wine' => 'wine'
    ]);

    Route::post('/store-new-wine', 'AddNewWineController@store')->name('store-new-wine');
    Route::post('/hideMsg', 'AddNewWineController@hideMsg');
    Route::put('/store-edited-wine/{wine}', 'AddNewWineController@update');

    Route::get('/my_winery/order-update/{order}/{wine}/{tracking}', 'MyWineryController@order_update')->name('my-winery-order-update');
    Route::get('/my_winery', 'MyWineryController@index')->name('my-winery');
    Route::get('/my_winery_stats', 'MyWineryController@stats')->name('my-winery-stats');
    Route::get('/my-winery-shipping/delete/{id}', 'MyWineryController@shipping_delete')->name('shipping-delete');
    Route::get('/my-winery-edit', 'MyWineryController@edit')->name('my-winery-edit');
    Route::post('/my-winery-store', 'MyWineryController@store')->name('my-winery-store');
});