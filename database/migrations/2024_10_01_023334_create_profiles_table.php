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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');  // Foreign key to users table
            $table->text('bio')->nullable();      // User bio or short description
            $table->string('website')->nullable();  // Main website URL
            $table->string('profile_image')->nullable();  // Profile picture (image path)
            $table->string('company')->nullable();  // Company name
            $table->string('job_title')->nullable();  // Job title
            $table->timestamps();
        
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
