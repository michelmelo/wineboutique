<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NavigationComposer
{
    public function compose(View $view)
    {
        $view->with('cartCount', Auth::check()?Auth::user()->cart()->count():0);
    }
}
