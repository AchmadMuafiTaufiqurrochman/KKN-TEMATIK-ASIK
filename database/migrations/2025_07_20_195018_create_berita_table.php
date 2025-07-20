<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('berita', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->string('thumbnail');
        $table->string('video_url');
        $table->string('duration')->nullable();
        $table->string('category')->nullable();
        $table->enum('status', ['draft', 'published'])->default('draft');
        $table->unsignedBigInteger('views')->default(0);
        $table->timestamps();
    });
}


};
