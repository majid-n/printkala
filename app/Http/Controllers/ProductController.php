<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Cat;
use App\Product;
use App\Price;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listArray = [''=>'دســـته را انتخاب کنید'] + Cat::lists('title', 'id')->toArray();
        $products = Product::orderBy('id','desc')->paginate(10);
        return view()->make('admin.addproduct', compact('listArray','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
		$rules = [
	        'product'		=> 'required',
	        'description'	=> 'required|min:5|max:200',
	        'category'		=> 'required|digits:1',
	        'size'			=> 'required',
	        'image'			=> 'required|mimes:jpg,jpeg,png',
	        'price.*'		=> 'required|numeric'
	    ];

	    $validator = Validator::make($request->all(), $rules);

	    if ($validator->fails()) {
	        $errors = $validator->messages();
	        return back()->withInput()
						 ->withErrors($errors);
	    } else {

	    	if( $request->file('image')->isValid() ) {
	    	    $image      = $request->file('image');										# Image Object
	    	    $filename   = $image->getClientOriginalName();								# Image File Name
	    	    $savedimg   = $image->move( storage_path('app/posts') , $filename );		# Saved Image Address

	    	    # Create Post
	    	    $product 		 = new Product;
	    	    $product->name 	 = $request->product;
	    	    $product->des 	 = $request->description;
	    	    $product->cat_id = $request->category;
	    	    $product->size 	 = $request->size;
	    	    $product->weight = $request->weight;
	    	    $product->pic 	 = $filename;
	    	    $product->active = (boolean) $request->active;

	    	    # Redirect on Success
	    	    if ( $product->save() ) {
    	    	    foreach ($product->cat->units as $unit) {
    	    	    	$price 				= new Price;
    	    	    	$price->product_id 	= $product->id;
    	    	    	$price->unit_id 	= $unit->id;
    	    	    	$price->price 		= $request->price[$unit->id];
    	    	    	$price->save();
    	    	    }
	    	        return redirect()->route('product.create')->with('success', 'محصول با موفقیت ثبت شد.');
	    	    }
	    	}
		}

		return back()->withInput()
		             ->with('fail', 'مشکل در اتصال به سرور. لطفا مجددا تلاش کنید.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( Product $product )
    {
        return view( 'product',compact('product') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Product $product, Request $request )
    {
        if( $product->delete() ) {

            if( $request->ajax() ) return response()->json([ 'delid' => $product->id ]);
            else return back()->with('success', 'محصول از سبد خرید حذف شد.');
        }

        if( $request->ajax() ) return response()->json([ 'result' => false ]);
        else return redirect()->home()->with('fail', 'خطا در اتصال به پایگاه داده.');
    }
}
