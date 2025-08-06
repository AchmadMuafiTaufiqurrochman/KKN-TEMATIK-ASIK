<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Villager;
use App\Models\Video;
use App\Models\MapLocation;
use App\Models\Potential;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun admin (hindari duplikat)
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

        // Buat data warga
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

        // Buat data potensi desa
        Potential::firstOrCreate([
            'title' => 'Pertanian Modern',
            'category' => 'pertanian',
            'description' => 'Mengembangkan teknologi pertanian modern dengan sistem irigasi tetes dan penggunaan pupuk organik untuk hasil panen yang optimal.',
            'image' => 'https://images.pexels.com/photos/1595108/pexels-photo-1595108.jpeg?auto=compress&cs=tinysrgb&w=800'
        ]);

        Potential::firstOrCreate([
            'title' => 'Budidaya Bunga',
            'category' => 'bunga',
            'description' => 'Spesialisasi budidaya bunga potong dan tanaman hias dengan kualitas ekspor yang telah menembus pasar nasional dan internasional.',
            'image' => 'https://images.pexels.com/photos/1486974/pexels-photo-1486974.jpeg?auto=compress&cs=tinysrgb&w=800'
        ]);

        // Buat data video
        $videos = [
            [
                'title' => 'Profil Desa Mekar Sari 2024',
                'category' => 'profil',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'thumbnail' => 'https://images.pexels.com/photos/1595108/pexels-photo-1595108.jpeg?auto=compress&cs=tinysrgb&w=800',
                'description' => 'Video profil lengkap Desa Mekar Sari menampilkan potensi dan keindahan desa',
                'duration' => '8:42',
                'status' => 'published',
                'views' => 12543
            ],
            [
                'title' => 'Program Posyandu Balixta',
                'category' => 'kesehatan',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'thumbnail' => 'https://images.pexels.com/photos/6303768/pexels-photo-6303768.jpeg?auto=compress&cs=tinysrgb&w=800',
                'description' => 'Kegiatan posyandu rutin untuk memantau kesehatan balita di desa',
                'duration' => '5:42',
                'status' => 'published',
                'views' => 1234
            ],
            [
                'title' => 'Program Posyandu Balicta',
                'category' => 'kesehatan',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'thumbnail' => 'https://images.pexels.com/photos/6303768/pexels-photo-6303768.jpeg?auto=compress&cs=tinysrgb&w=800',
                'description' => 'Kegiatan posyandu rutin untuk memantau kesehatan balita di desa',
                'duration' => '5:42',
                'status' => 'published',
                'views' => 1234
            ],
            [
                'title' => 'Program Posyandu Balhita',
                'category' => 'kesehatan',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'thumbnail' => 'https://images.pexels.com/photos/6303768/pexels-photo-6303768.jpeg?auto=compress&cs=tinysrgb&w=800',
                'description' => 'Kegiatan posyandu rutin untuk memantau kesehatan balita di desa',
                'duration' => '5:42',
                'status' => 'published',
                'views' => 1234
            ],
            [
                'title' => 'Program Posyandu Balifta',
                'category' => 'kesehatan',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'thumbnail' => 'https://images.pexels.com/photos/6303768/pexels-photo-6303768.jpeg?auto=compress&cs=tinysrgb&w=800',
                'description' => 'Kegiatan posyandu rutin untuk memantau kesehatan balita di desa',
                'duration' => '5:42',
                'status' => 'published',
                'views' => 1234
            ],
            [
                'title' => 'Program Posyandu Balista',
                'category' => 'kesehatan',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'thumbnail' => 'https://images.pexels.com/photos/6303768/pexels-photo-6303768.jpeg?auto=compress&cs=tinysrgb&w=800',
                'description' => 'Kegiatan posyandu rutin untuk memantau kesehatan balita di desa',
                'duration' => '5:42',
                'status' => 'published',
                'views' => 1234
            ],
            [
                'title' => 'Program Posyandu Balgita',
                'category' => 'kesehatan',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'thumbnail' => 'https://images.pexels.com/photos/6303768/pexels-photo-6303768.jpeg?auto=compress&cs=tinysrgb&w=800',
                'description' => 'Kegiatan posyandu rutin untuk memantau kesehatan balita di desa',
                'duration' => '5:42',
                'status' => 'published',
                'views' => 1234
            ],
            [
                'title' => 'Program Posyandu Balipta',
                'category' => 'kesehatan',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'thumbnail' => 'https://images.pexels.com/photos/6303768/pexels-photo-6303768.jpeg?auto=compress&cs=tinysrgb&w=800',
                'description' => 'Kegiatan posyandu rutin untuk memantau kesehatan balita di desa',
                'duration' => '5:42',
                'status' => 'published',
                'views' => 1234
            ],
            [
                'title' => 'Program Posyandu Balaita',
                'category' => 'kesehatan',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'thumbnail' => 'https://images.pexels.com/photos/6303768/pexels-photo-6303768.jpeg?auto=compress&cs=tinysrgb&w=800',
                'description' => 'Kegiatan posyandu rutin untuk memantau kesehatan balita di desa',
                'duration' => '5:42',
                'status' => 'published',
                'views' => 1234
            ],
            [
                'title' => 'Program Posyandu Balitka',
                'category' => 'kesehatan',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'thumbnail' => 'https://images.pexels.com/photos/6303768/pexels-photo-6303768.jpeg?auto=compress&cs=tinysrgb&w=800',
                'description' => 'Kegiatan posyandu rutin untuk memantau kesehatan balita di desa',
                'duration' => '5:42',
                'status' => 'published',
                'views' => 1234
            ],
            [
                'title' => 'Program Posyandu Balizta',
                'category' => 'kesehatan',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'thumbnail' => 'https://images.pexels.com/photos/6303768/pexels-photo-6303768.jpeg?auto=compress&cs=tinysrgb&w=800',
                'description' => 'Kegiatan posyandu rutin untuk memantau kesehatan balita di desa',
                'duration' => '5:42',
                'status' => 'published',
                'views' => 1234
            ],
            [
                'title' => 'Program Posyandu Baluita',
                'category' => 'kesehatan',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'thumbnail' => 'https://images.pexels.com/photos/6303768/pexels-photo-6303768.jpeg?auto=compress&cs=tinysrgb&w=800',
                'description' => 'Kegiatan posyandu rutin untuk memantau kesehatan balita di desa',
                'duration' => '5:42',
                'status' => 'published',
                'views' => 1234
            ],
            [
                'title' => 'Program Posyandu Balnita',
                'category' => 'kesehatan',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'thumbnail' => 'https://images.pexels.com/photos/6303768/pexels-photo-6303768.jpeg?auto=compress&cs=tinysrgb&w=800',
                'description' => 'Kegiatan posyandu rutin untuk memantau kesehatan balita di desa',
                'duration' => '5:42',
                'status' => 'published',
                'views' => 1234
            ],
            [
                'title' => 'Program Posyandu Balbita',
                'category' => 'kesehatan',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'thumbnail' => 'https://images.pexels.com/photos/6303768/pexels-photo-6303768.jpeg?auto=compress&cs=tinysrgb&w=800',
                'description' => 'Kegiatan posyandu rutin untuk memantau kesehatan balita di desa',
                'duration' => '5:42',
                'status' => 'published',
                'views' => 1234
            ],
            [
                'title' => 'Program Posyandu Baqlita',
                'category' => 'kesehatan',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'thumbnail' => 'https://images.pexels.com/photos/6303768/pexels-photo-6303768.jpeg?auto=compress&cs=tinysrgb&w=800',
                'description' => 'Kegiatan posyandu rutin untuk memantau kesehatan balita di desa',
                'duration' => '5:42',
                'status' => 'published',
                'views' => 1234
            ],
            [
                'title' => 'Program Posyandu Balicta',
                'category' => 'kesehatan',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'thumbnail' => 'https://images.pexels.com/photos/6303768/pexels-photo-6303768.jpeg?auto=compress&cs=tinysrgb&w=800',
                'description' => 'Kegiatan posyandu rutin untuk memantau kesehatan balita di desa',
                'duration' => '5:42',
                'status' => 'published',
                'views' => 1234
            ],
            [
                'title' => 'Program Posyandu Balitsa',
                'category' => 'kesehatan',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'thumbnail' => 'https://images.pexels.com/photos/6303768/pexels-photo-6303768.jpeg?auto=compress&cs=tinysrgb&w=800',
                'description' => 'Kegiatan posyandu rutin untuk memantau kesehatan balita di desa',
                'duration' => '5:42',
                'status' => 'published',
                'views' => 1234
            ],
            [
                'title' => 'Program Posyandu Balitai',
                'category' => 'karang taruna',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'thumbnail' => 'https://images.pexels.com/photos/6303768/pexels-photo-6303768.jpeg?auto=compress&cs=tinysrgb&w=800',
                'description' => 'Kegiatan posyandu rutin untuk memantau kesehatan balita di desa',
                'duration' => '5:42',
                'status' => 'published',
                'views' => 1234
            ],
            [
                'title' => 'Program Posyandu Balitau',
                'category' => 'kegiatan',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'thumbnail' => 'https://images.pexels.com/photos/6303768/pexels-photo-6303768.jpeg?auto=compress&cs=tinysrgb&w=800',
                'description' => 'Kegiatan posyandu rutin untuk memantau kesehatan balita di desa',
                'duration' => '5:42',
                'status' => 'published',
                'views' => 1234
            ],
            [
                'title' => 'Program Posyandu Balitaa',
                'category' => 'ekonomi',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'thumbnail' => 'https://images.pexels.com/photos/6303768/pexels-photo-6303768.jpeg?auto=compress&cs=tinysrgb&w=800',
                'description' => 'Kegiatan posyandu rutin untuk memantau kesehatan balita di desa',
                'duration' => '5:42',
                'status' => 'published',
                'views' => 1234
            ],
            [
                'title' => 'Pemberdayaan Perempuan Melalui UMKM',
                'category' => 'ekonomi',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'thumbnail' => 'https://images.pexels.com/photos/3771115/pexels-photo-3771115.jpeg?auto=compress&cs=tinysrgb&w=800',
                'description' => 'Program pelatihan keterampilan untuk meningkatkan ekonomi keluarga',
                'duration' => '8:15',
                'status' => 'published',
                'views' => 2156
            ]
        ];

        foreach ($videos as $video) {
            Video::firstOrCreate(
                ['title' => $video['title']],
                $video
            );
        }

        // Buat data lokasi peta
        $locations = [
            [
                'name' => 'Balai Desa Mekar Sari',
                'latitude' => -7.7956,
                'longitude' => 110.3695,
                'type' => 'balai',
                'description' => 'Kantor pemerintahan desa dan pusat pelayanan masyarakat',
                'status' => 'active'
            ],
            [
                'name' => 'Area Pertanian Utama',
                'latitude' => -7.7970,
                'longitude' => 110.3710,
                'type' => 'pertanian',
                'description' => 'Lahan pertanian seluas 150 Ha dengan sistem irigasi modern',
                'status' => 'active'
            ],
            [
                'name' => 'Kebun Bunga Sari Indah',
                'latitude' => -7.7940,
                'longitude' => 110.3680,
                'type' => 'bunga',
                'description' => 'Pusat budidaya bunga potong dan tanaman hias',
                'status' => 'active'
            ],
            [
                'name' => 'Posyandu Melati',
                'latitude' => -7.7960,
                'longitude' => 110.3700,
                'type' => 'posyandu',
                'description' => 'Pos pelayanan kesehatan terpadu untuk balita dan lansia',
                'status' => 'active'
            ]
        ];

        foreach ($locations as $location) {
            MapLocation::firstOrCreate(
                ['name' => $location['name']],
                $location
            );
        }
    }
}
