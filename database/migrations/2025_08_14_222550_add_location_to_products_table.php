<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('map_location_id')->nullable()->after('id');

            $table->foreign('map_location_id')
                  ->references('id')->on('map_locations')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['map_location_id']);
            $table->dropColumn('map_location_id');
        });
    }
};
