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
        'type',
        'started_at',
        // is_finished dihapus karena sekarang dihitung secara dinamis
    ];

    protected $casts = [
        'started_at' => 'datetime',
        // is_finished dihapus karena sekarang dihitung secara dinamis
    ];

    public function incrementViews()
    {
        $this->increment('views');
    }

    public function getThumbnailUrlAttribute()
    {
        if (!$this->thumbnail) {
            return asset('img/placeholder.jpg');
        }
        
        // Jika path sudah mengandung 'storage/', gunakan asset langsung
        if (strpos($this->thumbnail, 'storage/') === 0) {
            return asset($this->thumbnail);
        }
        
        // Jika tidak, tambahkan 'storage/' prefix
        return asset('storage/' . $this->thumbnail);
    }

    public function getEmbedVideoUrlAttribute()
    {
        $url = $this->video_url;
        
        if (!$url) {
            return null;
        }
        
        // Convert YouTube watch URL to embed URL
        if (strpos($url, 'youtube.com/watch') !== false) {
            return str_replace('watch?v=', 'embed/', $url);
        } elseif (strpos($url, 'youtu.be/') !== false) {
            return str_replace('youtu.be/', 'youtube.com/embed/', $url);
        }
        
        return $url;
    }

    public function getCategoryTextAttribute()
    {
        $categories = [
            'profil' => 'Profil Desa',
            'kesehatan' => 'Kesehatan',
            'ekonomi' => 'Ekonomi',
            'pertanian' => 'Pertanian',
            'pemerintahan' => 'Pemerintahan',
            'pembangunan' => 'Pembangunan',
            'kegiatan' => 'Kegiatan',
            'pengumuman' => 'Pengumuman',
            'berita' => 'Berita',
            'umkm' => 'UMKM',
            'karangtaruna' => 'Karang Taruna',
            'budidayabunga' => 'Budidaya Bunga',
        ];

        return $categories[$this->category] ?? ucfirst($this->category);
    }

    public function isPublished()
    {
        return $this->status === 'published';
    }

    // Accessor untuk menghitung is_finished secara dinamis
    public function getIsFinishedAttribute()
    {
        // Jika tidak ada tanggal mulai, dianggap belum selesai
        if (!$this->started_at) {
            return false;
        }
        
        // Bandingkan tanggal sekarang dengan tanggal mulai acara
        return now()->greaterThan($this->started_at);
    }
}
