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
        Schema::table('orders', function (Blueprint $table) {
            // Add new columns for RajaOngkir integration
            $table->unsignedInteger('province_id')->nullable()->after('address');
            $table->unsignedInteger('city_id')->nullable()->after('province_id');
            $table->string('courier')->nullable()->after('city_id');
            $table->string('courier_service')->nullable()->after('courier');
            $table->integer('shipping_cost')->default(0)->after('courier_service');

            // Remove the old shipping_method_id if it exists
            if (Schema::hasColumn('orders', 'shipping_method_id')) {
                $table->dropForeign(['shipping_method_id']);
                $table->dropColumn('shipping_method_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'province_id',
                'city_id',
                'courier',
                'courier_service',
                'shipping_cost'
            ]);

            // Add back the shipping_method_id column
            $table->unsignedBigInteger('shipping_method_id')->nullable();
            $table->foreign('shipping_method_id')->references('id')->on('shipping_methods');
        });
    }
};
