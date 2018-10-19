<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\City;
use App\Country;
use Illuminate\Support\Facades\Config;

class LocationsController extends Controller
{
    public function states()
    {
        $rawStates = Config::get('enums.states');
        $statesCodes = array_keys($rawStates);
        return array_map(function($name, $code) {
            return [
                'name' => $name,
                'code' => $code
            ];
        }, $rawStates, $statesCodes);
    }

    public function cities()
    {
        return City::all();
    }

    public function locations(City $city)
    {
        return $city->locations;
    }
}
