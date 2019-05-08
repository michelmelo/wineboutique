<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Varietal;
use App\Region;
use App\CapacityUnit;
use App\Wine;
use App\WineShipping;
use Illuminate\Support\Facades\DB;

class MyWineryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('seller');
    }

    public function index(Request $request)
    {
        return view('my-winery', [
            'varietals' => Varietal::all(),
            'regions' => Region::orderBy('name')->get(),
            'capacity_units' => CapacityUnit::all(),
//            'wines' => $request->user()->winery->wines,
            'wines' => Wine::leftJoin('varietals', 'varietals.id','=', 'wines.varietal_id')
                ->leftJoin('wineries', 'wineries.id', '=', 'wines.winery_id')
                ->select(DB::raw('wines.*, varietals.name as varietal'))
                ->where('wineries.user_id', '=', $request->user()->id)
                ->groupBy('wines.id')
                ->get(),
            'wine_shippings' => WineShipping::all(),            
        ]);
    }
}