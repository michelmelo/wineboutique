<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Language;

class LanguageController extends Controller
{
    public function list()
    {
        return Language::all();
    }
}
