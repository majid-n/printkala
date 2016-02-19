<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'products';


    # Relationship for Cat Model
    public function cat() {
        return $this->belongsTo('App\Cat');
    }

    # Relationship for Cat Model
    public function basket() {
        return $this->belongsTo('App\Basket', 'product_id', 'id');
    }


}
