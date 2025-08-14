<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->enum('type', ['pelayanan_publik', 'pendidikan', 'kesehatan', 'ekonomi', 'sosial_budaya']);
            $table->text('description');
            $table->string('opening_hours')->nullable();
            $table->string('pic_name')->nullable();
            $table->string('contact')->nullable();
            $table->string('gmaps_link')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
    }
};
