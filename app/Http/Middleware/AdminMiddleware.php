<?php 

namespace App\Http\Middleware;

use Sentinel;
use Closure;

class AdminMiddleware {

	public function handle( $request, Closure $next )	{

		if ( Sentinel::check() ) {

			if ( !Sentinel::inRole('admins') ) {
				return redirect()->route('home')->with('fail', 'شما امکان دسترسی به این محدوده را ندارید.');
			}

		}

		return $next($request);
	}
}	

