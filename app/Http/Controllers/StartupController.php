<?php

namespace App\Http\Controllers;

use App\Http\Requests\StartupRequest;
use Illuminate\Support\Facades\Auth;
use App\Region;


class StartupController extends Controller
{
    public function show()
    {
        $winery = Auth::user()->winery;

        return view('startup', [
            'winery' => $winery,
            'winery_regions' => $this->onlyIDs($winery->regions),
            'regions' => Region::orderBy('name')->get()
        ]);
    }

    public function store(StartupRequest $request)
    {
        $winery = Auth::user()->winery;

        $winery->name = $request->wineryName;
        $winery->description = $request->description;
        $winery->save();

        $winery->regions()->attach($request->regions);

        foreach($request->shipping as $shippingItem) {
            if(!isset($shippingItem['shipping_free'])){
                $shippingItem['price'] = 0;
                $shippingItem['additional'] = 0;
                unset($shippingItem['shipping_free']);
            }


            $winery->winery_shippings()->create($shippingItem);
        }

        return redirect()->route('my-winery');
    }

    private function onlyIDs($obj)
    {
        $retVal = array();
        foreach ($obj as $item) {
            array_push($retVal,$item->id);
        }
        return $retVal;
    }
}
