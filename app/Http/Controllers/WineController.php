<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewWineRequest;
use App\Varietal;
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

    public function list(Request $request)
    {
        $wines = Wine::paginate(8);
        $varietals = Varietal::all();
        return view('wines', [
            'wines' => $wines,
            'varietals' => $varietals
        ]);
    }
}
