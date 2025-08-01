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
        Schema::create('aparat', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique();      // NIP kolom wajib dan unik
            $table->string('name');               // Nama aparat
            $table->string('position');           // Jabatan
            $table->enum('gender', ['L', 'P'])->nullable(); // Opsional, untuk statistik
            $table->string('photo')->nullable();  // Path foto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aparat');
    }
};
