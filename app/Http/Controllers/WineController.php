<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoRequest;
use App\Region;
use App\Varietal;
use App\WineRegion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Wine;
use Illuminate\Support\Str;
use App\WineImage;

class WineController extends Controller
{
    public function store(PhotoRequest $request)
    {
        $photoName = Str::uuid() . "." . $request->file('photo')->extension();
        $request->photo->storeAs('public/images/wines', $photoName);

        $wine = Auth::user()->winery->wines()->create([
            'photo' => $photoName
        ]);

        $data = $request->only(['name', 'price', 'quantity', 'description']);

        $request->file('photo')->move(storage_path() . '/app/public', $photo = uniqid(true) . '.jpg');
        $path = storage_path() . '/app/public/' . $photo;
        Image::make($path)->encode('jpg')->fit(700, 460, function ($c) {
            $c->upsize();
        })->save();

        $data['photo'] = $photo;

        $wine = Wine::create($data);
        $wine->save();

        $images = [];

        if($request->has('images')) {
            $images = $request->images;
        }

        WineImage::whereIn("id", $images)->update(["wine_id" => $wine->id]);
        $wineImages = WineImage::whereIn("id", $images)->get();

        foreach($wineImages as $wineImage) {
            $wineImage->update([]);
        }

        return $wine;
    }

    public function update(Request $request, $id)
    {
        $wine = Wine::findOrFail($id);
        $wine->update($request->all());
        if($request->varietal_id) {
            $wine->varietal()->associate(Varietal::find($request->varietal_id));
        }
        if($request->region_id) {
            $wine->region()->associate(Region::find($request->region_id));
        }
        $wine->save();
    }

    public function delete($id)
    {
        $wine = Wine::findOrFail($id);
        $wine->delete();
    }

    public function clone($id)
    {
        $wine = Wine::findOrFail($id);
        $newWine = $wine->replicate();
        $newWine->save();
        return $newWine;
    }

    public function list(Request $request)
    {
        $wines = Wine::query();
        $varietals = Varietal::all();
        $regions = Region::all();

        $filter = $request->all();

        if(array_key_exists('varietal', $filter)) {
            $wines = $wines->whereIn('varietal_id', $filter['varietal']);
        }

        if(array_key_exists('region', $filter)) {
            $wines = $wines->whereIn('region_id', $filter['region']);
        }

        if(array_key_exists('price', $filter)) {
            $prices = $filter['price'];
            $wines = $wines->where(function($q) use ($prices) {
                $useOr = false;
                if(in_array(1, $prices)) {
                    $q->whereBetween('price', [1, 50]);
                    $useOr = true;
                }

                if(in_array(2, $prices)) {
                    $useOr?$q->orWhereBetween('price', [51, 100]):$q->whereBetween('price', [51, 100]);
                    $useOr = true;
                }

                if(in_array(3, $prices)) {
                    $useOr?$q->orWhere('price', '>', 100):$q->where('price', '>', 100);
                }
            });
        }

        $wines = $wines->paginate(8);

        return view('wines', [
            'wines' => $wines,
            'varietals' => $varietals,
            'regions' => $regions,
            'filter' => $filter
        ]);
    }

    public function show(Wine $wine)
    {
        return view('wines-single', [
            'wine' => $wine
        ]);
    }

    public function varietals()
    {
        return Varietal::all();
    }
}
