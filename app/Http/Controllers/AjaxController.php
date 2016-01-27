<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use Sentinel;
use App\Basket;
use App\Product;

class AjaxController extends Controller {

	public function addBasket(Request $request) {

		if ( Sentinel::check() && $request->ajax() && $request->isMethod('post')) {
		    if( $request->has('pid') ) {

		    	$totalCount = 0;
		    	$pid = intval( $request->input('pid') );
		    	$user = Sentinel::getUser()->id;
		    	$cart = Basket::where('user_id', '=', $user )
		    				  ->where('ordered', '=', 0 )
		    				  ->get();
		    	$exist = Basket::where('product_id', '=', $pid)
						    	->where('user_id', '=', $user )
						    	->where('ordered', '=', 0 )
						    	->first();

				foreach ($cart as $key) {
					$totalCount += $key->count * (Product::find($key->product_id)->price);
				}

				if($exist == null){

			    	$basket = new Basket;
			    	$basket->user_id = $user;
			    	$basket->product_id = $pid;
			    	$basket->count = 1;
			    	if ( $basket->save() ) {
			    		return  response()->json(
			    		            [
			    		            	'result' 	=> 'add', 
                                   		'cartdata'	=> view( 'cart', array( 'basket' => $cart, 'total' => $totalCount) )->render()
			    		            ]
			    		        );
			    	}
			    	
		    	} else {
			    	
		    		$exist->count += 1;
		    		if( $exist->save() ) {
			    		return  response()->json(
			    		            [
			    		                'result' 	=> 'update',
                                   		'cartdata'	=> view( 'cart', array( 'basket' => $cart, 'total' => $totalCount) )->render()
			    		            ]
			    		        );
		    		}
		    	}
		    }  
		}
		    
		return response()->json([ 'result' =>  false ]);
	}


	public function remBasket(Request $request) {
		if ( Sentinel::check() && $request->ajax() && $request->isMethod('post')) {
		    if( $request->has('pid') ) {

		    	$pid = intval( $request->input('pid') );
		    	$user = Sentinel::getUser()->id;
		    	$exist = Basket::where('user_id', '=', $user )
		    				  ->where('ordered', '=', 0 )
		    				  ->where('product_id', '=', $pid )
		    				  ->first();
		    	if($exist !== null){
		    		if($exist->delete()) {
		    			return response()->json([ 'delid' =>  $exist->product_id ]);
		    		}
		    	} 

		    }
		}
	}

}

