<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\City;

class LocationsController extends Controller
{
    public function cities()
    {
        return City::all();
    }

    public function locations(City $city)
    {
        return $city->locations;
    }
}
