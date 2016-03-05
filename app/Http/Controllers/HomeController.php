<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Product;
use App\Cat;
use App\Basket;
use Sentinel;
use View;
use Storage;


class HomeController extends Controller {


	public function __construct() {
		# Construct Function
	}

	public function welcome() {
		$cats = Cat::all();
		$products = Product::where('active', 1)->get();
		if ( $user = Sentinel::check() ) {
			$num = $user->baskets()->where('order_id', 0)
			                       ->count();
			// $num = Basket::where('user_id', $user->id)
			//              ->where('order_id', 0)
			//              ->count();
		} else { $num = 0; }
		
		return view( 'welcome',compact('cats','products','num') );
	}

	# Retrieve Images
    public function retrieveImages($disk , $filename) {	
		$file 	= Storage::disk($disk)->get( $filename );
	    return $file;
	}

}
