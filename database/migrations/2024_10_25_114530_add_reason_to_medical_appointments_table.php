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
        Schema::table('medical_appointments', function (Blueprint $table) {
            $table->unsignedInteger('medical_reason_id')->nullable()->after('added_date');

            $table->foreign('medical_reason_id')->references('id')->on('medical_reason')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medical_appointments', function (Blueprint $table) {
            $table->dropForeign(['medical_reason_id']);
            $table->dropColumn(['medical_reason_id']);
        });
    }
};
