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
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id');
            $table->date('date');    
            $table->unsignedInteger('ap_numbers_id')->nullable(); 
            $table->string('visit_day');
            $table->dateTime('added_date');
            $table->timestamps();

            $table->foreign('customer_id')
              ->references('id')
              ->on('customer')
              ->onDelete('cascade');

            $table->foreign('ap_numbers_id')
              ->references('id')
              ->on('ap_numbers')
              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
