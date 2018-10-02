<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\User;
use App\City;
use App\Location;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $userData = $request->except([
            'city',
            'location',
            'acceptTerms',
            'acceptAge'
        ]);

        $user = User::create($userData);

        if($userData['type'] === User::$types['seller']) {
            $user->city()->associate(City::find($request->get('city')));
            $user->location()->associate(Location::find($request->get('location')));
        }

        Auth::login($user, true);
    }
}
