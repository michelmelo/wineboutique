<?php

namespace App\Http\Controllers;

use App\Region;
use App\WineryShipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShippingController extends Controller
{
    public function index(Request $request) {
        $winery = Auth::user()->winery;
        $retVal = array();
        foreach ($winery->regions as $item) {
            array_push($retVal,$item->id);
        }
        return view('shipping', [
            'winery' => $winery,
            'shippings' => $winery->winery_shippings()->get(),
            'regions' => Region::orderBy('name')->get(),
            'winery_regions' => $retVal,
        ]);
    }

    public function save(Request $request){
        $winery = Auth::user()->winery;
    	foreach($request->shipping as $shippings) {
            $do_save = true;
            $do_edit = !is_null($shippings["id"]);

            foreach ($shippings as $key => $shipping) {
                if ((is_null($shipping) && $key != "id" && $key != 'additional') || (is_null($shipping) && $do_edit)) {
                    $do_save = false;
                }
            }

            if ($do_save) {
                if (isset($shippings['shipping_free'])) {
                    $shippings['price'] = 0;
                    $shippings['additional'] = 0;

                    unset($shippings['shipping_free']);
                }

                if(!isset($shippings['additional'])||$shippings['additional']==null) {
                    $shippings['additional'] = 0;
                }

                if ($do_edit) {
                    WineryShipping::where('id', $shippings["id"])->update($shippings);
                } else {
                    foreach ($shippings['ship_to'] as $to) {
                        $winery->winery_shippings()->create([
                            "ship_from" => $shippings['ship_from'],
                            "ship_to" => $to,
                            "price" => $shippings['price'],
                            "additional" => $shippings['additional'],
//                            "days_from" => $shippings['days_from'],
//                            "days_to" => $shippings['days_to']
                        ]);
                    }
                }
            }
        }
        return redirect()->route('shipping.index');
    }
}
