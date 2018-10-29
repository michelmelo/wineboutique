<?php

namespace App\Http\Controllers;

use App\Wine;
use App\Winery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
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

    public function index()
    {
        $searchableTerm = $this->fullTextWildcards('123');

        $total = DB::selectOne('SELECT count(*) AS `total` FROM (SELECT `id`, `name`, `description`, \'WINE\' AS `type`, MATCH (name, description) AGAINST (?) AS `relevance` FROM `wines` UNION ALL SELECT `id`, `name`, `description`, \'WINERY\' AS `type`, MATCH (name, description) AGAINST (?) AS `relevance` FROM `wineries`) AS U WHERE `relevance` > 0', [$searchableTerm, $searchableTerm]);


        dd($total);
    }
}
