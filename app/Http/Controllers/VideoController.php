<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VideoController extends Controller
{
    public function index()
    {
        $video = Video::where('category', 'profil')
                      ->where('status', 'published')
                      ->orderByDesc('created_at')
                      ->first();

        if ($video) {
            $sessionKey = 'viewed_video_' . $video->id;
            $now = now();

            // Ambil waktu terakhir dari session
            $lastViewed = session($sessionKey);

            if (!$lastViewed || $now->diffInMinutes(Carbon::parse($lastViewed)) >= 1) {
                $video->increment('views');
                session()->put($sessionKey, $now->toDateTimeString());
            }
        }

        return view('about', compact('video'));
    }

    public function detail($id, Request $request)
{
    $highlighted = Video::findOrFail($id);

    // Setiap klik langsung tambah views (hapus logika session dan Carbon)
    $highlighted->increment('views');

    $selectedCategory = $request->query('category');

    $relatedQuery = Video::where('status', 'published')
        ->when($selectedCategory && $selectedCategory !== 'semua', function ($query) use ($selectedCategory) {
            $query->where('category', $selectedCategory);
        })
        ->orderByRaw('
            CASE 
                WHEN started_at IS NULL THEN 3
                WHEN started_at <= NOW() THEN 1 
                ELSE 2 
            END
        ')
        ->orderBy('started_at', 'desc');

    $relatedIds = $relatedQuery->pluck('id')->toArray();
    $currentIndex = array_search($highlighted->id, $relatedIds);

    $previousId = $relatedIds[$currentIndex + 1] ?? null;
    $nextId = $relatedIds[$currentIndex - 1] ?? null;

    $previousVideo = $previousId ? Video::find($previousId) : null;
    $nextVideo = $nextId ? Video::find($nextId) : null;

    $beritas = Video::where('status', 'published')
        ->where('id', '!=', $id)
        ->when($selectedCategory && $selectedCategory !== 'semua', function ($query) use ($selectedCategory) {
            $query->where('category', $selectedCategory);
        })
        ->orderByRaw('
            CASE 
                WHEN started_at IS NULL THEN 3
                WHEN started_at <= NOW() THEN 1 
                ELSE 2 
            END
        ')
        ->orderBy('started_at', 'desc')
        ->paginate(16);

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
        'budidayabunga' => Video::where('status', 'published')->where('category', 'budidayabunga')->count(),
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


    public function show($id)
{
    $video = Video::findOrFail($id);

    // Setiap klik langsung tambah views
    $video->increment('views');

    return view('videos.show', compact('video'));
}

}
