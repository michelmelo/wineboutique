<?php

namespace App\Http\Controllers;

use App\Winery;
use Illuminate\Http\Request;

class RateWineryController extends Controller
{
    public function rate(Winery $winery, Request $request)
    {
        $winery->rate($request->rating);
        return 'ok';
    }
}
