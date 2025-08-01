<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class AdminVideoController extends Controller
{
    protected $allCategories = [
        'profil',
        'kesehatan',
        'perempuan',
        'pertanian',
        'pemerintahan',
        'pembangunan',
        'kegiatan',
        'pengumuman',
        'berita',
        'umkm',
        'karangtaruna',
    ];

    public function index(Request $request)
    {
        $query = Video::query();

        // Filter berdasarkan kategori jika dipilih
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // Pencarian berdasarkan judul atau deskripsi
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Ambil video dengan pagination dan tetap bawa parameter pencarian
        $videos = $query->orderBy('created_at', 'desc')->paginate(12)->appends($request->all());

        // Statistik
        $stats = [
            'total' => Video::count(),
            'published' => Video::where('status', 'published')->count(),
            'draft' => Video::where('status', 'draft')->count(),
            'total_views' => Video::sum('views'),
        ];

        // Kategori dengan jumlah video
        $categories = ['all' => $stats['total']];
        foreach ($this->allCategories as $cat) {
            $categories[$cat] = Video::where('category', $cat)->count();
        }

        return view('admin.videos', compact('videos', 'stats', 'categories'));
    }

    public function store(Request $request)
{
    $type = $request->input('type', 'video'); // default video

    if ($type === 'video') {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:' . implode(',', $this->allCategories),
            'video_url' => 'required|url',
            'thumbnail' => 'required|url',
            'description' => 'required|string',
            'duration' => 'required|string|max:10',
            'status' => 'required|in:published,draft',
        ]);
    } else {
        // Tipe gambar
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:' . implode(',', $this->allCategories),
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required|string',
            'status' => 'required|in:published,draft',
        ]);

        // Simpan file gambar ke storage
        $thumbnailPath = $request->file('thumbnail')->store('berita-gambar', 'public');
        $validated['thumbnail'] = $thumbnailPath;
        $validated['video_url'] = '?';
        $validated['duration'] = '?';
    }

    $validated['type'] = $type;

    Video::create($validated);

    return redirect()->route('admin.videos.index')->with('success', 'Berita berhasil ditambahkan.');
}

public function update(Request $request, Video $video)
{
    $type = $request->input('type', 'video');

    $rules = [
        'title' => 'required|string|max:255',
        'category' => 'required|in:' . implode(',', $this->allCategories),
        'description' => 'required|string',
        'status' => 'required|in:published,draft',
        'type' => 'required|in:video,gambar',
    ];

    if ($type === 'video') {
        $rules['video_url'] = 'required|url';
        $rules['thumbnail'] = 'required|url';
        $rules['duration'] = 'required|string|max:10';
    } else if ($type === 'gambar') {
        $rules['thumbnail'] = 'required|string';
    }

    $validated = $request->validate($rules);

    $video->update($validated);

    return redirect()->route('admin.videos.index')->with('success', 'Berita berhasil diperbarui.');
}

    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('admin.videos.index')->with('success', 'Video berhasil dihapus.');
    }
}
