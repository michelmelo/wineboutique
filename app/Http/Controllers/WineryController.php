<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoRequest;
use App\Winery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Image;

class WineryController extends Controller
{
    public function profile(PhotoRequest $request)
    {
        $request->file('photo')->move(public_path().'/images/winery/profile/',
            $photo = $request->get('wid') . '_' . uniqid(true) .'.jpg'  );

        Auth::user()->winery->where('id', $request->wid)->update(['profile' => $photo]);

        $path = public_path().'/images/winery/profile/' . $photo;
        Image::make($path)->encode('jpg')->fit(250, 250, function ($c) {
            $c->upsize();
        })->save();

        return [
            'photo' => $photo
        ];
    }

    public function cover(PhotoRequest $request)
    {
        $request->file('photo')->move(public_path().'/images/winery/cover/',
            $photo = $request->get('wid') . '_' . uniqid(true) .'.jpg');

        Auth::user()->winery->where('id', $request->wid)->update(['cover' => $photo]);

        $path = public_path().'/images/winery/cover/' . $photo;
        Image::make($path)->encode('jpg')->fit(2000, 600, function ($c) {
            $c->upsize();
        })->save();

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
