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
            $table->enum('category', ['profil', 'kesehatan', 'perempuan', 'pertanian']);
            $table->string('video_url');
            $table->string('thumbnail');
            $table->text('description');
            $table->string('duration');
            $table->enum('status', ['published', 'draft'])->default('draft');
            $table->integer('views')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};