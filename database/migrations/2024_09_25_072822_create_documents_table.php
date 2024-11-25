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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Title of the document
            $table->boolean('is_required')->default(false); 
            $table->boolean('require_expiry')->default(false); 
            $table->boolean('is_linked')->default(false); 
            $table->string('allowed_types')->nullable(); 
            $table->timestamp('time_created')->useCurrent(); 
            $table->foreignId('added_by')->constrained('users'); 
            $table->string('status')->default('active'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
