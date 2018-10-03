<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\User;
use App\City;
use App\Location;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $userData = $request->except([
            'city',
            'location',
            'acceptTerms',
            'acceptAge',
            'wineryName'
        ]);
        $userData["password"] = Hash::make($userData["password"]);

        $user = User::create($userData);

        if($userData['type'] === User::$types['seller'])
        {
            $winery = $user->winery()->create([
                'name' => $request->get('wineryName')
            ]);
            City::find($request->get('city'))->wineries()->save($winery);
            Location::find($request->get('location'))->wineries()->save($winery);
        }

        Auth::login($user, true);
    }

    public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => 'email|required|unique:users,email'
        ]);

        return response('ok', 200)
            ->header('Content-Type', 'text/plain');
    }
}
