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
        Schema::create('merchant_documents', function (Blueprint $table) {
            $table->id();
            $table->string('title'); 
            $table->string('document'); 
            $table->date('date_expiry')->nullable(); 
            $table->unsignedBigInteger('merchant_id'); 
            $table->unsignedBigInteger('previous_doc_id')->nullable(); 
            $table->timestamp('time_created')->useCurrent(); 
            $table->string('document_type')->nullable(); 
            $table->unsignedBigInteger('added_by'); 
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->boolean('emailed')->default(false);
            $table->boolean('status')->default(true); 
            $table->timestamps();
            
            // Foreign key constraints
            $table->foreign('merchant_id')->references('id')->on('merchants')->onDelete('cascade');
            $table->foreign('previous_doc_id')->references('id')->on('merchant_documents')->onDelete('set null');
            $table->foreign('added_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchant_documents');
    }
};
