<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venues', function (Blueprint $table) {
            $table->increments('venue_id');
            $table->string('name');
            $table->string('friendly_url');
            $table->string('image');
            $table->longText('description');
            $table->string('phone');
            $table->string('web');
            $table->string('email');
            $table->string('location');
            $table->string('coordinates');
            $table->boolean('status');
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
        Schema::drop('venues');
    }
}
