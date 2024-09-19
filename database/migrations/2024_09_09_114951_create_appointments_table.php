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
            $table->unsignedInteger('appointment_type_id')->nullable();
            $table->string('created_by')->nullable();
            $table->integer('created_user_id')->nullable();
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->decimal('paid_amount', 10, 2)->nullable();
            $table->decimal('due_amount', 10, 2)->nullable();
            $table->unsignedInteger('payment_type_id')->nullable();
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

            $table->foreign('payment_type_id')
                ->references('id')
                ->on('payment_types')
                ->onDelete('cascade');

            $table->foreign('appointment_type_id')
                ->references('id')
                ->on('appointment_type')
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
