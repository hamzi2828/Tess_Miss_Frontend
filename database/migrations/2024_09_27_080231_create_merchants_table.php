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
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            
            // Basic merchant details
            $table->string('merchant_name', 255)->nullable(); // Merchant name
            $table->string('merchant_name_ar', 255)->nullable(); // Merchant Arabic name
            $table->string('comm_reg_no', 255)->nullable(); // Company registration number
            $table->text('address')->nullable(); // Company address
            $table->string('merchant_mobile', 255)->nullable(); // Mobile number
            $table->integer('merchant_category')->nullable(); // Merchant category (FK)
            $table->string('merchant_landline', 255)->nullable(); // Landline number
            $table->string('merchant_url', 500)->nullable(); // Website URL
            $table->string('merchant_email', 255)->nullable(); // Email
            
            // Website data
            $table->integer('website_month_visit')->nullable(); // Monthly website visitors
            $table->integer('website_month_active')->nullable(); // Monthly active users
            $table->integer('website_month_volume')->nullable(); // Monthly average volume (QAR)
            $table->integer('website_month_transaction')->nullable(); // Monthly average transactions
        
            // Contact person details
            $table->string('contact_person_name', 255)->nullable(); // Key point of contact
            $table->string('contact_person_mobile', 255)->nullable(); // Key point mobile
            $table->string('contact_person_email', 255)->nullable(); // Key point email
        
            // Banking details
            $table->string('merchant_previous_bank', 255)->nullable(); // Existing banking partner
        
            // Company details
            $table->date('merchant_date_incorp')->nullable(); // Date of incorporation
        
            // Optional status and tracking columns
            $table->string('status', 50)->default('active'); // Status
            $table->text('kyc_comments')->nullable(); // KYC comments
            $table->timestamp('time_created')->useCurrent(); // Created timestamp
        
            // Foreign keys for user references (optional)
            $table->unsignedBigInteger('added_by')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();

             // Foreign key constraints
            $table->foreign('added_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');



            $table->timestamps(); 
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchants');
    }
};
