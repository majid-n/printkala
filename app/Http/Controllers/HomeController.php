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


class HomeController extends Controller {


	public function __construct() {
		# Construct Function
	}

	public function welcome() {
		$cats = Cat::all();
		$products = Product::where('active', 1)->get();
		if ( Sentinel::check() ) {
			$num = Basket::where('user_id', Sentinel::getUser()->id)
			             ->where('ordered', 0)
			             ->count();
		} else { $num = 0; }
		
		return view( 'welcome',compact('cats','products','num') );
	}

}
