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
            $table->text('third_visit_comment')->nullable()->after('second_visit_things');
            $table->text('other_visit_comment')->nullable()->after('third_visit_comment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_treatments', function (Blueprint $table) {
            $table->dropColumn('third_visit_comment');
            $table->dropColumn('other_visit_comment');
        });
    }
};
