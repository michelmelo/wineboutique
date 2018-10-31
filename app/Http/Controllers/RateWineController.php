<?php

namespace App\Http\Controllers;

use App\Wine;
use Illuminate\Http\Request;

class RateWineController extends Controller
{
    public function rate(Wine $wine, Request $request)
    {
        $wine->rate($request->rating);
        return 'ok';
    }
}
