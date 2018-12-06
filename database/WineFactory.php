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

$factory->define(App\Wine::class, function (Faker $faker) {

    $winery = \App\Winery::inRandomOrder()->first();
    $varietal = \App\Varietal::inRandomOrder()->first();
    $wine_region = \App\WineRegion::inRandomOrder()->first();
    $region = \App\Region::inRandomOrder()->first();

    return [
        'name' => $faker->name,
        'photo' => $faker->image,
        'price' => $faker->randomNumber(2), 
        'winery_id' => $winery->id,
        'varietal_id' => $varietal->id,
        'wine_region_id' => $wine_region->id,
        'slug' => $faker->slug,
        'description' => $faker->text,
        'quantity' => $faker->randomNumber(2),
        'region_id' => $region->id,
    ];
});