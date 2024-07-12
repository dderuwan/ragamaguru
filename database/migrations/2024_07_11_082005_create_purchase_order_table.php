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
        Schema::create('purchase_order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('request_code');
            $table->string('item_code');
            $table->string('supplier_code');
            $table->integer('inquantity')->nullable();
            $table->integer('order_quantity');
            $table->tinyInteger('status')->default(0)->comment('0: Pending, 1: Received');
            $table->date('date');
            $table->timestamps();

            $table->foreign('item_code')->references('item_code')->on('item')->onDelete('cascade');
            $table->foreign('supplier_code')->references('supplier_code')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order');
    }
};
