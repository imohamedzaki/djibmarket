<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\PromotionType;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->nullable()->constrained('campaigns')->onDelete('cascade');
            $table->foreignId('seller_id')->nullable()->constrained('sellers')->onDelete('cascade');
            $table->foreignId('admin_id')->nullable()->constrained('admins')->onDelete('set null');
            $table->string('ref')->unique()->nullable();

            $table->string('title');
            $table->text('description')->nullable();
            $table->datetime('start_at');
            $table->datetime('end_at');
            $table->boolean('is_active')->default(true);
            $table->string('banner_image')->nullable();

            $table->string('promotion_type')->default(PromotionType::PERCENTAGE_DISCOUNT->value);
            $table->decimal('discount_value', 8, 2)->nullable();
            $table->decimal('min_purchase_amount', 8, 2)->nullable();
            $table->integer('required_quantity')->nullable();
            $table->integer('free_quantity')->nullable();
            $table->foreignId('free_product_id')->nullable()->constrained('products')->onDelete('set null');
            $table->integer('usage_limit')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
