<?php

namespace App\Http\Controllers;

use App\C;
use App\WineImage;
use App\Http\Requests\PhotoRequest;
use Image;
use Illuminate\Http\Request;

class WineImageController extends Controller
{
    public function store(PhotoRequest $request)
    {
        $ext = $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path().'/images/wine/', $picture =  uniqid(true) . '.' . $ext);
        $path = public_path().'/images/wine/' . $picture;

        Image::make($path)->resize(C::$wineX, C::$wineY,
            function ($constraint) {
                $constraint->aspectRatio()->downsize();
            })
            ->save($path);

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

    public function cropImage(Request $request) {
        $path = public_path() . $request->get('imgPath');
        $dimensions = $request->get('dimensions');

        Image::make($path)->crop((int)$dimensions['w'], (int)$dimensions['h'],
            (int)$dimensions['x'], (int)$dimensions['y'])
            ->save($path);
    }
}