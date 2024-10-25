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
        Schema::create('customer_medical_treatments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('appointment_id');
            $table->json('treatments')->nullable();
            $table->json('selected_treatments')->nullable();
            $table->date('added_date');
            $table->date('next_day')->nullable();
            $table->text('comment')->nullable();
            $table->text('things_to_bring')->nullable();
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->decimal('paid_amount', 10, 2)->nullable();
            $table->decimal('due_amount', 10, 2)->nullable();
            $table->unsignedInteger('payment_type_id')->nullable();
            $table->timestamps();

            $table->foreign('payment_type_id')->references('id')->on('payment_types')->onDelete('set null');
            $table->foreign('customer_id')->references('id')->on('customer')->onDelete('cascade');
            $table->foreign('appointment_id')->references('id')->on('medical_appointments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_medical_treatments');
    }
};
