<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    protected $table = 'cats';

    # Relationship for Like Model
    public function products(){
        return $this->hasMany('App\Product');
    }
}
