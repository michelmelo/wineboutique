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
        $this->call(UsersTableSeeder::class);
        $this->call(RegionsTableSeeder::class);
        $this->call(RegionWineriesTableSeeder::class);
        $this->call(VarietalsTableSeeder::class);
        $this->call(WineRegionsTableSeeder::class);
        $this->call(WineriesTableSeeder::class);
        $this->call(WinesTableSeeder::class);
    }
}
