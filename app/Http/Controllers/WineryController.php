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
        $request->file('photo')->move(public_path().'/images/winery/profile/',
            $photo = $request->get('wid') . '_' . uniqid(true) .'.' . $request->file('photo')->extension());

        Auth::user()->winery->where('id', $request->wid)->update(['profile' => $photo]);
        return [
            'photo' => $photo
        ];
    }

    public function cover(PhotoRequest $request)
    {
        $request->file('photo')->move(public_path().'/images/winery/cover/',
            $photo = $request->get('wid') . '_' . uniqid(true) .'.' . $request->file('photo')->extension());

        Auth::user()->winery->where('id', $request->wid)->update(['cover' => $photo]);

        return [
            'photo' => $photo
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
