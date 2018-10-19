<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyWinesController extends Controller
{
    public function show()
    {
        return view('my-wines', [
            'wines' => Auth::user()->winery->wines
        ]);
    }
}
