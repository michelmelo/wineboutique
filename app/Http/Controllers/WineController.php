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
        $wines = Wine::query();
        $varietals = Varietal::all();

        $filter = $request->all();

        if(array_key_exists('varietal', $filter)) {
            $wines = $wines->whereIn('varietal_id', $filter['varietal']);
        }

        $wines = $wines->paginate(8);

        return view('wines', [
            'wines' => $wines,
            'varietals' => $varietals,
            'filter' => $filter
        ]);
    }

    public function show(Wine $wine)
    {
        return view('wines-single', [
            'wine' => $wine
        ]);
    }
}
