<?php

namespace App\Http\Controllers;

use App\Models\Villager;
use App\Models\Potential;
use App\Models\Video;
use App\Models\Aparat; // <--- Tambahkan ini

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'total_villagers' => Villager::count(),
            'male_villagers' => Villager::where('gender', 'L')->count(),
            'female_villagers' => Villager::where('gender', 'P')->count(),
            'total_rt' => Villager::distinct('rt')->count(),
        ];

        $potentials = Potential::take(2)->get();
        $featured_video = Video::where('category', 'profil')
            ->where('status', 'published')
            ->first();

        $featuredVideos = Video::where('status', 'published')
            ->whereNot('category', 'profil')
            ->latest()
            ->take(3)
            ->get();

        $kepalaDesa = Aparat::where('position', 'Kepala Desa')->first();

        return view('home', compact('stats', 'potentials', 'featured_video', 'featuredVideos', 'kepalaDesa'));
    }
}
