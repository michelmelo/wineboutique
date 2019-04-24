<?php

namespace App\Http\Controllers;

use App\Wine;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GeneralPagesController extends Controller
{
    public function new_arrivals()
    {
        return view('new-arrivals', [
            'wines' => Wine::limit(10)
                ->leftJoin('orders', 'wines.id', '=', 'orders.id')
                ->select(DB::raw('wines.*, count(orders.id) as orders_count'))
                ->groupBy('wines.id')
                ->orderBy('wines.created_at', 'desc')
                ->get()
        ]);
    }

    public function hot_sellers()
    {
        return view('hot-sellers', [
            'wines' => Wine::limit(10)
            ->leftJoin('orders', 'wines.id', '=', 'orders.id')
            ->select(DB::raw('wines.*, count(orders.id) as orders_count'))
            ->groupBy('wines.id')
            ->get()
        ]);
    }

}
