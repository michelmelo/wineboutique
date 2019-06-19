<?php

namespace App\Http\Controllers;

use App\WineryShipping;
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
            'winery' => $winery,
            'regions' => Region::orderBy('name')->get()
        ]);
    }

    public function store(Request $request)
    {
        Auth::user()->winery->where('id', $request->wineryId)->update(['description' => $request->description]);

        foreach($request->shipping as $shippingItem) {

            if(isset($shippingItem['shipping_free'])){
                $shippingItem['price'] = 0;
                $shippingItem['additional'] = 0;
                unset($shippingItem['shipping_free']);
            }

            WineryShipping::where('id', $shippingItem["id"])->update($shippingItem);
        }

        return view('my-winery',[
            'varietals' => Varietal::all(),
            'regions' => Region::orderBy('name')->get(),
            'capacity_units' => CapacityUnit::all(),
            'wines' => $request->user()->winery->wines
        ]);
    }
}