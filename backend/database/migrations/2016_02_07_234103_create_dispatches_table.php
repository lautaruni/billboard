<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDispatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispatches', function (Blueprint $table) {
            $table->increments('dispatch_id');
            $table->string('title');
            $table->string('friendly_url');
            $table->string('poster');
            $table->longText('description');
            $table->boolean('mature');
            $table->decimal('price',6,2);
            $table->string('quota',3);
            $table->tinyInteger('priority');
            $table->string('company');
            $table->text('cast');
            $table->text('eventdates');
            $table->integer('venue_id')->unsigned();
            $table->string('venue_alt');
            $table->string('contact_name');
            $table->string('contact_social');
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
        Schema::drop('dispatches');
    }
}
