<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id');
            $table->foreign('car_id')->references('id')->on('cars');
            $table->foreignId('state_id');
            $table->foreign('state_id')->references('id')->on('states');
            $table->boolean('available')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars_locations');
    }
}
