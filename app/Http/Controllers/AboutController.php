<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Aparat;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        // Ambil video profil terbaru
        $video = Video::where('category', 'profil')
                      ->where('status', 'published')
                      ->orderByDesc('created_at')
                      ->first();

        if ($video) {
            $video->incrementViews();
        }

        // Ambil data Kepala Desa
        $kepalaDesa = Aparat::where('position', 'Kepala Desa')->first();

        return view('about', compact('video', 'kepalaDesa'));
    }
}
