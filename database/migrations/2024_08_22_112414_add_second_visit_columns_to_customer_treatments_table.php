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
            $table->text('second_visit_comment')->nullable()->after('payment_type_id');
            $table->text('second_visit_things')->nullable()->after('second_visit_comment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_treatments', function (Blueprint $table) {
            $table->dropColumn('second_visit_comment');
            $table->dropColumn('second_visit_things');
        });
    }
};
