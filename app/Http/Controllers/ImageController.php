<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\WineImage;

class ImageController extends Controller {

    // public function wineImage($slug)
    // {
    //     $storagePath = storage_path() . '/app/public/images/test.jpg';

    //     return Image::make($storagePath)->response();
    // }

    public function wineImage($filename)
    {
        $slug = str_replace(".jpg", "", $filename);

        $wine = WineImage::where('slug', $slug)->first();

        if($wine) {
            $path = storage_path() . '/app/public/images/' . $wine->source;
        } else {
            $path = public_path("img/placeholder.png");
        }

        #dd($path);

        return Image::make($path)->response();
    }
}
