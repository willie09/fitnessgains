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
        Schema::table('workout_plans', function (Blueprint $table) {
            $table->dropForeign(['member_id']);
            $table->dropColumn('member_id');
            $table->dropColumn('type');
            $table->string('category_goal')->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('workout_plans', function (Blueprint $table) {
            $table->dropColumn('category_goal');
            $table->enum('type', ['Beginner', 'Intermediate', 'Advanced'])->after('description');
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade')->after('id');
        });
    }
};
