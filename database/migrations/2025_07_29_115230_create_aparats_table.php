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

            // Field tambahan khusus Kepala Desa
            $table->text('motto')->nullable();    // Motto Kepala Desa
            $table->text('visi')->nullable();     // Visi Kepala Desa
            $table->text('misi')->nullable();     // Misi Kepala Desa
            $table->text('prestasi')->nullable(); // Prestasi Kepala Desa

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
