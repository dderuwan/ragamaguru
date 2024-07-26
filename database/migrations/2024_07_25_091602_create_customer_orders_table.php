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
        Schema::create('customer_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cus_order_code')->unique();
            $table->string('customer_code');
            $table->date('date');
            $table->decimal('sub_total', 15, 2);
            $table->decimal('shipping_cost', 15, 2);
            $table->decimal('grand_total', 15, 2);
            $table->decimal('paid_amount', 15, 2)->nullable();
            $table->string('payment_type');
            $table->unsignedInteger('order_status_id');
            $table->timestamps(); 

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
        Schema::dropIfExists('customer_orders');
    }
};
