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
        Schema::create('bees', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['Queen', 'Worker', 'Drone']);
            $table->integer('health');
            $table->foreignId('game_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bees');
    }
};
