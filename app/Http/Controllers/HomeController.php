<?php

namespace App\Http\Controllers;

use App\Models\Villager;
use App\Models\Potential;
use App\Models\Video;
use App\Models\Product;
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

        // Produk unggulan (3 terbaru)
        $products = Product::where('status', 'published')
            ->latest()
            ->take(3)
            ->get();


        $featured_video = Video::where('category', 'profil')
            ->where('status', 'published')
            ->first();

        // Tambahan: Ambil 3 dokumentasi unggulan terbaru dengan status published
        $featuredVideos = Video::where('status', 'published')
            ->whereNot('category', 'profil') // optional: exclude video profil
            ->latest()
            ->take(3)
            ->get();

        return view('home', compact('stats', 'products', 'featured_video', 'featuredVideos'));
    }
}
