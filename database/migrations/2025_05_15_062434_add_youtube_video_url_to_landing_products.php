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
        Schema::table('landing_products', function (Blueprint $table) {
            $table->string('youtube_video_url')->nullable()->after('benefits');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('landing_products', function (Blueprint $table) {
            $table->dropColumn('youtube_video_url');
        });
    }
};
