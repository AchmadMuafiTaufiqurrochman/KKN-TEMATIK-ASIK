<?php

namespace App\Http\Controllers;

use App\Models\Villager;
use App\Models\Potential;
use App\Models\Video;
use App\Models\Aparat;
use App\Models\Product;
use App\Models\Fasilitas;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'total_villagers' => Villager::count(),
            'male_villagers' => Villager::where('gender', 'L')->count(),
            'female_villagers' => Villager::where('gender', 'P')->count(),
            'total_rt' => Villager::distinct('rt')->count(),
            'total_products' => Product::count(),
            'total_news' => Video::where('status', 'published')->whereNot('category', 'profil')->count(),
            'total_facilities' => Fasilitas::count(),
        ];

        $potentials = Potential::take(2)->get();
       
        // Ambil video profil terbaru berdasarkan started_at
        $video = Video::where('category', 'profil')
                      ->where('status', 'published')
                      ->orderByRaw('
                          CASE 
                              WHEN started_at IS NULL THEN 3
                              WHEN started_at <= NOW() THEN 1 
                              ELSE 2 
                          END
                      ')
                      ->orderBy('started_at', 'desc')
                      ->first();

        if ($video) {
            $video->incrementViews();
        }

        // Featured videos berdasarkan started_at
        $featuredVideos = Video::where('status', 'published')
            ->whereNot('category', 'profil')
            ->orderByRaw('
                CASE 
                    WHEN started_at IS NULL THEN 3
                    WHEN started_at <= NOW() THEN 1 
                    ELSE 2 
                END
            ')
            ->orderBy('started_at', 'desc')
            ->take(4)
            ->get();



        $kepalaDesa = Aparat::where('position', 'Kepala Desa')->first();

        return view('home', compact('stats', 'potentials', 'featuredVideos', 'kepalaDesa', 'video'));
    }
}
