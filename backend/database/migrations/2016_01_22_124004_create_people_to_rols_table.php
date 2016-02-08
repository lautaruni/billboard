<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopletoRolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people_to_rols', function (Blueprint $table) {
            $table->increments('rel_id');
            $table->integer('person_id')->unsigned();
            $table->integer('rol_id')->unsigned();
            $table->integer('event_id')->unsigned();
            $table->foreign('person_id')->references('person_id')->on('people');
            $table->foreign('rol_id')->references('rol_id')->on('rols');
            $table->foreign('event_id')->references('event_id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('people_to_rols');
    }
}
