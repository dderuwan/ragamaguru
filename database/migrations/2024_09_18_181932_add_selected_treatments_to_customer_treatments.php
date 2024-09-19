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
            $table->json('selected_treatments')->nullable()->after('added_treatments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_treatments', function (Blueprint $table) {
            $table->dropColumn('selected_treatments');
        });
    }
};
