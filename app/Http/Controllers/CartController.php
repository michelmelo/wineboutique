<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Http\Requests\CartStoreRequest;
use App\Http\Requests\CartUpdateRequest;
use App\Wine;
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
        $wines = Auth::user()->cart;
        $user_default_region = Auth::user()->addresses()->where("default", 1)->first();

        if($user_default_region){
            foreach ($wines as $wine){
                $wine->shipping = false;
                foreach ($wine->winery->winery_shippings as $shipping){
                    if($user_default_region->region_id == $shipping->ship_to){
                        $wine->shipping_price = $shipping->price;
                        $wine->shipping_additional = $shipping->additional;
                        $wine->shipping = true;
                        break;
                    }
                }
            }
        }

        return [
            'wines' => $wines
        ];
    }
}
