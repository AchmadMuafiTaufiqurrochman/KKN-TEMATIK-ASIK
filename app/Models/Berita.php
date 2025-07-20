<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita'; // <-- pastikan nama tabel ini cocok

    protected $fillable = [
        'title',
        'description',
        'thumbnail',
        'video_url',
        'duration',
        'category',
        'status',
        'views',
    ];
}

