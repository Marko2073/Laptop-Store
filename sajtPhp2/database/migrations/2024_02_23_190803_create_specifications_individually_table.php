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
        Schema::create('specifications_individually', function (Blueprint $table) {
            $table->id();
            $table->foreignId('specification_id')->references('id')->on('specifications');
            $table->foreignId('model_specification_id')->references('id')->on('model_specification');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specifications_individually');
    }
};
