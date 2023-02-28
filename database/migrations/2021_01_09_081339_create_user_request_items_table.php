<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRequestItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_request_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_request_id')->constrained()->cascadeOnDelete();
            $table->integer('item_id')->nullable();
            $table->string('name');
            $table->string('qty')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->string('breath')->nullable();
            $table->string('custom_size')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('user_request_items');
    }
}
