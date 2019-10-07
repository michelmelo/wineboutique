<?php

namespace App\Http\Controllers;

use App\WineImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PhotoRequest;
use Image;

class WineImageController extends Controller
{
    public function store(PhotoRequest $request)
    {
        $request->file('image')->move(storage_path() . '/app/public/images/', $picture = uniqid(true) . '.jpg');

        $data = $request->only(['cropx', 'cropy', 'cropwidth', 'cropheight']);

        $path = storage_path() . '/app/public/images/' . $picture;
        
        Image::make($path)
            ->crop($data["cropwidth"], $data["cropheight"], $data["cropx"], $data["cropy"])
            ->encode('jpg')->resize(null, 1200, function ($c) {
            $c->upsize();
        })->save();

        $data = [
            'source' => $picture
        ];

        $wineImage = WineImage::create($data);
        $wineImage->save();

        return $wineImage;
    }

    public function destroy(WineImage $wineImage)
    {
        return [
            'success' => $wineImage->delete()
        ];
    }
}