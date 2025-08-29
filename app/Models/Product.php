<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'description', 'category', 'image', 'contact', 'status'
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function getCategoryTextAttribute()
    {
        $categories = [
            'pertanian' => 'Pertanian',
            'bunga' => 'Budidaya Bunga',
            'umkm' => 'UMKM',
            'kerajinan' => 'Kerajinan',
            'kuliner' => 'Kuliner',
        ];

        return $categories[$this->category] ?? ucfirst($this->category);
    }
}
