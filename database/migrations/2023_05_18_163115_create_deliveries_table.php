<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('cars');
            $table->foreignId('car_located_id');
            $table->foreign('car_located_id')->references('id')->on('cars_locations');
            $table->json('delivery_location')->comment('To save real location of the costumer at that time, because we can pu Costumer Location N to N sometime');
            $table->boolean('delivered')->default(false);
            $table->integer('delivery_deadline_in_days');
            $table->datetime('delivery_start_date');
            $table->datetime('delivery_finish_date');
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
        Schema::dropIfExists('deliveries');
    }
}
