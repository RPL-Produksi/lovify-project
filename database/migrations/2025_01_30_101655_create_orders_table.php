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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('total_price');
            $table->integer('down_payment');
            $table->integer('remaining_payment');
            $table->date('dp_deadline');
            $table->date('payment_deadline');
            $table->date('marry_date');
            $table->enum('status', ['pending', 'in_progress', 'completed', 'canceled']);
            $table->foreignUuid('planning_id')->constrained('plannings')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
