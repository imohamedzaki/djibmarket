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
        Schema::create('seller_ads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->constrained('sellers')->onDelete('cascade');

            // Ad basic info
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('ad_slot'); // ads_space_1, ads_space_2, etc.

            // Ad content
            $table->text('headline')->nullable();
            $table->text('sub_headline')->nullable();
            $table->string('call_to_action_text', 100)->default('Shop Now');
            $table->string('call_to_action_url')->nullable();
            $table->string('ad_image')->nullable(); // main ad image
            $table->json('custom_colors')->nullable(); // {"background": "#ffffff", "text": "#000000", etc.}

            // Pricing & Campaign Details
            $table->enum('pricing_type', ['daily', 'per_view'])->default('daily');
            $table->decimal('daily_rate', 10, 2)->default(5000.00); // Fixed daily rate in DJF
            $table->decimal('per_view_rate', 10, 2)->default(2.50); // Cost per view in DJF
            $table->decimal('total_budget', 12, 2)->nullable(); // Total budget allocated

            // Campaign Duration
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->integer('duration_days')->nullable(); // If running for specific number of days

            // Campaign Limits
            $table->bigInteger('max_views')->nullable();
            $table->bigInteger('max_clicks')->nullable();

            // Current Stats (cached for performance)
            $table->bigInteger('current_views')->default(0);
            $table->bigInteger('current_clicks')->default(0);
            $table->decimal('current_cost', 12, 2)->default(0.00);

            // Status & Admin Review
            $table->enum('status', ['pending', 'approved', 'active', 'paused', 'completed', 'rejected'])->default('pending');
            $table->text('admin_notes')->nullable(); // Admin feedback for approval/rejection
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('admins')->onDelete('set null');

            // Auto-pause when limits reached
            $table->boolean('auto_paused')->default(false);
            $table->enum('pause_reason', ['budget_reached', 'views_reached', 'clicks_reached', 'end_date_reached', 'manually_paused'])->nullable();

            $table->timestamps();

            // Indexes for performance
            $table->index(['seller_id', 'status']);
            $table->index(['ad_slot', 'status', 'start_date', 'end_date']);
            $table->index(['status', 'start_date', 'end_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_ads');
    }
};
