<?php

namespace App\Http\Controllers;

use App\Region;
use App\Varietal;
use App\WineImage;
use App\WineRegion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Wine;
use Illuminate\Support\Facades\DB;

class WineController extends Controller
{
    public function store(Request $request)
    {
        /*$photoName = Str::uuid() . "." . $request->file('photo')->extension();
        $request->photo->storeAs('public/images/wines', $photoName);

        $wine = Auth::user()->winery->wines()->create([
            'photo' => $photoName
        ]);

        return $wine;*/
        // protected $fillable = [
        //        'name', 'price', 'photo', 'quantity', 'description', 'who_made_it', 'when_was_it_made', 'capacity', 'unit_id', 'average_rating'
        //    ];
//        file_put_contents('logs.txt', $_SESSION['HTTP_REFERER']);

        return Auth::user()->winery->wines()->create([
            'name' => empty($request->get('name')) ? null : $request->get('name'),
            'price' => empty($request->get('price')) ? null : $request->get('price'),
            'photo' => empty($request->file('photo')) ? null : $request->file('photo'),
            'quantity' => empty($request->get('quantity')) ? null : $request->get('quantity'),
            'description' => empty($request->get('description')) ? null : $request->get('description'),
            'who_made_it' => empty($request->get('who_made_it')) ? null : $request->get('who_made_it'),
            'when_was_it_made' => empty($request->get('when_was_it_made')) ? null : $request->get('when_was_it_made'),
            'capacity' => empty($request->get('capacity')) ? null : $request->get('capacity'),
            'unit_id' => empty($request->get('unit_id')) ? null : $request->get('unit_id'),
            'average_rating' => empty($request->get('average_rating')) ? null : $request->get('average_rating')
        ]);

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
        $page_offset = 0;
        $page_limit = 12;

        if ($request->get('page_offset')) {
            $page_offset = $request->get('page_offset');
        }

        $wines = Wine::query();

        $wines = $wines->where("wines.quantity", ">", 0);

        $varietals = Varietal::all();
        $regions = WineRegion::all();

        $filter = $request->all();

        if(array_key_exists('varietal', $filter)) {
            $wines = $wines->whereIn('varietal_id', $filter['varietal']);
        }

        if(array_key_exists('region', $filter)) {
            $wines = $wines->whereIn('wine_region_id', $filter['region']);
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

        $wines = $wines
            ->leftJoin('orders', 'wines.id', '=', 'orders.id')
            ->select(DB::raw('wines.*, count(orders.id) as orders_count'))
            ->groupBy('wines.id')
            ->skip($page_offset)
            ->take($page_limit)
            ->get();

        foreach ($wines as $wine) {
            if (Auth::user()) {
                $wine->favorited = $wine->favorited();
            }
            $wine->rating = $wine->rating();
        }

        return $request->ajax() ? ['wines' => $wines] : view('wines', [
            'wines' => $wines,
            'varietals' => $varietals,
            'regions' => $regions,
            'filter' => $filter
        ]);
    }

    public function show($wine)
    {
        $wine = Wine::withTrashed()->where("slug", $wine)->first();

        return view('wines-single', [
            'wine' => $wine,
            'wine_images' => WineImage::where('wine_id', $wine->id)->get(),
            'orders_count' =>  DB::table('orders')
                ->selectRaw('COUNT(id) as cnt')
                ->where('id','=',$wine->id)
                ->first(),
            'recommendations' => $wine->similarWines(),
            'seo' => [
                'title' => $wine->name . ' | Wine Boutique',
                'description' => $wine->name . ' | Wine Boutique',
                'image' => url('') . $wine->photo
            ]
        ]);
    }

    public function varietals()
    {
        return Varietal::all();
    }

    public function topRated(Request $request)
    {
        $page_offset = 0;
        $page_limit = 12;
        if ($request->get('page_offset')&&$request->get('page_limit')) {
            $page_offset = $request->get('page_offset');
            $page_limit = $request->get('page_limit');
        }

        $wines = Wine::leftJoin('orders', 'wines.id', '=', 'orders.id')
            ->select(DB::raw('wines.*, count(orders.id) as orders_count'))
            ->groupBy('wines.id')
            ->where('average_rating', '>', 0)
            ->where('wines.quantity', '>', 0)
            ->orderBy('average_rating', 'desc');
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

        $wines = $wines
            ->skip($page_offset)
            ->take($page_limit)
            ->get();

        return $request->ajax() ? ['wines' => $wines] : view('wines', [
            'wines' => $wines,
            'varietals' => $varietals,
            'regions' => $regions,
            'filter' => $filter
        ]);
    }

    public function totalWines() {
        return Wine::count();
    }
}
