<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PhotoRequest;
use App\Varietal;
use App\Wine;
use App\WineImage;
use App\Region;
use Image;
use Auth;

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
            'regions' => Region::all(),
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
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhotoRequest $request)
    {
        $varietal = Varietal::where('id', $request->varietal)->firstOrFail();
        $region = Region::where('id', $request->region)->firstOrFail();
        
        $data = [
            'name'          => $request->name,
            'price'       => $request->price,
            // 'quantity'         => $request->quantity,
            'description'       => $request->description,
            // 'varietal_id'          => $request->varietal,
            // 'region_id'         => $request->region,
        ];

        // $data = $request->only(['name', 'price', 'quantity', 'description', 'varietal', 'region']);

        if($request->hasFile('photo'))
        {
            $request->file('photo')->move(storage_path() . '/app/public/images', $photo = uniqid(true) . '.jpg');
            $path = storage_path() . '/app/public/images' . $photo;
            Image::make($path)->encode('jpg')->fit(700, 460, function ($c) {
                $c->upsize();
            })->save();
            $data['photo'] = $photo;
        }

        $wine = new Wine;
        $wine->fill($data);
        $wine->varietal()->associate($request->varietal);
        $wine->region()->associate($request->region);

        $wine = Auth::user()->winery->wines()->save($wine);

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

}
