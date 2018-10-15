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
    public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => 'email|required|unique:users,email'
        ]);

        return response('ok', 200)
            ->header('Content-Type', 'text/plain');
    }
}
