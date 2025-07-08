<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'video_url',
        'thumbnail',
        'description',
        'duration',
        'status',
        'views',
    ];

    public function incrementViews()
    {
        $this->increment('views');
    }

    public function getCategoryTextAttribute()
    {
        $categories = [
            'profil' => 'Profil Desa',
            'kesehatan' => 'Kesehatan',
            'perempuan' => 'Perempuan',
            'pertanian' => 'Pertanian',
        ];

        return $categories[$this->category] ?? $this->category;
    }

    public function isPublished()
    {
        return $this->status === 'published';
    }
}