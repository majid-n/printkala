<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use Sentinel;
use App\Basket;
use App\Product;
use DB;

class AjaxController extends Controller {

	public function addBasket( Request $request ) {

		if ( Sentinel::check() && $request->ajax() && $request->isMethod('post')) {
		    if( $request->has('pid') ) {

		    	$pid = intval( $request->input('pid') );
		    	$user = Sentinel::getUser()->id;

		    	$exist = Basket::where('product_id', '=', $pid)
						    	->where('user_id', '=', $user )
						    	->where('ordered', '=', 0 )
						    	->first();

				if($exist == null){

			    	$basket = new Basket;
			    	$basket->user_id = $user;
			    	$basket->product_id = $pid;
			    	$basket->count = 1;
			    	if ( $basket->save() ) {
			    		return  response()->json([ 'result' => 'add' ]);
			    	}

		    	} else {
			    	
		    		$exist->count += 1;
		    		if( $exist->save() ) {
						return  response()->json([ 'result' => 'update' ]);
		    		}
		    	}
		    }  
		}
		    
		return response()->json([ 'result' =>  false ]);
	}


	public function remBasket( Request $request ) {
		if ( Sentinel::check() && $request->ajax() && $request->isMethod('post') ) {
		    if( $request->has('pid') ) {

		    	$pid = intval( $request->input('pid') );
		    	$user = Sentinel::getUser()->id;
		    	$exist = Basket::where('user_id', $user )
		    				   ->where('ordered', 0 )
		    				   ->where('product_id', $pid )
		    				   ->first();
		    	if( $exist !== null ){
		    		if( $exist->delete() ) {
		    			return response()->json([ 'delid' =>  $exist->product_id, 'result' => true ]);
		    		}
		    	} else {
		    		return response()->json([ 'result' => false ]);	
		    	} 

		    }
		}
	}


	public function loadbasket(Request $request) {
		if ( Sentinel::check() && $request->ajax() && $request->isMethod('post')) {

			$totalprice = 0;
			$items = Basket::select(DB::raw('products.price,products.name,products.pic,baskets.count,baskets.product_id,baskets.count*products.price as total'))
					->join('products', 'products.id', '=', 'baskets.product_id')
					->where('baskets.user_id', '=',Sentinel::getUser()->id)
					->get();

			$num = Basket::where('user_id', Sentinel::getUser()->id)
						 ->where('ordered', 0)
						 ->count();

			foreach ($items as $item) {
				$totalprice += $item->total;
			}

			return  response()->json(
	            [
	                'result' 	=> true,
	                'count'		=> $num,
               		'cartdata'	=> view( 'cart', array( 'items' => $items, 'total' => $totalprice) )->render()
	            ]
	        );
		}
	}

}
