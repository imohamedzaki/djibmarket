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
        Schema::create('notification_bars', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Admin reference name for this notification bar');
            $table->unsignedTinyInteger('column_count')->default(3)->comment('Number of columns to display (1-4)');
            $table->date('start_date')->comment('When the notification bar should start being visible');
            $table->date('end_date')->comment('When the notification bar should stop being visible');
            $table->boolean('is_active')->default(true)->comment('Whether this notification bar is active');
            $table->string('css_class')->nullable()->comment('Additional CSS classes for styling');
            $table->timestamps();

            // Add indexes for performance
            $table->index(['is_active', 'start_date', 'end_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_bars');
    }
};
