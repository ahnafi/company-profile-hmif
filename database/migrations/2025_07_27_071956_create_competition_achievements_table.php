<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('competition_achievements', function (Blueprint $table) {
            $table->id();
            $table->json('students');
            $table->enum('competition_level', ['faculty', 'university', 'national', 'international', 'other']);
            $table->enum('competition_type', ["academic", 'nonacademic']);
            $table->year('competition_year');
            $table->string('event_name');
            $table->string('organizer');
            $table->string('achievement');
            $table->enum('team_type', ['individual', 'group']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competition_achievements');
    }
};
