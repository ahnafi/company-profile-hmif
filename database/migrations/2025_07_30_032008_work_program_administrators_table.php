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
        Schema::create('work_program_administrators', function (Blueprint $table) {
            $table->id();
            $table->string('position')->nullable();
            $table->foreignId('work_program_id')->constrained('work_programs');
            $table->foreignId('administrator_id')->constrained('administrators');
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
