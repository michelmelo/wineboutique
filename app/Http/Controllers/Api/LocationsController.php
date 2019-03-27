<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Region;

class LocationsController extends Controller
{
    public function regions()
    {
        return Region::orderBy('name')->get();
    }
}
