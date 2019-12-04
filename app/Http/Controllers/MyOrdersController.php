<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Address;
use App\Http\Requests\OrderStoreRequest;
use Illuminate\Support\Facades\Auth;

class MyOrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request)
    {
        return view('my-orders', [
            'orders' => Auth::user()->orders()->with('address', 'order_wines', 'order_wines.wine', 'order_wines.wine.winery', 'order_wines.winery')->get()
        ]);
    }

}
