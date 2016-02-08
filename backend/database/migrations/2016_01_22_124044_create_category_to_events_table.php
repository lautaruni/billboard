<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_to_events', function (Blueprint $table) {
            $table->increments('rel_id');
            $table->integer('category_id')->unsigned();
            $table->integer('event_id')->unsigned();
            $table->foreign('category_id')->references('category_id')->on('categories');
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
        Schema::drop('category_to_events');
    }
}
