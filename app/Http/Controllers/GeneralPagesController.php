<?php

namespace App\Http\Controllers;

use App\Wine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeneralPagesController extends Controller
{
    public function new_arrivals()
    {
        return view('new-arrivals', [
            'wines' => Wine::orderBy('created_at', 'desc')->limit(10)->get()
        ]);
    }

    public function hot_sellers()
    {
        /*
         * SELECT wineboutique.wines.*, COUNT(wineboutique.orders.id) as orders_count
            FROM wineboutique.wines
            LEFT JOIN wineboutique.orders
            ON wines.id = orders.id
            GROUP BY wines.id
         */

        $wines = DB::table('wines')
            ->leftJoin('orders', 'wines.id', '=', 'orders.id')
            ->select(DB::raw('wines.* count(orders.id) as orders_count'))
            ->groupBy('wines.id')
            ->get();
        dd($wines);

        return view('hot-sellers', [
            'wines' => Wine::limit(10)->get()
        ]);
    }

}
