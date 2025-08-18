<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('nama_produk')->after('id');
            $table->unsignedBigInteger('lokasi_id')->after('nama_produk');
            $table->enum('kategori_produk', ['pertanian', 'bunga'])->after('lokasi_id');
            $table->text('owner')->after('kategori_produk');
            $table->string('kontak', 20)->after('owner');
            $table->text('description')->nullable()->after('kontak');
            $table->string('image')->nullable()->after('description');
            $table->enum('status', ['active', 'inactive'])->default('active')->after('image');

            // Relasi ke tabel map_locations
            $table->foreign('lokasi_id')->references('id')->on('map_locations')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['lokasi_id']);
            $table->dropColumn([
                'nama_produk',
                'lokasi_id',
                'kategori_produk',
                'owner',
                'kontak',
                'description',
                'image',
                'status'
            ]);
        });
    }
};
