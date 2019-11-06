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
        $vs = 'Cabernet Sauvignon, Chardonnay, Merlot, Pinot noir, Sauvignon blanc, Syrah, Zinfandel, Barbera, Cabernet Franc, Carignan, Grenache, Malbec, Mourvèdre, Petite Sirah, Petit Verdot, Sangiovese, Tannat, Chenin blanc, French Colombard, Gewürztraminer, Marsanne, Muscat Canelli, Pinot blanc, Pinot gris, Riesling, Roussane, Sémillon, Trousseau gris, Viognier';
        $vs = explode(',', $vs);
        foreach ($vs as $vsName) {
            $v = new \App\Varietal();
            $v->name = trim($vsName);
            $v->save();
        }
    }
}
