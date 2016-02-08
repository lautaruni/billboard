<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_dates', function (Blueprint $table) {
            $table->increments('eventdate_id');
            $table->integer('event_id')->unsigned();
            $table->dateTime('date_start');
            $table->dateTime('date_end');
            $table->string('hour_start',6);
            $table->string('hour_end',6);
            $table->boolean('status');
            $table->timestamps();
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
        Schema::drop('event_dates');
    }
}
