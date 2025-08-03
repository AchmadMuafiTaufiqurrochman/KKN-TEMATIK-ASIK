<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    // Halaman profil (misal khusus kategori 'profil')
    public function index()
    {
        $video = Video::where('category', 'profil')
                      ->where('status', 'published')
                      ->first();

        if ($video) {
            $video->incrementViews();
        }

        return view('video-profile', compact('video'));
    }

    public function detail($id, Request $request)
{
    $highlighted = Video::findOrFail($id);

    $selectedCategory = $request->query('category');

    $beritas = Video::where('status', 'published')
        ->where('id', '!=', $id)
        ->when($selectedCategory && $selectedCategory !== 'semua', function ($query) use ($selectedCategory) {
            $query->where('category', $selectedCategory);
        })
        ->latest()
        ->get();

    // ✅ Ambil jumlah berita per kategori
    $categories = [
        'semua' => Video::where('status', 'published')->count(),
        'kesehatan' => Video::where('status', 'published')->where('category', 'kesehatan')->count(),
        'ekonomi' => Video::where('status', 'published')->where('category', 'ekonomi')->count(),
        'pertanian' => Video::where('status', 'published')->where('category', 'pertanian')->count(),
        'pemerintahan' => Video::where('status', 'published')->where('category', 'pemerintahan')->count(),
        'pembangunan' => Video::where('status', 'published')->where('category', 'pembangunan')->count(),
        // tambahkan jika ada kategori lain
    ];

    return view('detail', compact('highlighted', 'beritas', 'selectedCategory', 'categories'));
}

}
