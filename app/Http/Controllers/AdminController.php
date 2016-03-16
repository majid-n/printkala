<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use App\Cat;
use App\Product;
use App\Price;
use App\Order;

class AdminController extends Controller {

	// public function productPage() {
	// 	$default = [''=>'دســـته را انتخاب کنید'];
	// 	$cats = Cat::lists('title', 'id');
	// 	$listArray = $default + $cats->toArray();
	// 	$products = Product::paginate(5);
	// 	return view()->make('admin.addproduct', compact('listArray','products'));
	// }

	public function dashboard() {
		$orders = Order::all();
		return view()->make('admin.dashboard', compact('orders'));
	}

	public function addProduct( Request $request ) {

		// $rules = [
	 //        'product'		=> 'required',
	 //        'description'	=> 'required|min:5|max:200',
	 //        'category'		=> 'required|digits:1',
	 //        'size'			=> 'required',
	 //        'image'			=> 'required|mimes:jpg,jpeg,png',
	 //        'price.*'		=> 'required|numeric'
	 //    ];

	 //    $validator = Validator::make($request->all(), $rules);

	 //    if ($validator->fails()) {
	 //        $errors = $validator->messages();
	 //        return back()
		// 				 ->withInput()
		// 				 ->withErrors($errors);
	 //    } else {

	 //    	if( $request->file('image')->isValid() ) {
	 //    	    $image      = $request->file('image');										# Image Object
	 //    	    $filename   = $image->getClientOriginalName();								# Image File Name
	 //    	    $savedimg   = $image->move( storage_path('app/posts') , $filename );		# Saved Image Address

	 //    	    # Create Post
	 //    	    $product 		 = new Product;
	 //    	    $product->name 	 = $request->product;
	 //    	    $product->des 	 = $request->description;
	 //    	    $product->cat_id = $request->category;
	 //    	    $product->size 	 = $request->size;
	 //    	    $product->weight = $request->weight;
	 //    	    $product->pic 	 = $filename;
	 //    	    $product->active = ( !empty($request->active) ) ? $request->active : 0;

	 //    	    # Redirect on Success
	 //    	    if ( $product->save() ) {
  //   	    	    foreach ($product->cat->units as $unit) {
  //   	    	    	$price 				= new Price;
  //   	    	    	$price->product_id 	= $product->id;
  //   	    	    	$price->unit_id 	= $unit->id;
  //   	    	    	$price->price 		= $request->price[$unit->id];
  //   	    	    	$price->save();
  //   	    	    }
	 //    	        return redirect()->route('product.post')->with('success', 'محصول با موفقیت ثبت شد.');
	 //    	    }
	 //    	}
		// }

		// return back()->withInput()
		//              ->with('fail', 'مشکل در اتصال به سرور. لطفا مجددا تلاش کنید.');
	}

	// Ajax Show Units when cat selected
	public function showUnits( Request $request ) {
		if ( $request->ajax() && $request->has('catid') ) {
			$units 	 = Cat::find( $request->input('catid') )->units;
			$content = "";
			$number  = 1;

			foreach ( $units as $unit ) {
				$content .= '<div>
							 	<span>'. $number . '. ' . $unit->title .'</span>
							 	<input type="text" name="price['. $unit->id .']" placeholder="قیمت">
							 	<small>ریال</small>
							 </div>';
				$number++;
			}
			$content .= '<button class="btn btn-sm btn-default"><i class="fa fa-fw fa-plus"></i> واحد جدید</button>';
			return $content;
		}

		return response()->json([ 'result' => false ]);
	}
}