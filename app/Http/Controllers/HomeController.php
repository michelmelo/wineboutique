<?php

namespace App\Http\Controllers;

use App\Region;
use App\Varietal;
use App\Wine;
use App\WineRegion;
use App\Winery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        return true;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $topWineries = DB::select('SELECT *, IFNULL((SELECT AVG(`winery_ratings`.`rating`) FROM `winery_ratings` WHERE `winery_ratings`.`winery_id`=`wineries`.`id`), 0) AS `rating` FROM `wineries` HAVING `rating` > 0 ORDER BY `rating` DESC LIMIT 10');
        $latestWines = Wine::latest()->where("quantity", ">", 0)->limit(6)->get();
        $wines = Wine::orderBy('average_rating', 'desc')->where("quantity", ">", 0);

        $topRatedWines = Wine::where('average_rating', '>', 0)
        ->where('wines.quantity', '>', 0)
        ->orderBy('average_rating', 'desc');

        $varietals = Varietal::orderBy('name')->get();
        $regions = WineRegion::orderBy('name')->get();

        $filter = $request->all();

        if(array_key_exists('varietal', $filter)) {
            $wines = $wines->whereIn('varietal_id', $filter['varietal']);
        }

        if(array_key_exists('region', $filter)) {
            $wines = $wines->whereIn('region_id', $filter['region']);
        }

        if(array_key_exists('price', $filter)) {
            $prices = $filter['price'];
            $wines = $wines->where(function($q) use ($prices) {
                $useOr = false;
                if(in_array(1, $prices)) {
                    $q->whereBetween('price', [5, 50]);
                    $useOr = true;
                }

                if(in_array(2, $prices)) {
                    $useOr?$q->orWhereBetween('price', [51, 100]):$q->whereBetween('price', [51, 100]);
                    $useOr = true;
                }

                if(in_array(3, $prices)) {
                    $useOr?$q->orWhere('price', '>', 100):$q->where('price', '>', 100);
                }
            });
        }

        if($topRatedWines->count() >= 10){
            $topRatedWines = $topRatedWines->paginate(10);
        }
        else{
            $topRatedWines = $topRatedWines->paginate(5);
        }

        return view('home', [
            'varietals' => $varietals,
            'regions' => $regions,
            'topWineries' => $topWineries,
            'latestWines' => $latestWines,
            'wines' => $wines,
            'topRatedWines' => $topRatedWines,
            'filter' => $filter,
            'seo' => [
                'title' => 'Online Wine Store - Buy Fine Wine Online | Wine Boutique',
                'description' => 'Wine Boutique is an exclusive online platform where wineries can directly sell their wine to the wine lovers. Shop the finest wine from top rated wineries!'
            ]
        ]);
    }
}
