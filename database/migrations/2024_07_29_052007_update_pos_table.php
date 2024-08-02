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
        Schema::table('pos', function (Blueprint $table) {
            $table->decimal('sub_total', 15, 2)->nullable();
            $table->decimal('shipping_cost', 15, 2)->nullable();
            $table->string('order_type');
            $table->unsignedInteger('order_status_id')->nullable();

            $table->foreign('order_status_id')
                ->references('id')
                ->on('order_status')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pos', function (Blueprint $table) {
            $table->dropColumn(['sub_total', 'shipping_cost', 'order_type', 'order_status_id']);
            $table->dropForeign(['order_status_id']);
        });
    }
};
