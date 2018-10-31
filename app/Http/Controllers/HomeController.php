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
    public function index()
    {
        $topWineries = DB::select('SELECT *, IFNULL((SELECT AVG(`winery_ratings`.`rating`) FROM `winery_ratings` WHERE `winery_ratings`.`winery_id`=`wineries`.`id`), 0) AS `rating` FROM `wineries` ORDER BY `rating` DESC LIMIT 10');
        $latestWines = Wine::latest()->limit(6)->get();
        $topWines = DB::select('SELECT *, IFNULL((SELECT AVG(`wine_ratings`.`rating`) FROM `wine_ratings` WHERE `wine_ratings`.`wine_id`=`wines`.`id`), 0) AS `rating`, (SELECT COUNT(*) FROM `favorite_wines` WHERE `favorite_wines`.`wine_id`=`wines`.`id` AND `favorite_wines`.`user_id`=?) AS `favorited` FROM `wines` ORDER BY `rating` DESC LIMIT 6', [Auth::id()]);

        return view('home', [
            'varietals' => Varietal::all(),
            'regions' => Region::all(),
            'topWineries' => $topWineries,
            'latestWines' => $latestWines,
            'topWines' => $topWines
        ]);
    }
}
