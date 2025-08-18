<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Tambah field baru untuk fasilitas desa terlebih dahulu
        Schema::table('map_locations', function (Blueprint $table) {
            $table->string('opening_hours')->nullable()->after('description');
            $table->string('pic_name')->nullable()->after('opening_hours');
            $table->string('contact')->nullable()->after('pic_name');
        });

        // Ubah enum type untuk fasilitas desa yang baru dengan raw SQL
        DB::statement("ALTER TABLE map_locations MODIFY COLUMN type ENUM('pelayanan_publik', 'pendidikan', 'kesehatan', 'ekonomi', 'sosial_budaya') NOT NULL");
    }

    public function down(): void
    {
        Schema::table('map_locations', function (Blueprint $table) {
            // Hapus kolom yang ditambahkan
            $table->dropColumn(['opening_hours', 'pic_name', 'contact']);
        });
        
        // Kembalikan enum type yang lama dengan raw SQL
        DB::statement("ALTER TABLE map_locations MODIFY COLUMN type ENUM('balai', 'pertanian', 'bunga', 'posyandu') NOT NULL");
    }
};
