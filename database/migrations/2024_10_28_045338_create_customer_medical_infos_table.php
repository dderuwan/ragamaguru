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
        Schema::create('customer_medical_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('customer_id');
            $table->unsignedBigInteger('quiz_id');
            $table->text('answer')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')
                ->references('id')
                ->on('customer')
                ->onDelete('cascade');

            $table->foreign('quiz_id')
                ->references('id')
                ->on('medical_quiz')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_medical_info');
    }
};
