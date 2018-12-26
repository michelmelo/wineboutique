<?php

use App\Region;
use App\Varietal;
use App\Winery;
use App\CapacityUnit;
use Faker\Generator as Faker;

$factory->define(\App\Wine::class, function (Faker $faker) {
    $wineries = Winery::all()->pluck('id')->toArray();
    $varietals = Varietal::all()->pluck('id')->toArray();
    $regions = Region::all()->pluck('id')->toArray();
    $capacity_units = CapacityUnit::all()->pluck('id')->toArray();

    return [
        'name' => $faker->text(15),
        'photo' => $faker->imageUrl(),
        'price' => $faker->randomFloat(null, 1, 100),
        'winery_id' => $faker->randomElement($wineries),
        'varietal_id' => $faker->randomElement($varietals),
        'quantity' => $faker->numberBetween(1, 50),
        'slug' => $faker->slug,
        'description' => $faker->realText(),
        'region_id' => $faker->randomElement($regions),
        'who_made_it' => $faker->text(15),
        'when_was_it_made' => $faker->year($min = '1900', $max = 'now'),
        'capacity' => $faker->randomFloat(null, 1, 50),
        'unit_id' => $faker->randomElement($capacity_units),
    ];
});
