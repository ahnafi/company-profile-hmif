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
        Schema::create('student_achievement_submissions', function (Blueprint $table) {
            $table->id();
            $table->text('name')->unique();
            $table->text('description')->nullable();
            $table->string('image');
            $table->foreignId('achievement_type_id')->constrained('achievement_types');
            $table->foreignId('achievement_category_id')->constrained('achievement_categories');
            $table->foreignId('achievement_level_id')->constrained('achievement_levels');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
