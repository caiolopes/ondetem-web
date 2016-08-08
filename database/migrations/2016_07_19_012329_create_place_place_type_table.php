<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacePlaceTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place_place_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('place_id', 36);
            $table->integer('place_type_id')->unsigned();
            $table->unique(array('place_id', 'place_type_id'));
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
            $table->foreign('place_type_id')->references('id')->on('place_types')->onDelete('cascade');
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
        Schema::drop('place_place_type');
    }
}
