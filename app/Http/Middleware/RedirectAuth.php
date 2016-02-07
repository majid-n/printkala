<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Illuminate\Http\Request;
use App\Http\Requests;

class RedirectAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle( Request $request, Closure $next )
    {
        if ( Sentinel::check() ) {

            if ( $request->ajax() ) return response('Unauthorized.', 401);
            else return redirect()->route('home')->with('fail', 'برای ورود به این بخش ابتدا از حساب کاربری خود خارج شوید.');
        }

        return $next($request);
    }
}