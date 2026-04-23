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
        Schema::table('members', function (Blueprint $table) {
            $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('address');
            $table->date('date_of_birth')->nullable()->after('gender');
            $table->decimal('weight', 5, 2)->nullable()->comment('Weight in kilograms')->after('date_of_birth');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn(['gender', 'date_of_birth', 'weight']);
        });
    }
};
