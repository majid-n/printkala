<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Bus\DispatchesJobs;
// use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
// use Cartalyst\Sentinel\Checkpoints\ThrottlingException;

use Illuminate\Support\Facades\Input;
use Validator;
// use Sentinel;
// use Activation;
// use Mail;
// use Request;
// use Redirect;
use App\Cat;
use App\Product;

class AdminController extends Controller {

	public function productPage() {
		$default = [''=>'دســـته را انتخاب کنید'];
		$cats = Cat::lists('title', 'id');
		$listArray = $default + $cats->toArray();
		return view()->make('admin.addproduct', compact('listArray'));
	}

	public function addProduct() {

		$rules = array(
	        'product'		=> 'required',
	        'description'	=> 'required|min:5|max:200',
	        'category'		=> 'required|digits:1',
	        'size'			=> 'required',
	        'pic'			=> 'required',
	        'price'			=> 'required|numeric'
	    );

	    $validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails()) {
	        $errors = $validator->messages();

	        return redirect()->back()
							 ->withInput()
							 ->withErrors($errors);

	    } else {

			$product = new Product;
			$product->name 	 = Input::get('product');
			$product->des 	 = Input::get('description');
			$product->cat_id = Input::get('category');
			$product->size 	 = Input::get('size');
			$product->weight = Input::get('weight');
			$product->price  = Input::get('price');
			$product->pic 	 = Input::get('pic');
			$product->active = Input::get('active');

			if ( $product->save() ) {
				return Redirect()->to('admin/product')
								 ->withSuccess('محصول با موفقیت ثبت شد.');
			}

			
		}

	}

}
