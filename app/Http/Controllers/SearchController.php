<?php

namespace App\Http\Controllers;

use App\Wine;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Support\Facades\DB;
use Auth;

class SearchController extends Controller
{
    protected function fullTextWildcards($term)
    {
        // removing symbols used by MySQL
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $term = str_replace($reservedSymbols, '', $term);

        $words = explode(' ', $term);

        foreach($words as $key => $word) {
            /*
             * applying + operator (required word) only big words
             * because smaller ones are not indexed by mysql
             */
            if(strlen($word) >= 3) {
                $words[$key] = '+' . $word . '*';
            }
        }

        $searchTerm = implode( ' ', $words);

        return $searchTerm;
    }

    protected function expandResults($results) {
        $idList = [];
        foreach ($results as $result) {
            if($result->type==='WINE') {
                $idList[$result->id] = $result->id;
            }
            if($result->type==='WINERY') {
                unset($result->price);
            }
        }

        $wines = Wine::leftJoin('orders', 'wines.id', '=', 'orders.id')
            ->select(DB::raw('wines.*, count(orders.id) as orders_count'))
            ->whereIn('wines.id', array_keys($idList))
            ->groupBy('wines.id')
            ->get();

        foreach ($results as $result) {
            foreach ($wines as $wine) {
                if($result->id===$wine->id) {
                    if(Auth::user()) {
                        $result->favorited = $wine->favorited();
                    }
                    $result->rating = $wine->rating();
                    $result->orders_count = $wine->orders_count;
                    break;
                }
            }
        }

        return $results;
    }

    public function search(Request $request)
    {
        if(!$request->has('s')) 
        {
            return redirect('home');
        }

        $searchstr = $request->s;
        $page = 1;

        if($request->has('page')) $page = intval($request->page);

        $offset = ($page-1)*8;

        $searchableTerm = $this->fullTextWildcards($searchstr);
        $total = DB::selectOne('SELECT count(*) AS `total` FROM (SELECT `id`, `name`, `description`, \'WINE\' AS `type`, MATCH (name, description) AGAINST (? IN BOOLEAN MODE) AS `relevance` FROM `wines` UNION ALL SELECT `id`, `name`, `description`, \'WINERY\' AS `type`, MATCH (name, description) AGAINST (? IN BOOLEAN MODE) AS `relevance` FROM `wineries`) AS U WHERE `relevance` > 0', [$searchableTerm, $searchableTerm]);
        $results = DB::select('SELECT * FROM (SELECT `id`, `name`, `price`, `description`, `slug`, `photo`, \'WINE\' AS `type`, MATCH (name, description) AGAINST (? IN BOOLEAN MODE) AS `relevance` FROM `wines` UNION ALL SELECT `id`, `name`, \'UNUSED\' AS `unused1`, `description`, `slug`, `profile` AS `photo`, \'WINERY\' AS `type`, MATCH (name, description) AGAINST (? IN BOOLEAN MODE) AS `relevance` FROM `wineries`) AS U WHERE `relevance` > 0 ORDER BY `relevance` DESC LIMIT ?, 8', [$searchableTerm, $searchableTerm, $offset]);

        $results = new Paginator($results, $total->total, 8, $page, ["path" => "search", "query" => ["s" => $searchstr]]);

        $results = $this->expandResults($results);

        return view('search', [
            'searchstr' => $searchstr,
            'results' => $results
        ]);
    }
}
