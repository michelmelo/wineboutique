<?php

namespace App\Http\Controllers;

use App\C;
use Illuminate\Http\Request;
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
use Illuminate\Support\Str;

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
        //file_put_contents('./logs.txt', 'index');
        return view('add-new-wine', [
            'varietals' => Varietal::all(),
            'regions' => Region::orderBy('name')->get(),
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
            'regions' => Region::orderBy('name')->get(),
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
    public function store(Request $request)
    {
        $data = $request->only(['name', 'price', 'description', 'who_made_it', 'when_was_it_made', 'capacity', 'unit_id']);
        $data['price'] = number_format((float)$data['price'], 2, '.', '');
        
        if($request->hasFile('photo'))
        {
            $ext = $request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move(public_path().'/images/wine/', $photo = Str::slug($data['name']) . '_' . uniqid(true) . '.' . $ext);
            $path = public_path().'/images/wine/' . $photo;

//            Image::make($path)->encode($ext)->resize(C::$wineX, C::$wineY)->save();


            Image::make($path)->resize(C::$wineX, C::$wineY,
                function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($path);


            $data['photo'] = '/images/wine/' . $photo;
        }
        
        $wine = new Wine;
        $wine->fill($data);
        $wine->varietal()->associate($request->varietal);
        // $wine->region()->associate($request->region);
        $wine->winery()->associate(Auth::user()->winery);

        //INIT hasFile wineSaved \nshipping
        
        $wine->save();

        foreach($request->get("shipping") as $shippingItem) {
            $shippingItem['day_week'] = $shippingItem['day_week'] == 'day';
            if(!isset($shippingItem['free'])) $shippingItem['free'] = false;
            if($shippingItem['free'] === 'on') $shippingItem['free'] = true;
            $shippingItem['location'] = empty($request->get('location')) ? '' : $request->get('location');
            $shippingItem['destination'] = empty($request->get('destination')) ? '' : $request->get('destination');
            $shippingTest = $wine->wineShippings()->create($shippingItem);
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
        if($request->tags) {
            $tags = explode(",", $request->tags);
            $wine->tag($tags);
        }


        $request->session()->put('msg', 'Wine successfully added!');
        return redirect('my_winery');

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
            'regions' => Region::orderBy('name')->get(),
            // 'tags' => Tag::all(),
            //'wine_shippings' => WineShipping::all(),
            'capacity_units' => CapacityUnit::all()
        ]);
    }

    public function update(NewWineRequest $request, Wine $wine)
    {
        $data = $request->only(['name', 'price', 'description', 'who_made_it', 'when_was_it_made', 'capacity', 'unit_id']);

        if($request->hasFile('photo')) {
            $ext = $request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move(public_path().'/images/wine/', $photo = Str::slug($data['name']) . '_' . uniqid(true) . '.' . $ext);
            $path = public_path().'/images/wine/' . $photo;

//            Image::make($path)->encode($ext)->resize(C::$wineX, C::$wineY)->save();
            Image::make($path)->resize(C::$wineX, C::$wineY,
                function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($path);

            $data['photo'] = '/images/wine/' . $photo;
        }

        $wine->update($data);
        $wine->varietal()->associate($request->varietal);
        $wine->winery()->associate(Auth::user()->winery);

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

        if($request->tags) {
            $tags = explode(",", $request->tags);
            $wine->retag($tags);
        }
        
        return redirect('my_winery');

    }

    public function destroy($id)
    {
        $wine = Wine::find($id);
        $wine->delete();

        return redirect('my_winery');
    }

    public function hideMsg(Request $request) {
        $request->session()->forget('msg');
    }

}
