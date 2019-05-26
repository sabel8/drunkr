<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrinkType extends Model
{
    protected $table = "drink_types";
    protected $fillable = ['name'];
    public $timestamps = false;
}
