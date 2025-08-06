<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $video = Video::where('category', 'profil')
                      ->where('status', 'published')
                      ->orderByDesc('created_at')
                      ->first();

        if ($video) {
            $video->incrementViews();
        }

        return view('about', compact('video'));
    }

    public function detail($id, Request $request)
{
    $highlighted = Video::findOrFail($id);
    $selectedCategory = $request->query('category');

    // Ambil semua video dalam kategori (termasuk current)
    $relatedQuery = Video::where('status', 'published')
        ->when($selectedCategory && $selectedCategory !== 'semua', function ($query) use ($selectedCategory) {
            $query->where('category', $selectedCategory);
        })
        ->orderBy('created_at', 'desc');

    $relatedIds = $relatedQuery->pluck('id')->toArray();

    // Temukan index dari video saat ini
    $currentIndex = array_search($highlighted->id, $relatedIds);

    // Dapatkan previous dan next ID
    $previousId = $relatedIds[$currentIndex + 1] ?? null; // video yang lebih lama
    $nextId = $relatedIds[$currentIndex - 1] ?? null;     // video yang lebih baru

    // Ambil objek Video untuk prev dan next jika ada
    $previousVideo = $previousId ? Video::find($previousId) : null;
    $nextVideo = $nextId ? Video::find($nextId) : null;

    // Ambil video lainnya (selain current), untuk ditampilkan di bawah
    $beritas = Video::where('status', 'published')
        ->where('id', '!=', $id)
        ->when($selectedCategory && $selectedCategory !== 'semua', function ($query) use ($selectedCategory) {
            $query->where('category', $selectedCategory);
        })
        ->latest()
        ->paginate(12);

    // Hitung total per kategori
    $categories = [
        'semua' => Video::where('status', 'published')->count(),
        'kesehatan' => Video::where('status', 'published')->where('category', 'kesehatan')->count(),
        'ekonomi' => Video::where('status', 'published')->where('category', 'ekonomi')->count(),
        'pertanian' => Video::where('status', 'published')->where('category', 'pertanian')->count(),
        'pemerintahan' => Video::where('status', 'published')->where('category', 'pemerintahan')->count(),
        'pembangunan' => Video::where('status', 'published')->where('category', 'pembangunan')->count(),
        'kegiatan' => Video::where('status', 'published')->where('category', 'kegiatan')->count(),
        'pengumuman' => Video::where('status', 'published')->where('category', 'pengumuman')->count(),
        'berita' => Video::where('status', 'published')->where('category', 'berita')->count(),
        'umkm' => Video::where('status', 'published')->where('category', 'umkm')->count(),
        'karangtaruna' => Video::where('status', 'published')->where('category', 'karangtaruna')->count(),
    ];

    return view('detail', compact(
        'highlighted',
        'beritas',
        'selectedCategory',
        'categories',
        'previousVideo',
        'nextVideo'
    ));
}

}
