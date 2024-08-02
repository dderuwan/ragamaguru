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
        Schema::create('offer_item', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('item_id');
            $table->decimal('normal_price', 15, 2);
            $table->decimal('offer_rate', 5, 2);
            $table->decimal('offer_price', 15, 2);
            $table->string('month');
            $table->string('status')->default('active'); 
            $table->timestamp('added_date')->useCurrent();
            $table->timestamps();
            
            $table->foreign('item_id')
                ->references('id')
                ->on('item')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_item');
    }
};
