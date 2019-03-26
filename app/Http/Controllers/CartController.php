<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Http\Requests\CartStoreRequest;
use App\Http\Requests\CartUpdateRequest;
use App\Wine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        return view('cart', [
            'empty' => Auth::user()->cart->count() === 0
        ]);
    }

    public function store(CartStoreRequest $request, Cart $cart)
    {
        $cart->add($request->wines);
        return $this->get();
    }

    public function update(Wine $wine, CartUpdateRequest $request, Cart $cart)
    {
        $cart->update($wine->id, $request->quantity);
        return $this->get();
    }

    public function destroy(Wine $wine, Cart $cart)
    {
        $cart->delete($wine->id);
        return $this->get();
    }

    public function get()
    {
        return [
            'wines' => Auth::user()->cart
        ];
    }
}
