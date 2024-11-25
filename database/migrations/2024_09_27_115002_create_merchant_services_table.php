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
        Schema::create('merchant_services', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->unsignedBigInteger('merchant_id'); 
            $table->unsignedBigInteger('service_id'); 
            $table->string('field_name'); 
            $table->text('field_value'); 
            $table->unsignedBigInteger('added_by'); 
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamp('time_created')->useCurrent(); 
            $table->boolean('status')->default(true); 
            $table->timestamps(); 
            
            // Foreign key constraints
            $table->foreign('merchant_id')->references('id')->on('merchants')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('added_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchant_services');
    }
};
