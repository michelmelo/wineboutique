<?php

use Illuminate\Database\Seeder;

class RegionWineriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\WineRegion::class, 10)->create();
    }
}
