<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        Auth::user()->update($request->all());
    }
}
