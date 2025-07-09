<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->constrained('sellers')->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('sku')->nullable();
            $table->text('description')->nullable();
            $table->enum('type', ['simple', 'variable']); // [simple for one variant, variable for multiple variants]
            // $table->decimal('price', 10, 2);
            $table->decimal('price_regular', 10, 2)->default(0);
            $table->decimal('price_discounted', 10, 2)->default(0);
            $table->integer('stock_quantity')->default(0);
            $table->string('thumbnail')->nullable();
            // $table->enum('status', ['active', 'inactive', 'pending'])->default('pending');
            $table->string('status')->default('pending'); // Changed from enum to string
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};