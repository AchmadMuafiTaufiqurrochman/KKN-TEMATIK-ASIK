<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Villager;
use App\Models\Video;
use App\Models\MapLocation;
use App\Models\Aparat;
use App\Models\Product;
use App\Models\Fasilitas;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_villagers' => Aparat::count(), // Menggunakan Aparat bukan Villager
            'total_videos' => Video::count(),
            'total_locations' => MapLocation::count(),
            'total_facilities' => Fasilitas::count(),
            'total_views' => Video::sum('views'),
            'pertanian_products' => Product::where('category', 'pertanian')->count(),
            'perkebunan_products' => Product::where('category', 'perkebunan')->count(),
            'total_products' => Product::count(),
            'published_videos' => Video::where('status', 'published')->count(),
            'draft_videos' => Video::where('status', 'draft')->count(),
        ];

        // Mendapatkan video dengan views paling banyak
        $topViewedVideo = Video::orderBy('views', 'desc')->first();
        
        $recentActivities = [
            ['action' => 'Menambah berita baru', 'user' => 'Admin', 'time' => '2 jam yang lalu'],
            ['action' => 'Mengedit berita', 'user' => 'Admin', 'time' => '5 jam yang lalu'],
            ['action' => 'Hapus berita', 'user' => 'Admin', 'time' => '1 hari yang lalu'],
            ['action' => 'Berita "' . ($topViewedVideo ? $topViewedVideo->title : 'Tidak ada') . '" dengan views tertinggi: ' . ($topViewedVideo ? number_format($topViewedVideo->views) : '0'), 'user' => 'System', 'time' => '2 hari yang lalu'],
        ];

        return view('admin.dashboard', compact('stats', 'recentActivities'));
    }
}