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
        Schema::table('customer', function (Blueprint $table) {
            // Drop the foreign key constraint first
            $table->dropForeign(['country_id']);
        });

        Schema::table('customer', function (Blueprint $table) {
            // Now modify the country_id column to be a string
            $table->string('country_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer', function (Blueprint $table) {
            // Reverse the changes by changing the column back to an unsigned integer
            $table->unsignedInteger('country_id')->nullable()->change();

            // Optionally, re-add the foreign key if needed
            $table->foreign('country_id')->references('id')->on('country')->onDelete('cascade');
        });
    }
};
