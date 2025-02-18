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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('fullname');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->string('number_phone')->nullable();
            $table->tinyInteger('phone_verified')->default(0);
            $table->tinyInteger('email_verified')->default(0);
            $table->string('email_verification_token')->nullable();
            $table->string('phone_verification_token')->nullable();
            $table->string('avatar')->nullable();
            $table->enum('role', ['client', 'mitra'])->default('client');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
