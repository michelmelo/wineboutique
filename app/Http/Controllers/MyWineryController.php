<?php

namespace App\Http\Controllers;

use App\OrderWine;
use App\WineryShipping;
use Illuminate\Http\Request;
use App\Varietal;
use App\Region;
use App\CapacityUnit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function stats()
    {
        $tmp_orders = DB::table('orders')
            ->leftJoin('order_wines', 'orders.id', '=', 'order_wines.order_id')
            ->leftJoin('addresses', 'orders.address_id', '=', 'addresses.id')
            ->leftJoin('wines', 'order_wines.wine_id', '=', 'wines.id')
            ->leftJoin('wineries', 'wines.winery_id', '=', 'wineries.id')
            ->select('orders.id as order_id', 'orders.status as order_status', 'orders.created_at as order_date',
                'wines.name as wine_name', 'wines.id as wine_id', 'wineries.name as winery_name', 'addresses.address_1', 'addresses.address_2',
                'addresses.postal_code', 'addresses.city')
            ->where("wines.winery_id", Auth::user()->winery->id)
            ->get();

        $orders = array();

        foreach ($tmp_orders as $order){
            if(array_key_exists($order->order_id, $orders)){
                $orders[$order->order_id]["wines"] .= ", " . $order->winery_name . " - " . $order->wine_name;
            }
            else{
                $orders[$order->order_id] = [
                    "address" =>  $order->address_1 . " " . $order->address_2 . ", " . $order->city . ", " . $order->postal_code,
                    "wines" => $order->winery_name . " - " . $order->wine_name,
                    "status" => $order->order_status,
                    "order_date" => $order->order_date,
                    "wine_id" => $order->wine_id
                ];
            }
        }

        return view('my-winery-stats',["orders" => $orders]);
    }

    public function order_update($order_id, $wine_id)
    {

        $wine = Auth::user()->winery->wines()->where("id", $wine_id)->first();

        if(!$wine){
            return ['status' => false];
        }

        return ["status" => true];

//        $order = OrderWine::where("order_id", $order_id)->
    }
}