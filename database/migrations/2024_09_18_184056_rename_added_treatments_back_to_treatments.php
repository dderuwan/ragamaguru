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
            if (Schema::hasColumn('customer_treatments', 'added_treatments')) {
                $table->renameColumn('added_treatments', 'treatments');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_treatments', function (Blueprint $table) {
            if (Schema::hasColumn('customer_treatments', 'treatments')) {
                $table->renameColumn('treatments', 'added_treatments');
            }
        });
    }
};
