<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('profile', [
            'user' => Auth::user()
        ]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        $data = $request->only('firstName', 'lastName', 'email');
        if($request->birthday) {
            $data['birthday'] = new Carbon($request->birthday);
        }
        Auth::user()->update($data);
        return "ok";
    }

    public function password(PasswordUpdateRequest $request)
    {
        $current_password = Auth::user()->getAuthPassword();

        if(Hash::check($request->current_password, $current_password)) {
            Auth::user()->update([
                'password' => Hash::make($request->password)
            ]);
            return "ok";
        } else {
            $error = ['current_password' => ['Please enter correct current password']];
            return response()->json(['errors' => $error], 400);
        }
    }
}
