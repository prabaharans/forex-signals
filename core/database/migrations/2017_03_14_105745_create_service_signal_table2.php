<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceSignalTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_signal', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services');

            $table->integer('signal_id')->unsigned();
            $table->foreign('signal_id')->references('id')->on('signals');

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
        Schema::drop('service_signal');
    }
}
