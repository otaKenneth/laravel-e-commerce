<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('refunds', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('order_id');
            $table->integer('orders_product_id');
            $table->string('paymongo_refund_id')->nullable();
            $table->string('payment_id');
            $table->float('amount');
            $table->string('status');
            $table->string('reason');
            $table->text('paymongo_response')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refunds');
    }
};
