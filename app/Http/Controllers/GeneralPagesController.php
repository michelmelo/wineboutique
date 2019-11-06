<?php

namespace App\Http\Controllers;

use App\Varietal;
use App\Wine;
use App\WineRegion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GeneralPagesController extends Controller
{
    public function new_arrivals(Request $request)
    {
        $varietals = Varietal::all();
        $regions = WineRegion::all();

        $filter = $request->all();

        $wines = Wine::query();

        $wines = $wines->where("quantity", ">", 0);

        if(array_key_exists('varietal', $filter)) {
            $wines = $wines->whereIn('varietal_id', $filter['varietal']);
        }

        if(array_key_exists('region', $filter)) {
            $wines = $wines->whereIn('wine_region_id', $filter['region']);
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

        if($request->ajax()){
            $page_offset = 0;
            $page_limit = Wine::DISPLAYING;

            if ($request->get('page_offset')&&$request->get('page_limit')) {
                $page_offset = $request->get('page_offset');
                $page_limit = $request->get('page_limit');
            }

            $return_wines = "";

            $wines = $wines->limit(Wine::DISPLAYING)
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
            'wines' => $wines->limit(Wine::DISPLAYING)
                ->leftJoin('orders', 'wines.id', '=', 'orders.id')
                ->select(DB::raw('wines.*, count(orders.id) as orders_count'))
                ->groupBy('wines.id')
                ->orderBy('wines.created_at', 'desc')
                ->get(),
            'wine_count' => Wine::count(),
            'varietals' => $varietals,
            'regions' => $regions,
            'filter' => $filter,
            'seo' => [
                'title' => 'New Arrivals | Wine Boutique',
            ]
        ]);
    }

    public function hot_sellers(Request $request)
    {
        $varietals = Varietal::all();
        $regions = WineRegion::all();

        $filter = $request->all();

        $wines = Wine::query();

        $wines = $wines->where("wines.quantity", ">", 0);

        if(array_key_exists('varietal', $filter)) {
            $wines = $wines->whereIn('varietal_id', $filter['varietal']);
        }

        if(array_key_exists('region', $filter)) {
            $wines = $wines->whereIn('wine_region_id', $filter['region']);
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

        $wines = $wines->limit(Wine::DISPLAYING)
            ->leftJoin('order_wines', 'order_wines.wine_id', '=', 'wines.id')
            ->select(DB::raw('wines.*, sum(order_wines.quantity) as orders_count'))
            ->groupBy('wines.id')
            ->orderBy('orders_count','desc')
            ->get();

        foreach ($wines as $wine) {
            if (Auth::user()) {
                $wine->favorited = $wine->favorited();
            }
            $wine->rating = $wine->rating();
        }

        return view('hot-sellers', [
            'wines' => $wines,
            'varietals' => $varietals,
            'regions' => $regions,
            'filter' => $filter,
            'seo' => [
                'title' => 'Hot Sellers | Wine Boutique',
            ]
        ]);
    }

}
