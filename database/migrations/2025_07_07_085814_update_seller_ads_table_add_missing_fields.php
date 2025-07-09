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
        Schema::table('seller_ads', function (Blueprint $table) {
            // Add current_views if it doesn't exist
            if (!Schema::hasColumn('seller_ads', 'current_views')) {
                $table->bigInteger('current_views')->default(0)->after('max_clicks');
            }

            // Add current_clicks if it doesn't exist
            if (!Schema::hasColumn('seller_ads', 'current_clicks')) {
                $table->bigInteger('current_clicks')->default(0)->after('current_views');
            }

            // Add current_cost if it doesn't exist
            if (!Schema::hasColumn('seller_ads', 'current_cost')) {
                $table->decimal('current_cost', 15, 2)->default(0)->after('current_clicks');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seller_ads', function (Blueprint $table) {
            $table->dropColumn(['current_views', 'current_clicks', 'current_cost']);
        });
    }
};
