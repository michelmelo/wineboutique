<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RegionsTableSeeder::class);;
        $this->call(VarietalsTableSeeder::class);
        $this->call(WineRegionsTableSeeder::class);
        $this->call(CapacityUnitsTableSeeder::class);
    }
}
