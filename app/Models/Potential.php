<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Potential extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'description',
        'image',
    ];

    public function getCategoryTextAttribute()
    {
        $categories = [
            'pertanian' => 'Pertanian',
            'bunga' => 'Budidaya Bunga',
        ];

        return $categories[$this->category] ?? $this->category;
    }
}
