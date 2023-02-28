<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreaVehicleTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_vehicle_types', function (Blueprint $table) {
            $table->id();
            $table->integer('vehicle_type_id');
            $table->integer('area_id')->nullable();
            $table->integer('area_per_km')->nullable();
            $table->integer('area_per_min')->nullable();
            $table->integer('price')->nullable();
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
        Schema::dropIfExists('area_vehicle_types');
    }
}
