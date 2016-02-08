<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('event_id');
            $table->string('title');
            $table->string('friendly_url');
            $table->string('poster');
            $table->longText('description');
            $table->boolean('mature');
            $table->decimal('price',6,2);
            $table->string('quota',3);
            $table->tinyInteger('priority');
            $table->boolean('status');
            $table->integer('company_id')->unsigned();
            $table->integer('venue_id')->unsigned();
            $table->timestamps();
            $table->foreign('company_id')->references('company_id')->on('companies');
            $table->foreign('venue_id')->references('venue_id')->on('venues');
            //$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('events');
    }
}
