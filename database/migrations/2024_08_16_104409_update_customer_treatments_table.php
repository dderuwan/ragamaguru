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
        Schema::table('customer_treatments', function (Blueprint $table) {
            // Change 'added_date' to 'date' type
            $table->date('added_date')->change();

            // Add 'next_day' column as 'date' and nullable
            $table->date('next_day')->nullable()->after('added_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_treatments', function (Blueprint $table) {
            // Revert 'added_date' back to 'timestamp'
            $table->timestamp('added_date')->useCurrent()->change();

            // Drop the 'next_day' column
            $table->dropColumn('next_day');
        });
    }
};
