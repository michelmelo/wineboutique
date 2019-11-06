<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoRequest;
use App\Wine;
use App\Winery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function list(Request $request)
    {
        $page_offset = 0;
        $page_limit = 8;

        if ($request->get('page_offset')&&$request->get('page_limit')) {
            $page_offset = $request->get('page_offset');
            $page_limit = $request->get('page_limit');
        }

        $wineries = Winery::with('wines')->get();
        $wineries = $wineries->sortByDesc(function ($winery) {
            return $winery->rating();
        });

        $wineries = $wineries->slice($page_offset, $page_limit);

        return  $request->ajax() ? ['wineries' => $wineries] : view('wineries', [
            'wineries' => $wineries,
            'seo' => [
                'title' => 'Wineries | Wine Boutique',
            ]
        ]);
    }

    public function show(Winery $winery)
    {
        return view('winery', [
            'winery' => $winery,
            'seo' => [
                'title' => $winery->name . ' | Wine Boutique',
                'description' => $winery->name . ' | Wine Boutique',
                'image' => url('') . '/images/winery/profile/' . $winery->profile
            ]
        ]);
    }

    public function totalWineries() {
        return Winery::count();
    }
}
