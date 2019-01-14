<?php

namespace App\Providers;

use App\Cart;
use App\WineRating;
use App\Observers\WineRatingObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        WineRating::observe(WineRatingObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Cart::class, function($app) {
            return new Cart($app->auth->user());
        });
    }
}
