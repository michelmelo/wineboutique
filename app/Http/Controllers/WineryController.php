<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoRequest;
use App\Winery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class WineryController extends Controller
{
    public function profile(PhotoRequest $request)
    {
        $photoName = Str::uuid() . "." . $request->file('photo')->extension();
        $request->photo->storeAs('public/images/wineries/profile', $photoName);

        Auth::user()->winery->update(['profile' => $photoName]);

        return [
            'photo' => $photoName
        ];
    }

    public function cover(PhotoRequest $request)
    {
        $photoName = Str::uuid() . "." . $request->file('photo')->extension();
        $request->photo->storeAs('public/images/wineries/cover', $photoName);

        Auth::user()->winery->update(['cover' => $photoName]);

        return [
            'photo' => $photoName
        ];
    }

    public function list()
    {
        $wineries = Winery::paginate(8);

        return view('wineries', [
            'wineries' => $wineries
        ]);
    }

    public function show(Winery $winery)
    {
        return view('winery', [
            'winery' => $winery
        ]);
    }
}
