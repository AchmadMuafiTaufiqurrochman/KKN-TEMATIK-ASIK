<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Migrate data dari map_locations ke fasilitas
        $mapLocations = DB::table('map_locations')->get();
        
        foreach ($mapLocations as $location) {
            DB::table('fasilitas')->insert([
                'name' => $location->name,
                'latitude' => $location->latitude,
                'longitude' => $location->longitude,
                'type' => $location->type,
                'description' => $location->description,
                'opening_hours' => $location->opening_hours,
                'pic_name' => $location->pic_name,
                'contact' => $location->contact,
                'gmaps_link' => null, // Field baru, akan diisi manual nanti
                'status' => $location->status ?? 'active',
                'created_at' => $location->created_at ?? now(),
                'updated_at' => $location->updated_at ?? now(),
            ]);
        }
    }

    public function down(): void
    {
        // Hapus semua data dari tabel fasilitas
        DB::table('fasilitas')->truncate();
    }
};
