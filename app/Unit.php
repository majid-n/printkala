<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    public function cats(){
        return $this->belongsToMany('App\Cat', 'unit_cats');
    }

    // public function price() {
    //     return $this->hasOne('App\Price');
    // }

}
