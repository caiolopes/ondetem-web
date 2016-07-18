<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');

            $table->string('name');
            $table->text('address');
            $table->string('phone')->nullable();
            $table->double('latitude');
            $table->double('longitude');
            $table->string('icon')->nullable();
            $table->string('url')->nullable();
            $table->string('website')->nullable();
            $table->integer('confirmations')->unsigned()->default(0);
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
        Schema::drop('places');
    }
}