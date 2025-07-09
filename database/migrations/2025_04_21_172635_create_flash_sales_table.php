<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('flash_sales', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->timestampTz('start_at');
            $table->timestampTz('end_at');
            $table->enum('discount_type', ['percentage', 'fixed'])->default('percentage');
            $table->decimal('discount_value', 10, 2); // percentage (0-100) or fixed amount
            // $table->decimal('discount_price', 10, 2);
            // $table->integer('stock_limit')->default(0);
            $table->integer('usage_limit_per_user')->nullable();
            $table->tinyInteger('status')->default(1); // 0: inactive, 1: active, 2: ended
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flash_sales');
    }
};