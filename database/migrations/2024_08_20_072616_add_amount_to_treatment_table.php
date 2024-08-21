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
        Schema::table('treatment', function (Blueprint $table) {
            $table->decimal('amount', 8, 2)->after('status')->nullable()->comment('Amount for the treatment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('treatment', function (Blueprint $table) {
            $table->dropColumn('amount');
        });
    }
};
