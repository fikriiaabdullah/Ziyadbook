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
            $table->id();
            $table->string('user_name');
            $table->string('email');
            $table->text('address');
            $table->decimal('total_price', 10, 2);
            $table->string('payment_method');
            $table->enum('payment_status', ['pending', 'paid'])->default('pending');
            $table->enum('shipping_status', ['proses', 'dikirim', 'selesai'])->default('proses');
            $table->foreignId('shipping_method_id')->constrained()->onDelete('cascade');
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
