<?php

namespace App\Http\Controllers;

use App\Country;
use App\Currency;
use App\Http\Requests\StartupRequest;
use App\Language;
use Illuminate\Support\Facades\Auth;


class StartupController extends Controller
{
    public function show()
    {
        $wineryName = Auth::user()->winery->name;

        return view('startup', [
            'wineryName' => $wineryName
        ]);
    }

    public function store(StartupRequest $request)
    {
        $winery = Auth::user()->winery;

        $winery->name = $request->wineryName;
        $winery->language()->associate(Language::find($request->language));
        $winery->country()->associate(Country::find($request->country));
        $winery->currency()->associate(Currency::find($request->currency));
        $winery->save();

        return redirect()->route('profile');
    }
}
