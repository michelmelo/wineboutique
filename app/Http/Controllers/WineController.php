<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewWineRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Wine;

class WineController extends Controller
{
    public function store(NewWineRequest $request)
    {
        $photoPath = $request->photo->store('public/images/wines');

        $wine = Auth::user()->winery->wines()->create([
            'photo' => $photoPath
        ]);

        return $wine;
    }

    public function update(Request $request, Wine $wine)
    {
        $wine->update($request->all());
    }

    public function delete(Wine $wine)
    {
        $wine->delete();
    }

    public function clone(Wine $wine)
    {
        $newWine = $wine->replicate();
        $newWine->save();
        return $newWine;
    }
}
