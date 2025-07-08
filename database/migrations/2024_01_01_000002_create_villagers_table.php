<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('villagers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nik', 16)->unique();
            $table->enum('gender', ['L', 'P']);
            $table->date('birth_date');
            $table->string('job');
            $table->string('education');
            $table->string('rt', 10);
            $table->string('rw', 10);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('villagers');
    }
};