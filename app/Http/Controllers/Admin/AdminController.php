<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Villager;
use App\Models\Video;
use App\Models\MapLocation;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_villagers' => Villager::count(),
            'total_videos' => Video::count(),
            'total_locations' => MapLocation::count(),
            'total_views' => Video::sum('views'),
            'male_villagers' => Villager::where('gender', 'L')->count(),
            'female_villagers' => Villager::where('gender', 'P')->count(),
            'published_videos' => Video::where('status', 'published')->count(),
            'draft_videos' => Video::where('status', 'draft')->count(),
        ];

        $recentActivities = [
            ['action' => 'Menambah warga baru', 'user' => 'Admin', 'time' => '2 jam yang lalu'],
            ['action' => 'Upload video dokumentasi', 'user' => 'Admin', 'time' => '5 jam yang lalu'],
            ['action' => 'Update lokasi peta', 'user' => 'Admin', 'time' => '1 hari yang lalu'],
            ['action' => 'Backup data warga', 'user' => 'System', 'time' => '2 hari yang lalu'],
        ];

        return view('admin.dashboard', compact('stats', 'recentActivities'));
    }
}