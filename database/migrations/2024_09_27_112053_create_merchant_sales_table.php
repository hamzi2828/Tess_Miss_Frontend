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
        Schema::create('merchant_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('merchant_id'); // Foreign key to the merchants table
            $table->decimal('min_transaction_amount', 15, 2);
            $table->decimal('max_transaction_amount', 15, 2);
            $table->decimal('daily_limit_amount', 15, 2);
            $table->decimal('monthly_limit_amount', 15, 2);
            $table->integer('max_transaction_count');
            $table->unsignedBigInteger('added_by'); 
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('merchant_id')->references('id')->on('merchants')->onDelete('cascade');
            $table->foreign('added_by')->references('id')->on('users')->onDelete('cascade'); 
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchant_sales');
    }
};
