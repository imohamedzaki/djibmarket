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
        Schema::create('business_activities', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Add back 'name' for English
            $table->string('name_ar'); // Keep 'name_ar' for Arabic name
            $table->string('name_fr')->nullable(); // Keep French name column
            $table->string('slug')->unique(); // Add the slug column
            $table->foreignId('parent_id')->nullable()->constrained('business_activities')->onDelete('set null');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_activities');
    }
};