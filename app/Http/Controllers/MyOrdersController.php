<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Address;
use App\Http\Requests\OrderStoreRequest;

class MyOrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request)
    {
        return view('my-orders', [
            'orders' => Order::with('address')->get()
        ]);
    }

}
