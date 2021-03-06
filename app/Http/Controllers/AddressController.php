<?php

namespace App\Http\Controllers;

use App\Address;
use App\Http\Requests\AddressStoreRequest;
use App\Http\Resources\AddressResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function index(Request $request)
    {
        return AddressResource::collection(
            $request->user()->addresses
        );
    }

    public function store(AddressStoreRequest $request)
    {
        $address = Address::make($request->only(
            'name', 'address_1', 'city', 'postal_code', 'region_id', 'default'
        ));

        $request->user()->addresses()->save($address);

        return new AddressResource(
            $address
        );
    }

    public function isDefaultSet(Request $request) {
        if($request->user()===null) return 0;
        $addresses = Address::where('user_id', '=', $request->user()->id)->get();
        foreach ($addresses as $address) {
            if($address->default===1) return 1;
        }
        return 0;
    }

    public function changeDefault($id) {
        foreach (Auth::user()->addresses as $address){
            if($address->id == $id){
                $address->default = 1;
                $address->save();
            }
            else{
                $address->default = 0;
                $address->save();
            }
        }

        return response()->json(['status' => true]);
    }
}
