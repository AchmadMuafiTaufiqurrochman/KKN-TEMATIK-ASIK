<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MapLocation;

class FacilitySeeder extends Seeder
{
    public function run(): void
    {
        $facilities = [
            [
                'name' => 'Kantor Desa Wonokarang',
                'latitude' => -7.7956,
                'longitude' => 110.3695,
                'type' => 'pelayanan_publik',
                'description' => 'Kantor desa tempat pelayanan administrasi kependudukan dan pelayanan publik lainnya',
                'opening_hours' => 'Senin-Jumat 07:30-16:00',
                'pic_name' => 'Kepala Desa',
                'contact' => '0274-123456',
                'status' => 'active',
            ],
            [
                'name' => 'Balai Desa Wonokarang',
                'latitude' => -7.7960,
                'longitude' => 110.3700,
                'type' => 'sosial_budaya',
                'description' => 'Balai desa untuk kegiatan masyarakat, pertemuan, dan acara budaya',
                'opening_hours' => 'Senin-Minggu 08:00-22:00',
                'pic_name' => 'Sekretaris Desa',
                'contact' => '0274-123457',
                'status' => 'active',
            ],
            [
                'name' => 'SDN Wonokarang 1',
                'latitude' => -7.7950,
                'longitude' => 110.3680,
                'type' => 'pendidikan',
                'description' => 'Sekolah Dasar Negeri Wonokarang 1 dengan fasilitas lengkap',
                'opening_hours' => 'Senin-Sabtu 07:00-14:00',
                'pic_name' => 'Kepala Sekolah',
                'contact' => '0274-123458',
                'status' => 'active',
            ],
            [
                'name' => 'Puskesmas Wonokarang',
                'latitude' => -7.7965,
                'longitude' => 110.3690,
                'type' => 'kesehatan',
                'description' => 'Pusat kesehatan masyarakat dengan pelayanan kesehatan dasar',
                'opening_hours' => 'Senin-Sabtu 08:00-15:00',
                'pic_name' => 'Dokter Kepala Puskesmas',
                'contact' => '0274-123459',
                'status' => 'active',
            ],
            [
                'name' => 'Posyandu Melati',
                'latitude' => -7.7945,
                'longitude' => 110.3710,
                'type' => 'kesehatan',
                'description' => 'Pos pelayanan terpadu untuk kesehatan ibu dan anak',
                'opening_hours' => 'Setiap Rabu 09:00-12:00',
                'pic_name' => 'Kader Posyandu',
                'contact' => '081234567890',
                'status' => 'active',
            ],
            [
                'name' => 'Pasar Desa Wonokarang',
                'latitude' => -7.7970,
                'longitude' => 110.3705,
                'type' => 'ekonomi',
                'description' => 'Pasar tradisional desa dengan berbagai kebutuhan sehari-hari',
                'opening_hours' => 'Setiap hari 06:00-18:00',
                'pic_name' => 'Pengelola Pasar',
                'contact' => '081234567891',
                'status' => 'active',
            ],
            [
                'name' => 'UMKM Kerajinan Bambu',
                'latitude' => -7.7940,
                'longitude' => 110.3720,
                'type' => 'ekonomi',
                'description' => 'Usaha mikro kecil menengah produksi kerajinan bambu',
                'opening_hours' => 'Senin-Sabtu 08:00-17:00',
                'pic_name' => 'Pak Slamet',
                'contact' => '081234567892',
                'status' => 'active',
            ],
            [
                'name' => 'Sanggar Tari Wonokarang',
                'latitude' => -7.7955,
                'longitude' => 110.3715,
                'type' => 'sosial_budaya',
                'description' => 'Sanggar seni tari tradisional untuk melestarikan budaya daerah',
                'opening_hours' => 'Selasa dan Kamis 19:00-21:00',
                'pic_name' => 'Bu Sari',
                'contact' => '081234567893',
                'status' => 'active',
            ]
        ];

        foreach ($facilities as $facility) {
            MapLocation::create($facility);
        }
    }
}
