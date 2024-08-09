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
        Schema::table('customer', function (Blueprint $table) {
            $table->renameColumn('customer_type', 'customer_type_id');
        });

        Schema::table('customer', function (Blueprint $table) {
            $table->string('otp')->nullable()->change();
            $table->integer('user_id')->nullable()->change();
            $table->unsignedInteger('customer_type_id')->change();

            $table->string('password')->nullable();
            $table->unsignedInteger('country_type_id')->nullable();
            $table->unsignedInteger('country_id')->nullable();

            $table->foreign('customer_type_id')->references('id')->on('customer_type')->onDelete('cascade');
            $table->foreign('country_type_id')->references('id')->on('country_type')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('country')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer', function (Blueprint $table) {

            $table->dropForeign(['customer_type_id']);
            $table->dropForeign(['country_type_id']);
            $table->dropForeign(['country_id']);

            $table->dropColumn('password');
            $table->dropColumn('country_type_id');
            $table->dropColumn('country_id');

            $table->renameColumn('customer_type_id', 'customer_type');

            $table->string('otp')->nullable(false)->change();
            $table->integer('user_id')->nullable(false)->change();
        });
    }
};
