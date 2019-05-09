<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Varietal;
use App\Region;
use App\CapacityUnit;
use App\Wine;
use App\Winery;
use App\WineShipping;
use Illuminate\Support\Facades\Auth;

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
            'wines' => $request->user()->winery->wines,
            'wine_shippings' => WineShipping::all(),            
        ]);
    }

    public function edit(Request $request)
    {
        $winery = Auth::user()->winery;
        //dd($winery);
        return view('my-winery-edit', [
            'winery_id' => $winery->id,
            'winery_name' => $winery->name,
            'winery_desc' => $winery->description,
            'winery_profile' => $winery->profile,
            'winery_cover' => $winery->cover,
        ]);
    }

    public function store(Request $request)
    {
        //dd($request);
        Auth::user()->winery->where('id', $request->wineryId)->update(['description' => $request->description]);

        return view('my-winery',[
            'varietals' => Varietal::all(),
            'regions' => Region::orderBy('name')->get(),
            'capacity_units' => CapacityUnit::all(),
            'wines' => $request->user()->winery->wines,
            'wine_shippings' => WineShipping::all(),   
        ]);
    }
}