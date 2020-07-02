<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressStoreRequest;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\AddressResource;
use App\Address;
use App\Region;

class MyAddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request)
    {
        return view('my-address', [
            'addresses' => $request->user()->addresses,
            'regions' => Region::orderBy('name')->get()
        ]);
    }

    private function check_default($address) {
        if($address->default) {
            User::addresses()->where("id", $address->id)->update([
                "default" => false
            ]);
        }
    }   

    public function store(AddressStoreRequest $request)
    {
        $address = Address::make($request->only(
            'name', 'address_1', 'address_2', 'city', 'postal_code', 'region_id', 'default'
        ));

        $request->user()->addresses()->save($address);

        $address->region = Region::find($address->region_id);

        return $address;
    }

    public function update(AddressStoreRequest $request, Address $address)
    {
        if($request->get('default')==true) {
            Address::where('user_id', '=', \Auth::user()->id)
                ->update([
                    'default' => false
                ]);
        }
        $data = $request->only('name', 'address_1', 'address_2', 'city', 'postal_code', 'region_id', 'default');
        $address->update($data);
     
        return $address;
    }

    public function destroy($id)
    {
        $address = Address::find($id);
        $address->delete();

        return $address;
    }
}
