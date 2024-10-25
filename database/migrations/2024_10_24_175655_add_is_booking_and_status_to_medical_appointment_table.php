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
        Schema::table('medical_appointment', function (Blueprint $table) {
            $table->string('is_booking')->nullable();  // Add is_booking column as nullable
            $table->string('status')->nullable();  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medical_appointment', function (Blueprint $table) {
            $table->dropColumn('is_booking');  // Remove is_booking column
            $table->dropColumn('status');    
        });
    }
};
