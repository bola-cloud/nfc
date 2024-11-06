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
        Schema::create('profile_links', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profile_id');  // Foreign key to profiles table
            $table->string('type');  // e.g., 'facebook', 'twitter', 'instagram', 'custom'
            $table->string('label')->nullable();  // Optional label for custom links
            $table->string('url');  // Link to social media or custom website
            $table->timestamps();
        
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_links');
    }
};