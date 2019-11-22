<?php

namespace App\Http\Middleware;

use Closure;

class Startup
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = app('Illuminate\Contracts\Auth\Guard')->user();
        if($user && $user->type == 'SELLER' && $user->completed == 0 && $_SERVER['REQUEST_URI'] !== '/startup') {
            return redirect('/startup');
        }

        return $next($request);
    }
}
