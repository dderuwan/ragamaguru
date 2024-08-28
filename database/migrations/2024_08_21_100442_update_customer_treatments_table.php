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
            $table->decimal('total_amount', 10, 2)->nullable()->after('note');
            $table->decimal('paid_amount', 10, 2)->nullable()->after('total_amount');
            $table->decimal('due_amount', 10, 2)->nullable()->after('paid_amount');
            $table->unsignedInteger('payment_type_id')->nullable()->after('due_amount');

            $table->foreign('payment_type_id')->references('id')->on('payment_types')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_treatments', function (Blueprint $table) {
            $table->dropForeign(['payment_type_id']);
            $table->dropColumn(['total_amount', 'paid_amount', 'due_amount', 'payment_type_id']);
        });
    }
};
