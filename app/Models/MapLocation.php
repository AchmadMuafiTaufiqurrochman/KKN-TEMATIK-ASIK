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
    ];

    public function getTypeTextAttribute()
    {
        $types = [
            'balai' => 'Balai Desa',
            'pertanian' => 'Pertanian',
            'bunga' => 'Budidaya Bunga',
            'posyandu' => 'Posyandu',
        ];

        return $types[$this->type] ?? $this->type;
    }

    public function getTypeColorAttribute()
    {
        $colors = [
            'balai' => 'bg-blue-600',
            'pertanian' => 'bg-green-600',
            'bunga' => 'bg-pink-600',
            'posyandu' => 'bg-red-600',
        ];

        return $colors[$this->type] ?? 'bg-gray-600';
    }

    public function isActive()
    {
        return $this->status === 'active';
    }
}