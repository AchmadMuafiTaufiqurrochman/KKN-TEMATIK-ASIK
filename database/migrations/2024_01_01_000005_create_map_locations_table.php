<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('map_locations', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama lokasi
            $table->text('address')->nullable(); // Alamat lokasi
            $table->decimal('latitude', 10, 7)->nullable(); // Koordinat lintang
            $table->decimal('longitude', 10, 7)->nullable(); // Koordinat bujur
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('map_locations');
    }
};
