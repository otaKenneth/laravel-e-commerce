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
        Schema::create('vendor_sales_transaction', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_bank_details_id');
            $table->string('date_range');
            $table->string('transaction_number')->nullable();
            $table->double('amount');
            $table->boolean('status');
            $table->json('order_ids');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_sales_transaction');
    }
};
