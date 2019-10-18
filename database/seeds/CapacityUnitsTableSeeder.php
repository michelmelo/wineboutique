<?php

use Illuminate\Database\Seeder;

class CapacityUnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\CapacityUnit::insert([
            'name' => 'Liter'
        ]);

        \App\CapacityUnit::insert([
            'name' => 'Deciliter'
        ]);

        \App\CapacityUnit::insert([
            'name' => 'Millilitre'
        ]);

        \App\CapacityUnit::insert([
            'name' => 'Gallon'
        ]);

        \App\CapacityUnit::insert([
            'name' => 'Fluid ounce'
        ]);
    }
}
