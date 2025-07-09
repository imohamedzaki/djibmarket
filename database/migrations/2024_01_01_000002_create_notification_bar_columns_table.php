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
        Schema::create('notification_bar_columns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notification_bar_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('column_order')->comment('Order of the column (1, 2, 3, 4)');
            $table->text('text_content')->comment('The promotional text content for this column');
            $table->string('image_path')->nullable()->comment('Optional image/icon path');
            $table->string('link_url')->nullable()->comment('Optional clickable link URL');
            $table->string('link_target')->default('_self')->comment('Link target (_self, _blank, etc.)');
            $table->boolean('is_active')->default(true)->comment('Whether this column is active');
            $table->timestamps();

            // Add indexes for performance
            $table->index(['notification_bar_id', 'column_order']);
            $table->index(['notification_bar_id', 'is_active']);

            // Ensure unique column order per notification bar
            $table->unique(['notification_bar_id', 'column_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_bar_columns');
    }
};
