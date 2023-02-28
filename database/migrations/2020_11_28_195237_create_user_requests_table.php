<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_requests', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id');
            $table->integer('user_id');
            $table->integer('driver_id')->nullable();
            $table->integer('vehicle_type_id');
            $table->enum('status', array('COMPLETED','PENDING','ONGOING','CANCELED','SCHEDULED'))->default('PENDING');
            $table->boolean('canceled')->default(0);
            $table->string('payment_mode')->default('cash');
            $table->string('amount')->default(0);
            $table->boolean('paid')->default(0);
            $table->decimal('distance');
            $table->decimal('travel_time')->nullable();
            $table->text('start_address');
            $table->decimal('start_latitude',10,7);
            $table->decimal('start_longitude',10, 7);
            $table->text('complete_address')->nullable();
            $table->string('mobile')->nullable();
            $table->string('name')->nullable();
            $table->decimal('track_distance',10,7)->nullable();
            $table->decimal('track_latitude',10,7)->nullable();
            $table->decimal('track_longitude',10,7)->nullable();
            $table->decimal('track_accuracy',10,7)->nullable();
            $table->dateTime('started_at')->nullable();
            $table->dateTime('finished_at')->nullable();
            $table->longText('route_key')->nullable();
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
        Schema::dropIfExists('user_requests');
    }
}
