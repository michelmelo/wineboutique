<?php

use Illuminate\Database\Seeder;

class WineRegionsTableSeeder extends Seeder
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
