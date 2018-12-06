<?php

use Illuminate\Database\Seeder;

class VarietalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Varietal::class, 10)->create();
    }
}
