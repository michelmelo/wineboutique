<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PhotoRequest;
use App\Http\Requests\NewWineRequest;
use App\Varietal;
use App\Wine;
use App\WineImage;
use App\Region;
use Image;
use Auth;
use App\CapacityUnit;
use App\WineShipping;
use Storage;
use App\Tag;

class AddNewWineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('seller');
    }

    public function index()
    {
        return view('add-new-wine', [
            'varietals' => Varietal::all(),
            'regions' => Region::all(),
            'capacity_units' => CapacityUnit::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add-new-wine', [
            'wines' => Wine::all(),
            'varietals' => Varietal::all(),
            'regions' => Region::all(),
            'tags' => Tag::all(),
            'wine_shippings' => WineShipping::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewWineRequest $request)
    {
        $data = $request->only(['name', 'price', 'description', 'who_made_it', 'when_was_it_made', 'capacity', 'unit_id']);
        
        if($request->hasFile('photo'))
        {
            $request->file('photo')->move(storage_path() . '/app/public/images', $photo = uniqid(true) . '.jpg');
            $path = storage_path() . '/app/public/images/' . $photo;
            #dd($path);
            Image::make($path)->encode('jpg')->fit(700, 460, function ($c) {
                $c->upsize();
            })->save();
            $data['photo'] = $photo;
        }
        
        // dd($data);
        // dd($request->all());
        
        $wine = new Wine;
        $wine->fill($data);
        $wine->varietal()->associate($request->varietal);
        // $wine->region()->associate($request->region);
        $wine->winery()->associate(Auth::user()->winery);
        
        $wine->save();

        foreach($request->get("shipping") as $shippingItem) {
            $shippingItem['day_week'] = $shippingItem['day_week'] == 'day';
            if(!isset($shippingItem['free'])) $shippingItem['free'] = false;
            if($shippingItem['free'] === 'on') $shippingItem['free'] = true;
            $shippingTest = $wine->wineShippings()->create($shippingItem);
            // dd($shippingTest);
        }

        $images = [];

        if($request->has('images')) {
            $images = $request->images;
        }

        WineImage::whereIn("id", $images)->update(["wine_id" => $wine->id]);
        $wineImages = WineImage::whereIn("id", $images)->get();

        foreach($wineImages as $wineImage) {
            $wineImage->update([]);
        }


        // $input = $request->all();
        $tags = explode(",", $request->tags);
        
        // $wine = Wine::create($input);
        $wine->tag($tags);

        return redirect()->route('add-new-wine.index');

    }

    public function edit(Wine $wine)
    {

       # dd($wine);
        $preloadedImages = $wine->wineImages->map(function($item, $key) {
            return [
                'path' => route('images.wine', ['filename' => $item->slug . '.jpg']),
                'id' => $item->id,
                'size' => Storage::size('public/images/' . $item->source)
            ];
        });
        #dd($wine->name);
        return view('edit-wine', [
            'wine' => $wine,
            'preloadedImages' => $preloadedImages,
            // 'wines' => Wine::all(),
            'varietals' => Varietal::all(),
            'regions' => Region::all(),
            // 'tags' => Tag::all(),
            //'wine_shippings' => WineShipping::all(),
            'capacity_units' => CapacityUnit::all()
        ]);
    }

    public function update(NewWineRequest $request, Wine $wine)
    {
        $data = $request->only(['name', 'price', 'description', 'who_made_it', 'when_was_it_made', 'capacity', 'unit_id']);

        if($request->hasFile('photo')) {
            $request->file('photo')->move(storage_path() . '/app/public/images', $photo = uniqid(true) . '.jpg');
            $path = storage_path() . '/app/public/images/' . $photo;
            Image::make($path)->encode('jpg')->fit(700, 460, function ($c) {
                $c->upsize();
            })->save();
            $data['photo'] = $photo;
        }

        // dd($request->all());

        // $wine = new Wine;
        $wine->update($data);
        $wine->varietal()->associate($request->varietal);
        // $wine->region()->associate($request->region);
        $wine->winery()->associate(Auth::user()->winery);
        
        $wine->save();

        foreach($request->get("shipping") as $shippingItem) {
            $shippingItem['day_week'] = $shippingItem['day_week'] == 'day';
            if(!isset($shippingItem['free'])) $shippingItem['free'] = false;
            if($shippingItem['free'] === 'on') $shippingItem['free'] = true;
            if($shippingItem['free'] === true) $shippingItem['price'] = null;
            if($shippingItem['free'] === true) $shippingItem['additional'] = null;
            $wineShippingData = [
                'location' => $shippingItem["location"],
                'from' => $shippingItem["from"],
                'to' => $shippingItem["to"],
                'day_week' => $shippingItem["day_week"],
                'destination' => $shippingItem["destination"],
                'price' => $shippingItem["price"],
                'additional' => $shippingItem["additional"],
                'free' => $shippingItem["free"]
            ];
            $shippingTest = $wine->wineShippings()->where('id', $shippingItem["id"])->update($wineShippingData);
            // dd($shippingTest);
        }

        $images = [];

        if($request->has('images')) {
            $images = $request->images;
        }

        if($request->has('delete_images')) {
            WineImage::destroy($request->delete_images);
        }

        WineImage::whereIn("id", $images)->update(["wine_id" => $wine->id]);
        $wineImages = WineImage::whereIn("id", $images)->get();

        foreach($wineImages as $wineImage) {
            $wineImage->update([]);
        }

        $tags = explode(",", $request->tags);
        $wine->retag($tags);
        
        return redirect('my_winery');

    }

    public function destroy($id)
    {
        // delete
        $wine = Wine::find($id);
        $wine->delete();

        return redirect('my_winery');
    
    }

}
