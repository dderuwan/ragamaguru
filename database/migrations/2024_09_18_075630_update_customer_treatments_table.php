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
            // Remove the columns
            $table->dropColumn([
                'note',
                'second_visit_comment',
                'second_visit_things',
                'third_visit_comment',
                'other_visit_comment',
            ]);

            // Add new columns
            $table->text('comment')->nullable();
            $table->text('things_to_bring')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_treatments', function (Blueprint $table) {
            // Re-add the removed columns
            $table->text('note')->nullable();
            $table->text('second_visit_comment')->nullable();
            $table->text('second_visit_things')->nullable();
            $table->text('third_visit_comment')->nullable();
            $table->text('other_visit_comment')->nullable();

            // Remove the new columns
            $table->dropColumn(['comment', 'things_to_bring']);
        });
    }
};
