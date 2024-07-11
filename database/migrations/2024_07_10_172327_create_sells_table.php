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
        Schema::create('sells', function (Blueprint $table) {
            $table->id();
            $table->string('product_id');
            $table->string('quantity');
            $table->string('total');
            $table->string('retailer_id');
            $table->string('status');
            $table->string('payment_type');
            $table->string('card_number')->nullable();
            $table->string('expiration_date')->nullable();
            $table->string('cvv')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('Transaction_ID')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sells');
    }
};
