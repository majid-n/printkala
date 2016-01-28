<?php
namespace App\Http\Controllers;

// use Illuminate\Foundation\Bus\DispatchesJobs;
// use Illuminate\Routing\Controller as BaseController;
// use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
// use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
// use Illuminate\Database\Eloquent\ModelNotFoundException;
// use Input;
// use Validator;
// use Sentinel;
// use Activation;
// use Mail;
// use App\Blog;
use App\Product;
use App\Cat;
use App\Basket;
use Sentinel;
use View;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller {


	public function __construct() {
		
	}

	public function welcome() {
		$totalCount = 0;
		$cats = Cat::all();
		$products = Product::where('active', 1)->get();
		return view()->make('welcome',compact('cats','products'));
	}

}
