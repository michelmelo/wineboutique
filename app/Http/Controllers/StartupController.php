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

        foreach($request->shipping as $shippings) {
            $do_save = true;

            foreach ($shippings as $shipping){
                if(is_null($shipping)){
                    $do_save = false;
                }
            }

            if($do_save){
                if(isset($shippings['shipping_free'])){
                    $shippings['price'] = 0;
                    $shippings['additional'] = 0;
                    unset($shippings['shipping_free']);
                }

                $winery->winery_shippings()->create($shippings);
            }
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
