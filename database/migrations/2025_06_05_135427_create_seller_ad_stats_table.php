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
        Schema::create('seller_ad_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_ad_id')->constrained('seller_ads')->onDelete('cascade');

            // Event tracking
            $table->enum('event_type', ['view', 'click']);
            $table->timestamp('event_time');

            // User tracking (optional - for analytics)
            $table->string('user_ip', 45)->nullable(); // Supports IPv6
            $table->text('user_agent')->nullable();
            $table->string('session_id')->nullable();
            $table->foreignId('buyer_id')->nullable()->constrained('users')->onDelete('set null'); // If logged in

            // Request details
            $table->string('referer_url')->nullable();
            $table->string('page_url')->nullable();

            // Geo tracking (optional)
            $table->string('country', 2)->nullable();
            $table->string('city')->nullable();

            // Device/Browser info
            $table->string('device_type', 20)->nullable(); // mobile, desktop, tablet
            $table->string('browser')->nullable();
            $table->string('os')->nullable();

            $table->timestamps();

            // Indexes for performance and analytics
            $table->index(['seller_ad_id', 'event_type', 'event_time']);
            $table->index(['seller_ad_id', 'event_time']);
            $table->index(['event_type', 'event_time']);
            $table->index(['buyer_id', 'event_type']);
            $table->index('session_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_ad_stats');
    }
};
