<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\City;
use App\Country;

class LocationsController extends Controller
{
    public function countries()
    {
        return Country::all();
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
