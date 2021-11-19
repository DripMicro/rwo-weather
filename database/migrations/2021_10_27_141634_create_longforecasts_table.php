<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLongforecastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('longforecasts', function (Blueprint $table) {
            $table->id();
            $table->integer('region');
            $table->integer('temp');
            $table->integer('humidity');
            $table->integer('rainfall');
            $table->integer('snowfall');
            $table->integer('daylight');
            $table->integer('sunshine');
            $table->integer('month');
            $table->integer('year');
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
        Schema::dropIfExists('longforecasts');
    }
}
