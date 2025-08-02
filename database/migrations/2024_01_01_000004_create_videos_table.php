<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('category', [
                'profil',
                'kesehatan',
                'ekonomi',
                'pertanian',
                'pemerintahan',
                'pembangunan',
                'kegiatan',
                'pengumuman',
                'berita',
                'umkm',
                'karangtaruna',
            ]);
            $table->enum('type', ['video', 'gambar']);
            $table->string('video_url')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('duration')->nullable();
            $table->longText('description')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->unsignedBigInteger('views')->default(0);
            $table->timestamps();
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
