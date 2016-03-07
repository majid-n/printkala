<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use App\Cat;
use App\Product;

class AdminController extends Controller {

	public function productPage() {
		$default = [''=>'دســـته را انتخاب کنید'];
		$cats = Cat::lists('title', 'id');
		$listArray = $default + $cats->toArray();
		return view()->make('admin.addproduct', compact('listArray'));
	}

	public function addProduct( Request $request ) {

		$rules = array(
	        'product'		=> 'required',
	        'description'	=> 'required|min:5|max:200',
	        'category'		=> 'required|digits:1',
	        'size'			=> 'required',
	        'image'			=> 'required|mimes:jpg,jpeg,png',
	        'price'			=> 'required|numeric'
	    );

	    $validator = Validator::make($request->all(), $rules);

	    if ($validator->fails()) {
	        $errors = $validator->messages();

	        return back()
						 ->withInput()
						 ->withErrors($errors);

	    } else {

	    	if( $request->file('image')->isValid() ) {
	    	    $image      = $request->file('image');										# Image Object
	    	    $filename   = $image->getClientOriginalName();								# Image File Name
	    	    $savedimg   = $image->move( storage_path('app/posts') , $filename );		# Saved Image Address

	    	    # Create Post
	    	    $product = new Product;
	    	    $product->name 	 = $request->product;
	    	    $product->des 	 = $request->description;
	    	    $product->cat_id = $request->category;
	    	    $product->size 	 = $request->size;
	    	    $product->weight = $request->weight;
	    	    $product->price  = $request->price;
	    	    $product->pic 	 = $filename;
	    	    $product->active = ( !empty($request->active) ) ? $request->active : 0;

	    	    # Redirect on Success
	    	    if ( $product->save() ) {
	    	        return redirect()->route('product.post')->with('success', 'محصول با موفقیت ثبت شد.');
	    	    }
	    	}
		}

		return back()->withInput()
		             ->with('fail', 'مشکل در اتصال به سرور. لطفا مجددا تلاش کنید.');
	}
}
