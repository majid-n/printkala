<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
// use App\Product;
// use Sentinel;

class Basket extends Model
{
    protected $table = 'baskets';

    public function product($typ){
    	if ($typ === 'name') {
    		return DB::table('products')
                    ->where('id', '=', $this->product_id)
                    ->value('name');
    	}
    	if ($typ === 'price') {
        	return $price = DB::table('products')
                        ->where('id', '=', $this->product_id)
                        ->value('price');
        }

    }

}


