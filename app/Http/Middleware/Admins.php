<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admins
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
        if (Auth::user()->manager == 1 && Auth::user()->category == 'admin') {
            echo 'Bukan super admin';
            die;
        }

        return $next($request);
    }
}
