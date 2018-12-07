<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PhotoRequest;
use App\Varietal;
use App\Wine;
use App\WineImage;
use Image;

class AddNewWineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('add-new-wine', [
            'varietals' => Varietal::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add-new-wine');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhotoRequest $request)
    {
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

        return redirect()->route('add-new-wine.index');
    }

    // public function edit(wine $wine)
    // {
    //     $preloadedImages = $wine->wineImages->map(function($item, $key) {
    //         return [
    //             'path' => route('images.wine', ['filename' => $item->slug . '.jpg']),
    //             'id' => $item->id,
    //             'size' => Storage::size('public/' . $item->source)
    //         ];
    //     });

    //     return view('admin.portfolio.edit', [
    //         'portfolio' => $portfolio,
    //         'preloadedImages' => $preloadedImages
    //     ]);
    // }

    // public function update(PhotoRequest $request, Wine $wine)
    // {
    //     $data = $request->only(['name', 'category', 'details', 'link']);

    //     if($request->hasFile('thumbnail')) {
    //         $request->file('thumbnail')->move(storage_path() . '/app/public', $thumbnail = uniqid(true) . '.jpg');
    //         $path = storage_path() . '/app/public/' . $thumbnail;
    //         Image::make($path)->encode('jpg')->fit(700, 460, function ($c) {
    //             $c->upsize();
    //         })->save();
    //         $data['thumbnail'] = $thumbnail;
    //     }

    //     if($request->hasFile('cover')) {
    //         $request->file('cover')->move(storage_path() . '/app/public', $cover = uniqid(true) . '.jpg');
    //         $path = storage_path() . '/app/public/' . $cover;
    //         Image::make($path)->encode('jpg')->fit(1080, 1080, function ($c) {
    //             $c->upsize();
    //         })->save();
    //         $data['cover'] = $cover;
    //     }

    //     $portfolio->update($data);
    //     $portfolio->save();

    //     $images = [];

    //     if($request->has('images')) {
    //         $images = $request->images;
    //     }

    //     if($request->has('delete_images')) {
    //         PortfolioImage::destroy($request->delete_images);
    //     }

    //     PortfolioImage::whereIn("id", $images)->update(["portfolio_id" => $portfolio->id]);
    //     $portfolioImages = PortfolioImage::whereIn("id", $images)->get();

    //     foreach($portfolioImages as $portfolioImage) {
    //         $portfolioImage->update([]);
    //     }

    //     return redirect()->route('admin.portfolio.index');
    // }

    // public function destroy(Portfolio $portfolio)
    // {
    //     //
    // }

}
