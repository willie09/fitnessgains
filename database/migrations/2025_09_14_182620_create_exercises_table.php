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
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workout_plan_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->integer('sets')->nullable();
            $table->string('reps_or_time')->nullable(); // e.g., "10 reps", "30 seconds"
            $table->string('rest_time')->nullable(); // e.g., "60 seconds", "2 minutes"
            $table->string('day')->nullable(); // e.g., "Monday", "Day 1"
            $table->text('instructions')->nullable(); // Trainer's notes/instructions
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
