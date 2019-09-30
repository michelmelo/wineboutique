<?php

namespace App\Http\Controllers;

use App\Wine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeneralPagesController extends Controller
{
    public function new_arrivals(Request $request)
    {
        if($request->ajax()){
            $page_offset = 0;
            $page_limit = 10;

            if ($request->get('page_offset')&&$request->get('page_limit')) {
                $page_offset = $request->get('page_offset');
                $page_limit = $request->get('page_limit');
            }

            $return_wines = "";

            $wines = Wine::limit(10)
                ->leftJoin('orders', 'wines.id', '=', 'orders.id')
                ->select(DB::raw('wines.*, count(orders.id) as orders_count'))
                ->groupBy('wines.id')
                ->orderBy('wines.created_at', 'desc')
                ->skip($page_offset)
                ->take($page_limit)
                ->get();

            foreach ($wines as $wine){
                $return_wines .= view('new-arrival', compact('wine'))->render();
            }

            return $return_wines;
        }

        return view('new-arrivals', [
            'wines' => Wine::limit(10)
                ->leftJoin('orders', 'wines.id', '=', 'orders.id')
                ->select(DB::raw('wines.*, count(orders.id) as orders_count'))
                ->groupBy('wines.id')
                ->orderBy('wines.created_at', 'desc')
                ->get(),
            'wine_count' => Wine::count()
        ]);
    }

    public function hot_sellers()
    {
        return view('hot-sellers', [
            'wines' => Wine::limit(10)
            ->leftJoin('order_wines', 'order_wines.wine_id', '=', 'wines.id')
            ->select(DB::raw('wines.*, sum(order_wines.quantity) as orders_count'))
            ->groupBy('wines.id')
            ->orderBy('orders_count','desc')
            ->get()
        ]);
    }

}
