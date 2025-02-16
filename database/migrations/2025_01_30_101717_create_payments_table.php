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
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('amount');
            $table->dateTime('payment_date');
            $table->enum('payment_type', ['down_payment', 'remaining_payment', 'full_payment']);
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
            $table->foreignUuid('order_id')->constrained('orders')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
