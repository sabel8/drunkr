<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drinks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('type_id')->unsigned();
            $table->decimal('alcohol_percent', 5, 2)->unsigned();
            $table->integer('volume_unit_type_id')->unsigned();
            $table->decimal('volume_value', 6, 2)->unsigned();
            $table->integer('user_id')->unsigned()->nullable(true);
            $table->integer('place_id')->unsigned()->nullable(true);
            $table->integer('price')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drinks');
    }
}
