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
        Schema::create('nfc_tags', function (Blueprint $table) {
            $table->id();
            $table->string('tag_id')->unique()->index();  // Unique NFC tag identifier
            $table->unsignedBigInteger('user_id');   // Foreign key to users table
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nfc_tags');
    }
};
