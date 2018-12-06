<?php

use Illuminate\Database\Seeder;

class WineriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Winery::class, 10)->create();
    }
}
