<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected $table = 'fasilitas';

    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'type',
        'description',
        'opening_hours',
        'pic_name',
        'contact',
        'gmaps_link',
        'status',
    ];

    public function getTypeTextAttribute()
    {
        $types = [
            'pelayanan_publik' => 'Pelayanan Publik & Pemerintah',
            'pendidikan' => 'Pendidikan',
            'kesehatan' => 'Kesehatan',
            'ekonomi' => 'Ekonomi',
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
        $allowedTypes = ['pelayanan_publik', 'pendidikan', 'kesehatan', 'ekonomi'];
        
        return self::selectRaw('type, COUNT(*) as count')
                   ->whereIn('type', $allowedTypes)
                   ->groupBy('type')
                   ->pluck('count', 'type')
                   ->toArray();
    }
}
