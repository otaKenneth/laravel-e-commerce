<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('orders_ninjavan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('merchant_order_number');
            $table->string('service_level');
            $table->date('pickup_date')->nullable();
            $table->string('pickup_time_start')->nullable();
            $table->string('pickup_time_end')->nullable();
            $table->text('pickup_instructions')->nullable();
            $table->date('delivery_start_date')->nullable();
            $table->string('delivery_time_start')->nullable();
            $table->string('delivery_time_end')->nullable();
            $table->text('delivery_instructions')->nullable();
            $table->float('weight');
            $table->text('item_description');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('order_id','fk_order_ninjavan_order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders_ninjavan');
    }
};
