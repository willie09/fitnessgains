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
        Schema::table('trainors', function (Blueprint $table) {
            $table->unsignedBigInteger('assigned_member_id')->nullable()->after('user_id');
            $table->foreign('assigned_member_id')->references('id')->on('members')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trainors', function (Blueprint $table) {
            $table->dropForeign(['assigned_member_id']);
            $table->dropColumn('assigned_member_id');
        });
    }
};
