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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('referral_code');
            $table->string('sender_name');
            $table->string('sender_phone');
            $table->enum('category', ['infrastructure', 'learning', 'others']);
            $table->text('message');
            $table->enum('status', ['accepted', 'processing', 'done'])->default('accepted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
