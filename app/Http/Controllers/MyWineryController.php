<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Varietal;
use App\Region;
use App\CapacityUnit;
use Illuminate\Support\Facades\Auth;

class MyWineryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
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
            'wines' => $request->user()->winery->wines
        ]);
    }

    public function edit(Request $request)
    {
        $winery = Auth::user()->winery->with("winery_shippings")->first();

        return view('my-winery-edit', [
            'winery' => $winery
        ]);
    }

    public function store(Request $request)
    {
        Auth::user()->winery->where('id', $request->wineryId)->update(['description' => $request->description]);

        return view('my-winery',[
            'varietals' => Varietal::all(),
            'regions' => Region::orderBy('name')->get(),
            'capacity_units' => CapacityUnit::all(),
            'wines' => $request->user()->winery->wines
        ]);
    }
}