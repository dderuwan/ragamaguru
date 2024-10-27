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
        Schema::table('customer_medical_treatments', function (Blueprint $table) {
            $table->json('free_treatments')->nullable()->after('appointment_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_medical_treatments', function (Blueprint $table) {
            $table->dropColumn(['free_treatments']);
        });
    }
};
