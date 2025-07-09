<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->constrained('sellers');
            $table->string('code')->unique();
            $table->string('slug')->unique();
            $table->string('type', 20)->default('percentage');
            $table->decimal('amount', 10, 2);
            $table->decimal('min_purchase', 10, 2)->nullable();
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->integer('usage_limit')->nullable();
            $table->integer('usage_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->text('description')->nullable();
            $table->string('applicability_type')->default('all_seller_products');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};