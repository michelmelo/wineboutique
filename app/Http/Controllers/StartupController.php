<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoRequest;
use App\Http\Requests\StartupRequest;
use App\Winery;
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
        $winery->state = $request->state;
        $winery->description = $request->description;
        $winery->save();

        return redirect()->route('profile.show');
    }
}
