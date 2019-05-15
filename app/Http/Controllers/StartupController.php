<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoRequest;
use App\Http\Requests\StartupRequest;
use App\Winery;
use Illuminate\Support\Facades\Auth;
use App\Region;


class StartupController extends Controller
{
    public function show()
    {
        $winery = Auth::user()->winery;

        return view('startup', [
            'wineryId' => $winery->id,
            'wineryName' => $winery->name,
            'winery_desc' => $winery->description,
            'winery_profile' => $winery->profile,
            'winery_cover' => $winery->cover,
            'regions' => Region::orderBy('name')->get()
        ]);
    }

    public function store(StartupRequest $request)
    {
        $winery = Auth::user()->winery;

        $winery->name = $request->wineryName;
        $winery->state = $request->state;
        $winery->description = $request->description;
        $winery->save();

        $winery->regions()->sync($request->regions);

        return redirect()->route('profile.show');
    }
}
