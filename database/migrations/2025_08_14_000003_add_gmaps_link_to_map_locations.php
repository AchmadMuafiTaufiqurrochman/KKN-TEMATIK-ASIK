<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('map_locations', function (Blueprint $table) {
            $table->string('gmaps_link', 500)->nullable()->after('contact');
        });
    }

    public function down(): void
    {
        Schema::table('map_locations', function (Blueprint $table) {
            $table->dropColumn('gmaps_link');
        });
    }
};
