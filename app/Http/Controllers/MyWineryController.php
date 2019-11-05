<?php

namespace App\Http\Controllers;

use App\Order;
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
            'wines' => $request->user()->winery->wines,
            'seo' => [
                'title' => 'My Winery | Wine Boutique',
            ]
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
                    foreach ($shippings['ship_to'] as $to){
                        $winery->winery_shippings()->create([
                            "ship_from" => $shippings['ship_from'],
                            "ship_to" => $to,
                            "price" => $shippings['price'],
                            "additional" => $shippings['additional'],
                            "days_from" => $shippings['days_from'],
                            "days_to" => $shippings['days_to']
                        ]);
                    }
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
            ->leftJoin('regions', 'addresses.region_id', '=', 'regions.id')
            ->leftJoin('wines', 'order_wines.wine_id', '=', 'wines.id')
            ->leftJoin('wineries', 'wines.winery_id', '=', 'wineries.id')
            ->select('orders.id as order_id', 'orders.status as order_status', 'orders.created_at as order_date',
                'wines.name as wine_name', 'order_wines.status as wine_status', 'order_wines.quantity as order_wine_quantity',
                'wines.id as wine_id', 'wineries.name as winery_name', 'wines.price as wine_price', 'addresses.address_1', 'addresses.address_2',
                'addresses.postal_code', 'addresses.city', 'regions.name as region_name')
            ->where("wines.winery_id", Auth::user()->winery->id)
            ->get();

        $orders = array();

        $status = [
            "order_count" => count($tmp_orders),
            "bottle_count" => 0,
            "best_selling_wine" => "",
            "best_selling_state" => "",
            "order_money_sum" => 0
        ];

        foreach ($tmp_orders as $order){
            if(array_key_exists($order->order_id, $orders)){
                $orders[$order->order_id]["wines"][] = [
                    "name" => $order->wine_name,
                    "status" => $order->wine_status,
                    "quantity" => $order->order_wine_quantity,
                    "id" => $order->wine_id
                ];
            }
            else{
                $orders[$order->order_id] = [
                    "address" =>  $order->address_1 . " " . $order->address_2 . ", " . $order->city . ", " . $order->postal_code,
                    "wines" => [
                        [
                            "name" => $order->wine_name,
                            "status" => $order->wine_status,
                            "quantity" => $order->order_wine_quantity,
                            "id" => $order->wine_id
                        ]
                    ],
                    "status" => $order->order_status,
                    "order_date" => $order->order_date,
                ];
            }

            $status["bottle_count"] += $order->order_wine_quantity;
            $status["order_money_sum"] += ($order->order_wine_quantity * $order->wine_price);
            $status["best_selling_wine"] = $order->wine_name;
            $status["best_selling_state"] = $order->region_name;
        }

        return view('my-winery-stats',[
            "orders" => $orders,
            "stats" => $status
        ]);
    }

    public function order_update($order_id, $wine_id, $tracking_id)
    {
        $user = Auth::user();
        $wine = $user->winery->wines()->where("id", $wine_id)->first();

        if(!$wine){
            return redirect("my_winery_stats")->with("error", "Permission denied");
        }

        $order = Order::where("id", $order_id)->first();

        if($order->order_wines()->where("wine_id", $wine_id)->update(["status" => 2, "tracking" => $tracking_id])){
            if(count($order->order_wines()->where("status", 1)->get()) == 0){
                $order->update(["status" => 2]);
            }
        }

        return redirect("my_winery_stats")->with("success", "Wine sent");
    }

    public function shipping_delete($id){
        $user = Auth::user();
        $shipping = $user->winery->winery_shippings()->where("id", $id)->first();

        if(!$shipping){
            return redirect()->route('my-winery-edit');
        }

        $shipping->delete();

        return redirect()->route('my-winery-edit');
    }
}