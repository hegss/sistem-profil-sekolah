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
        Schema::table('facilities', function (Blueprint $table) {
            // mengubah tipe data kolom deskripsi menjadi text
            $table->text('description')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('facilities', function (Blueprint $table) {
            // Kembalikan ke string jika di-rollback
            $table->string('deskripsi')->change();
        });
    }
};
