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
        Schema::create('deposit_fund', function (Blueprint $table) {
            $table->id();
            $table->foreignId("deposit_id")->constrained()->cascadeOnDelete();
            $table->foreignId("fund_id")->constrained()->cascadeOnDelete();
            $table->date("date");
            $table->integer("amount");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposit_fund');
    }
};
