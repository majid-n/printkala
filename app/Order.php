<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    # Relationship for Cat Model
    public function user() {
        return $this->belongsTo('App\User');
    }

    # Relationship for Like Model
    public function products(){
        return $this->hasMany('App\Product');
    }

}
