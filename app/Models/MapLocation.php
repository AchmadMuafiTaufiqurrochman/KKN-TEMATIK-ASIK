<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'type',
        'description',
        'status',
        'opening_hours',
        'pic_name',
        'contact',
        'gmaps_link',
    ];

    public function getTypeTextAttribute()
    {
        $types = [
            'pelayanan_publik' => 'Pelayanan Publik & Pemerintah',
            'pendidikan' => 'Pendidikan',
            'kesehatan' => 'Kesehatan',
            'ekonomi' => 'Ekonomi',
            'sosial_budaya' => 'Sosial & Budaya',
        ];

        return $types[$this->type] ?? ucfirst(str_replace('_', ' ', $this->type));
    }

    public function getTypeColorAttribute()
    {
        $colors = [
            'pelayanan_publik' => 'bg-blue-600',
            'pendidikan' => 'bg-green-600',
            'kesehatan' => 'bg-red-600',
            'ekonomi' => 'bg-yellow-600',
            'sosial_budaya' => 'bg-purple-600',
        ];

        return $colors[$this->type] ?? 'bg-gray-600';
    }

    public function isActive()
    {
        return $this->status === 'active';
    }

    public function isOpenToday()
    {
        // Implementasi sederhana untuk mengecek apakah buka hari ini
        if (!$this->opening_hours) {
            return false;
        }
        
        $today = date('l'); // Nama hari dalam bahasa Inggris
        $indonesianDays = [
            'Monday' => 'senin',
            'Tuesday' => 'selasa', 
            'Wednesday' => 'rabu',
            'Thursday' => 'kamis',
            'Friday' => 'jumat',
            'Saturday' => 'sabtu',
            'Sunday' => 'minggu'
        ];
        
        $todayIndo = $indonesianDays[$today] ?? strtolower($today);
        $openingHours = strtolower($this->opening_hours);
        
        // Cek jika "setiap hari" atau "senin-minggu"
        if (strpos($openingHours, 'setiap hari') !== false || 
            strpos($openingHours, 'senin-minggu') !== false) {
            return true;
        }
        
        // Cek jika hari ini disebutkan
        return strpos($openingHours, $todayIndo) !== false;
    }

    public static function getTypesWithCounts()
    {
        return self::selectRaw('type, COUNT(*) as count')
                   ->groupBy('type')
                   ->pluck('count', 'type')
                   ->toArray();
    }
}