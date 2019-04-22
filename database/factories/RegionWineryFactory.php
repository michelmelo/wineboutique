<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\WineRegion::class, function (Faker $faker) {

    $winery = \App\Winery::inRandomOrder()->first();

    return [
//        'region_id' => $region->id,
//        'winery_id' => $winery->id
        'name' => 'test wine region'
    ];
});