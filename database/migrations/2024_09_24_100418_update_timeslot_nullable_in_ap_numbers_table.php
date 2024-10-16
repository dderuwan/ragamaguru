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
        Schema::table('ap_numbers', function (Blueprint $table) {
            $table->string('timeslot')->nullable()->change();  // Make timeslot nullable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ap_numbers', function (Blueprint $table) {
            $table->string('timeslot')->nullable(false)->change();  // Revert timeslot to not nullable
        });
    }
};
