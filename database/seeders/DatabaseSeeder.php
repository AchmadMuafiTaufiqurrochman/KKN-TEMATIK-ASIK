<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Villager;
use App\Models\Video;
use App\Models\MapLocation;
use App\Models\Potential;
use App\Models\Aparat;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
       
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

        
        Potential::firstOrCreate([
            'title' => 'Pertanian Modern',
            'category' => 'pertanian',
            'description' => 'Sektor pertanian menjadi salah satu potensi unggulan Desa Wonokarang, khususnya di wilayah Dusun Tengah yang mayoritas masyarakatnya bertumpu pada bidang ini. Dengan dukungan lahan pertanian yang cukup luas, masyarakat mulai mengembangkan pertanian modern yang lebih efisien melalui penggunaan teknologi, pola tanam yang berkelanjutan, serta pemanfaatan pupuk organik untuk menjaga kualitas tanah. Langkah ini tidak hanya meningkatkan produktivitas hasil panen, tetapi juga menjadi upaya nyata dalam mendukung ketahanan pangan desa.',
            'image' => 'https://images.pexels.com/photos/1595108/pexels-photo-1595108.jpeg?auto=compress&cs=tinysrgb&w=800'
        ]);

        Potential::firstOrCreate([
            'title' => 'Budidaya Bunga',
            'category' => 'bunga',
            'description' => 'Desa Wonokarang juga memiliki potensi besar dalam budidaya bunga yang mulai dilirik oleh masyarakat sebagai peluang usaha baru. Budidaya bunga tidak hanya bernilai ekonomis tinggi karena tingginya permintaan pasar untuk kebutuhan hias maupun acara, tetapi juga mampu mempercantik lingkungan desa sehingga menghadirkan nilai estetika tersendiri. Kombinasi pertanian modern dan budidaya bunga ini diharapkan dapat membuka lapangan pekerjaan baru, meningkatkan kesejahteraan masyarakat, serta menjadikan Desa Wonokarang sebagai salah satu desa percontohan dalam pengembangan sektor pertanian dan hortikultura di Kecamatan Balongbendo.',
            'image' => 'https://images.pexels.com/photos/1486974/pexels-photo-1486974.jpeg?auto=compress&cs=tinysrgb&w=800'
        ]);

        // Seed fasilitas desa (opsional)
        // $this->call(FacilitySeeder::class);

    }
}