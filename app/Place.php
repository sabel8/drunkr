<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    public function drinks() {
        return $this->hasMany('App\Drink','place_id','id');
    }

    protected $guarded = [
        'id','created_at','updated_at'
    ];
}
