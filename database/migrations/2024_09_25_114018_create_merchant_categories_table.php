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
        Schema::create('merchant_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();  // For parent category
            $table->string('title');
            $table->unsignedBigInteger('added_by');  // Reference to user who added the category
            $table->timestamps();

            // Foreign key constraint (assuming the added_by references a users table)
            $table->foreign('added_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('merchant_categories')->onDelete('cascade'); // Self-referencing parent category
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchant_categories');
    }
};
