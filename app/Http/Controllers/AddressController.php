<?php

namespace App\Http\Controllers;

use App\Address;
use App\Http\Requests\AddressStoreRequest;
use App\Http\Resources\AddressResource;
use Illuminate\Http\Request;

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
}
