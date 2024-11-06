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
        Schema::create('analytics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nfc_tag_id');
            $table->string('ip_address')->nullable();
            $table->string('location')->nullable();
            $table->string('user_agent')->nullable();  // New column to track the browser or app details
            $table->timestamp('scanned_at');
            $table->timestamps();
        
            $table->foreign('nfc_tag_id')->references('id')->on('nfc_tags')->onDelete('cascade');
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analytics');
    }
};
