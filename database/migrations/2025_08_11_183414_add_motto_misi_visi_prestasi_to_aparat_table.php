<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::table('aparat', function (Blueprint $table) {
            $table->text('motto')->nullable()->after('photo');
            $table->text('misi')->nullable()->after('motto');
            $table->text('visi')->nullable()->after('misi');
            $table->text('prestasi')->nullable()->after('visi');
        });
    }

    /**
     * Balikkan migrasi.
     */
    public function down(): void
    {
        Schema::table('aparat', function (Blueprint $table) {
            $table->dropColumn(['motto', 'misi', 'visi', 'prestasi']);
        });
    }
};
