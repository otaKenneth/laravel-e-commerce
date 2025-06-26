<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('order_ninjavan', function (Blueprint $table) {
            $table->id();

            // Foreign key to `orders` table
            $table->unsignedBigInteger('order_id');
            $table->string('merchant_order_number');
            $table->string('service_level');

            // Pickup schedule
            $table->date('pickup_date');
            $table->string('pickup_time_start');
            $table->string('pickup_time_end');
            $table->text('pickup_instructions')->nullable();

            // Delivery schedule
            $table->date('delivery_start_date');
            $table->string('delivery_time_start');
            $table->string('delivery_time_end');
            $table->text('delivery_instructions')->nullable();

            // Parcel info
            $table->float('weight');
            $table->text('item_description');
            $table->integer('quantity');

            $table->timestamps();

            // Set foreign key constraint
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_ninjavan');
    }
};
