<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Wine;
use App\Order;

class UsersController extends Controller
{
    public function myFavorites()
    {
        $myFavorites = Auth::user()->favoriteWines;
        $orderNo = array();
        foreach ($myFavorites as $myFavorite) {
        	$orderNo[$myFavorite->id] = DB::select("SELECT count(*) as orderNo FROM orders WHERE order_id =  $myFavorite->id LIMIT 1")[0];
        	$myFavorite->rating = $myFavorite->rating();
        }

        return view('my_favorites', compact('myFavorites', 'orderNo'));
    }

}
