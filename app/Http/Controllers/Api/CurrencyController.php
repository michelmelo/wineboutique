<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Currency;

class CurrencyController extends Controller
{
    public function list()
    {
        return Currency::all();
    }
}
