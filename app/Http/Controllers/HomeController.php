<?php

namespace App\Http\Controllers;

use App\Region;
use App\Varietal;
use App\Wine;
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
        $topWineries = DB::select('SELECT *, IFNULL((SELECT AVG(`winery_ratings`.`rating`) FROM `winery_ratings` WHERE `winery_ratings`.`winery_id`=`wineries`.`id`), 0) AS `rating` FROM `wineries` ORDER BY `rating` DESC LIMIT 10');
        $latestWines = Wine::latest()->limit(6)->get();
        
        $wines = Wine::orderBy('average_rating', 'desc');
        $varietals = Varietal::all();
        $regions = Region::all();

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
                    $q->whereBetween('price', [1, 50]);
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

        $wines = $wines->paginate(6);

        return view('home', [
            'varietals' => $varietals,
            'regions' => $regions,
            'topWineries' => $topWineries,
            'latestWines' => $latestWines,
            'wines' => $wines,
            'filter' => $filter
        ]);
    }
}
