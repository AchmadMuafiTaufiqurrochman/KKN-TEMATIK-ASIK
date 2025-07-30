<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop kolom 'category' agar bisa ubah enum
        Schema::table('videos', function (Blueprint $table) {
            $table->dropColumn('category');
        });

        // Tambah lagi dengan enum yang diperluas
        Schema::table('videos', function (Blueprint $table) {
            $table->enum('category', [
                'profil',
                'kesehatan',
                'perempuan',
                'pertanian',
                'pemerintahan',
                'pembangunan',
                'kegiatan',
                'pengumuman',
                'berita',
                'umkm',
                'karangtaruna',
            ])->after('title');
        });
    }

    public function down(): void
    {
        // Rollback ke enum lama
        Schema::table('videos', function (Blueprint $table) {
            $table->dropColumn('category');
        });

        Schema::table('videos', function (Blueprint $table) {
            $table->enum('category', [
                'profil',
                'kesehatan',
                'perempuan',
                'pertanian',
            ])->after('title');
        });
    }
};
