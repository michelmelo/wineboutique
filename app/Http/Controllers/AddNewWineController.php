<?php

namespace App\Http\Controllers;

use App\C;
use App\WineRegion;
use Illuminate\Http\Request;
use App\Http\Requests\NewWineRequest;
use App\Varietal;
use App\Wine;
use App\WineImage;
use App\Region;
use Illuminate\Http\Response;
use Image;
use Auth;
use App\CapacityUnit;
use Storage;
use App\Tag;
use Illuminate\Support\Str;

class AddNewWineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */

    public function __construct()
    {
        $this->middleware('seller');
    }

    public function index()
    {
        return view('add-new-wine', [
            'varietals' => Varietal::all(),
            'regions' => Region::orderBy('name')->get(),
            'wine_regions' => WineRegion::orderBy('name')->get(),
            'capacity_units' => CapacityUnit::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('add-new-wine', [
            'wines' => Wine::all(),
            'varietals' => Varietal::all(),
            'regions' => Region::orderBy('name')->get(),
            'wine_regions' => WineRegion::orderBy('name')->get(),
            'tags' => Tag::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(NewWineRequest $request)
    {
        $data = $request->only(['name', 'price', 'description', 'who_made_it', 'when_was_it_made', 'capacity', 'unit_id', 'wine_region_id', 'cropx', 'cropy', 'cropwidth', 'cropheight', 'quantity']);
        $data['price'] = number_format((float)$data['price'], 2, '.', '');

        if($request->hasFile('photo'))
        {
            $ext = $request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move(public_path().'/images/wine/', $photo = Str::slug($data['name']) . '_' . uniqid(true) . '.' . $ext);
            $path = public_path().'/images/wine/' . $photo;

            Image::make($path)
                ->save(public_path() . '/images/wine/original/' . $photo)
                ->crop($data["cropwidth"], $data["cropheight"], $data["cropx"], $data["cropy"])
                ->save($path);

            $data['photo'] = '/images/wine/' . $photo;
        }

        $wine = new Wine;
        $wine->fill($data);
        $wine->varietal()->associate($request->varietal);
        $wine->winery()->associate(Auth::user()->winery);

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

        if($request->tags) {
            $tags = explode(",", $request->tags);
            $wine->tag($tags);
        }

        $request->session()->put('msg', 'Wine successfully added!');
        return redirect('my-winery');
    }

    public function edit(Wine $wine)
    {
        $preloadedImages = $wine->wineImages->map(function($item, $key) {
            return [
                'path' => route('images.wine', ['filename' => $item->slug . '.jpg']),
                'id' => $item->id,
                'size' => Storage::size('public/images/' . $item->source)
            ];
        });

        return view('edit-wine', [
            'wine' => $wine,
            'preloadedImages' => $preloadedImages,
            'varietals' => Varietal::all(),
            'regions' => Region::orderBy('name')->get(),
            'wine_regions' => WineRegion::orderBy('name')->get(),
            'capacity_units' => CapacityUnit::all()
        ]);
    }

    public function update(NewWineRequest $request, Wine $wine)
    {
        $data = $request->only(['name', 'price', 'description', 'who_made_it', 'when_was_it_made', 'capacity', 'unit_id', 'wine_region_id', 'cropx', 'cropy', 'cropwidth', 'cropheight', 'quantity']);

        if($request->hasFile('photo')) {
            $ext = $request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move(public_path().'/images/wine/', $photo = Str::slug($data['name']) . '_' . uniqid(true) . '.' . $ext);
            $path = public_path().'/images/wine/' . $photo;

            Image::make($path)
                ->save(public_path() . '/images/wine/original/' . $photo)
                ->crop($data["cropwidth"], $data["cropheight"], $data["cropx"], $data["cropy"])
                ->save($path);

            $data['photo'] = '/images/wine/' . $photo;
        }

        $wine->update($data);
        $wine->varietal()->associate($request->varietal);
        $wine->winery()->associate(Auth::user()->winery);
        $wine->wineRegion()->associate($request->wine_region_id);
        $wine->save();

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

        return redirect('my-winery');
    }

    public function destroy($id)
    {
        $wine = Wine::find($id);
        $wine->delete();

        return redirect('my-winery');
    }

    public function image_destroy($id)
    {
        $wine = WineImage::find($id);
        $wine->delete();

        return redirect()->back();
    }

    public function hideMsg(Request $request) {
        $request->session()->forget('msg');
    }

}
