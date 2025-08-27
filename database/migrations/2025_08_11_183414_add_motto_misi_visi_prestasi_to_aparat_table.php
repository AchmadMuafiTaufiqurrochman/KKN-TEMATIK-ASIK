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
            // Check if columns don't already exist before adding them
            if (!Schema::hasColumn('aparat', 'motto')) {
                $table->text('motto')->nullable()->after('photo');
            }
            if (!Schema::hasColumn('aparat', 'misi')) {
                $table->text('misi')->nullable()->after('motto');
            }
            if (!Schema::hasColumn('aparat', 'visi')) {
                $table->text('visi')->nullable()->after('misi');
            }
            if (!Schema::hasColumn('aparat', 'prestasi')) {
                $table->text('prestasi')->nullable()->after('visi');
            }
        });
    }

    /**
     * Balikkan migrasi.
     */
    public function down(): void
    {
        Schema::table('aparat', function (Blueprint $table) {
            // Only drop columns if they exist and were added by this migration
            // Since these columns already exist in the original table creation,
            // we should not drop them in this migration's rollback
            // $table->dropColumn(['motto', 'misi', 'visi', 'prestasi']);
        });
    }
};
