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
        $winery = Auth::user()->winery;

        return view('my-winery-edit', [
            'winery' => $winery,
            'shippings' => $winery->winery_shippings()->get(),
            'regions' => Region::orderBy('name')->get()
        ]);
    }

    public function store(Request $request)
    {
        $winery = Auth::user()->winery;
        $winery->description = $request->description;
        $winery->save();

        foreach($request->shipping as $shippings) {
            $do_save = true;
            $do_edit = !is_null($shippings["id"]);

            foreach ($shippings as $key => $shipping){
                if((is_null($shipping) && $key != "id") || (is_null($shipping) && $do_edit)){
                    $do_save = false;
                }
            }

            if($do_save){
                if(isset($shippings['shipping_free'])){
                    $shippings['price'] = 0;
                    $shippings['additional'] = 0;

                    unset($shippings['shipping_free']);
                }

                if($do_edit){
                    WineryShipping::where('id', $shippings["id"])->update($shippings);
                }
                else{
                    $winery->winery_shippings()->create($shippings);
                }
            }
        }

        return view('my-winery',[
            'varietals' => Varietal::all(),
            'regions' => Region::orderBy('name')->get(),
            'capacity_units' => CapacityUnit::all(),
            'wines' => $request->user()->winery->wines
        ]);
    }
}