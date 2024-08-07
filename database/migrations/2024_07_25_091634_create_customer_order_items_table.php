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
        Schema::create('customer_order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cus_order_id');
            $table->string('item_code');
            $table->string('item_name');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('cus_order_id')
              ->references('id')
              ->on('customer_orders')
              ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_order_items');
    }
};
