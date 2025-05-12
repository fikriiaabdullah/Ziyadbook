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
        Schema::create('landing_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->text('problem')->nullable();
            $table->text('agitate')->nullable();
            $table->text('solution')->nullable();
            $table->text('headline')->nullable();
            $table->text('subheadline')->nullable();
            $table->text('call_to_action')->nullable();
            $table->text('testimonials')->nullable();
            $table->text('benefits')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landing_products');
    }
};
