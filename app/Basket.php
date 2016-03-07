<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Basket extends Model
{
    protected $table = 'baskets';

    # Relationship for Cat Model
    public function user() {
        return $this->belongsTo('App\User');
    }

    # Relationship for Cat Model
    public function products() {
        return $this->hasMany('App\Product', 'id', 'product_id');
    }

}