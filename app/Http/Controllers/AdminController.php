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

	public function dashboard() {
		$orders = Order::all();
		return view()->make('admin.dashboard', compact('orders'));
	}

	# Ajax Show Units when cat selected
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