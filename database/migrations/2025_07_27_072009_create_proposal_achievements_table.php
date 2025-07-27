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
        Schema::create('proposal_achievements', function (Blueprint $table) {
            $table->id();
            $table->json('students');
            $table->enum('program_type', ["p2mw", "pkm"]);
            $table->string('program_title');
            $table->year('program_year');
            $table->string('achievement');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal_achievements');
    }
};
