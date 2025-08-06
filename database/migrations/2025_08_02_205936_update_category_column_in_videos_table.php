<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('videos', function (Blueprint $table) {
        $table->string('category', 50)->change();
    });
}

public function down()
{
    Schema::table('videos', function (Blueprint $table) {
        // Ganti sesuai tipe sebelumnya, misal enum atau string pendek
        $table->enum('category', ['profil', 'kesehatan', 'ekonomi', 'pertanian', 'pemerintahan',
        'pembangunan', 'kegiatan', 'pengumuman', 'berita', 'umkm', 'karangtaruna'])->change();
    });
}

};
