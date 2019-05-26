<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    /* $table->bigIncrements('id');
    $table->string('name');
    $table->integer('type_id')->unsigned();
    $table->decimal('alcohol_percent', 5, 2)->unsigned();
    $table->integer('volume_unit_type_id')->unsigned();
    $table->integer('volume_value')->unsigned();
    $table->integer('user_id')->unsigned()->nullable(true);
    $table->integer('place_id')->unsigned()->nullable(true);
    $table->integer('price')->unsigned();
    $table->timestamps(); */
    protected $guarded = [
        'id','created_at','updated_at'
    ];

    public function place() {
        return $this->belongsTo('App\Place');
    }

    public function type() {
        return $this->belongsTo('App\DrinkType');
    }

    public function unitType() {
        return $this->belongsTo('App\UnitType', 'volume_unit_type_id', 'id');
    }

    public function netVolumeLiter() {
        return $this->volume_value * $this->unitType->multiplier;
    }

    public function drunkRFactor() {
        
	//var drunkRFactor = 1/(Number(volumeValue)*Number(unitMultiplier)* (Number(alcoholPercent)/100)) * price ;
        return (1 / ($this->netVolumeLiter() * ($this->alcohol_percent / 100)) * $this->price);
    }
}
