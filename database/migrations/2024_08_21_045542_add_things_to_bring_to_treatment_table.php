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
            $table->text('things_to_bring')->nullable()->after('amount')->comment('Serialized list of things to bring');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('treatment', function (Blueprint $table) {
            $table->dropColumn('things_to_bring');
        });
    }
};
