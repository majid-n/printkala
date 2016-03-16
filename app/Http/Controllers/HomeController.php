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
		} else { $num = 0; }
		return view( 'welcome',compact('cats','products','num') );
	}

	# Retrieve Images
    public function retrieveImages($disk , $filename) {	
		$file 	= Storage::disk($disk)->get( $filename );
	    return $file;
	}

	
	public function addAddress( Request $request ) {
		$user = Sentinel::getUser();
		$rules = [ 'address' => 'min:10' ];
		$validator = Validator::make( $request->all(), $rules );
		$result = 2;
		$id = 'address'.$result;

		if ( $validator->fails() ) {
			if( $request->ajax() ) return response()->json([ 'result' => false ]);
			else return back()->withInput()
		                 	  ->withErrors($validator);
		}

		if ( !$user->address2 ) $user->address2 = $request->input('new');
		else {
			$user->address3 = $request->input('new');
			$result = 3;
			$id = 'address'.$result;
		}

		if ( $user->save() ) {
			if( $request->ajax() ) return response()->json([ 'result' => $user->$id, 'aid' => $result ]);
			else return back()->with('success', 'آدرس جدید اضافه شد.');
		}
	}

	public function cartDrop() {
		if ( $user = Sentinel::check() ) {
			$items = $user->baskets->where('order_id', 0);
			foreach ($items as $item) {
				$item->delete();
			}
			return redirect()->route('home');
		}
	}


	// public function productInfo( Product $product ) {
	// 	return view( 'product',compact('product') );
	// }

}
