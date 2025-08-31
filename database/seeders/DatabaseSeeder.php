<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Villager;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // === Seed User Admin ===
        User::firstOrCreate(
            ['email' => 'admin@wonokarang.desa.id'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'admin2@wonokarang.desa.id'],
            [
                'name' => 'Administrator2',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // === Seed Villagers ===
        $villagers = [
            ['name' => 'Ahmad Subagyo', 'nik' => '3301012345678901', 'gender' => 'L', 'birth_date' => '1975-03-15', 'job' => 'Petani', 'education' => 'SMA', 'rt' => '01', 'rw' => '01'],
            ['name' => 'Siti Rahayu', 'nik' => '3301012345678902', 'gender' => 'P', 'birth_date' => '1980-07-22', 'job' => 'Ibu Rumah Tangga', 'education' => 'SMP', 'rt' => '01', 'rw' => '01'],
            ['name' => 'Bambang Setiawan', 'nik' => '3301012345678903', 'gender' => 'L', 'birth_date' => '1982-11-08', 'job' => 'Peternak', 'education' => 'S1', 'rt' => '02', 'rw' => '01'],
            ['name' => 'Dewi Kusuma', 'nik' => '3301012345678904', 'gender' => 'P', 'birth_date' => '1985-04-12', 'job' => 'Guru', 'education' => 'S1', 'rt' => '02', 'rw' => '01'],
            ['name' => 'Joko Santoso', 'nik' => '3301012345678905', 'gender' => 'L', 'birth_date' => '1970-09-30', 'job' => 'Pedagang', 'education' => 'SMA', 'rt' => '01', 'rw' => '02'],
            ['name' => 'Nur Hidayati', 'nik' => '3301012345678906', 'gender' => 'P', 'birth_date' => '1988-01-25', 'job' => 'Petani Bunga', 'education' => 'D3', 'rt' => '02', 'rw' => '02'],
        ];

        foreach ($villagers as $villager) {
            Villager::firstOrCreate(
                ['nik' => $villager['nik']],
                $villager
            );
        }

        // === Seed Products ===
        $products = [
            [
                'name_product' => 'Padi Organik Wonokarang',
                'category' => 'pertanian',
                'owner' => 'Kelompok Tani Maju Jaya',
                'contact' => '081234567890',
                'description' => 'Padi organik ditanam tanpa bahan kimia, kualitas premium.',
                'image' => 'padi.jpg',
                'status' => 'active',
            ],
            [
                'name_product' => 'Bunga Mawar Merah',
                'category' => 'budidaya-bunga',
                'owner' => 'Sari Bunga Florist',
                'contact' => '082345678901',
                'description' => 'Bunga mawar segar hasil budidaya lokal, cocok untuk dekorasi & hadiah.',
                'image' => 'mawar.jpg',
                'status' => 'active',
            ],
            [
                'name_product' => 'Sayur Kangkung Segar',
                'category' => 'pertanian',
                'owner' => 'Pak Slamet',
                'contact' => '083456789012',
                'description' => 'Kangkung segar dipetik langsung dari kebun setiap pagi.',
                'image' => 'kangkung.jpg',
                'status' => 'inactive',
            ],
        ];

        foreach ($products as $product) {
            DB::table('products')->updateOrInsert(
                ['name_product' => $product['name_product']],
                array_merge($product, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }

        // === Tambahan Seeder lain jika ada ===
        // $this->call(FacilitySeeder::class);
    }
}
