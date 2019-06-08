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
        $wineries = App\Winery::all();
        $region = App\Region::inRandomOrder()->first();

        foreach ($wineries as $key => $winery){
            $winery->regions()->attach($region);
        }
    }
}
