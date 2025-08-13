<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('map_locations', function (Blueprint $table) {
            // Ubah enum type untuk fasilitas desa yang baru
            $table->dropColumn('type');
        });
        
        Schema::table('map_locations', function (Blueprint $table) {
            $table->enum('type', [
                'pelayanan_publik', 
                'pendidikan', 
                'kesehatan', 
                'ekonomi', 
                'sosial_budaya'
            ])->after('longitude');
            
            // Tambah field baru untuk fasilitas desa
            $table->string('opening_hours')->nullable()->after('description');
            $table->string('pic_name')->nullable()->after('opening_hours');
            $table->string('contact')->nullable()->after('pic_name');
        });
    }

    public function down(): void
    {
        Schema::table('map_locations', function (Blueprint $table) {
            // Hapus kolom yang ditambahkan
            $table->dropColumn(['opening_hours', 'pic_name', 'contact']);
            $table->dropColumn('type');
        });
        
        Schema::table('map_locations', function (Blueprint $table) {
            // Kembalikan enum type yang lama
            $table->enum('type', ['balai', 'pertanian', 'bunga', 'posyandu'])->after('longitude');
        });
    }
};
