<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminVideoController extends Controller
{
    protected $allCategories = [
        'profil', 'kesehatan', 'ekonomi', 'pertanian', 'pemerintahan',
        'pembangunan', 'kegiatan', 'pengumuman', 'berita', 'umkm', 'karangtaruna', 'budidayabunga'
    ];

    public function index(Request $request)
    {
        $query = Video::query();

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $stats = [
            'total' => Video::count(),
            'video_count' => Video::where('type', 'video')->count(),
            'image_count' => Video::where('type', 'gambar')->count(),
            'published' => Video::where('status', 'published')->count(),
            'draft' => Video::where('status', 'draft')->count(),
            'total_views' => Video::sum('views'),
        ];

        $categories = ['all' => Video::count()];
        foreach ($this->allCategories as $cat) {
            $categories[$cat] = Video::where('category', $cat)->count();
        }

        // Urutkan berdasarkan started_at dengan prioritas:
        // 1. Yang sudah dimulai (started_at <= now()) diurutkan terbaru dulu
        // 2. Yang belum dimulai (started_at > now()) diurutkan terdekat dulu
        // 3. Yang tidak ada tanggal di paling bawah
        $videos = $query
            ->orderByRaw('
                CASE 
                    WHEN started_at IS NULL THEN 3
                    WHEN started_at <= NOW() THEN 1 
                    ELSE 2 
                END
            ')
            ->orderBy('started_at', 'desc')
            ->paginate(9);

        return view('admin.videos', [
            'videos' => $videos,
            'stats' => $stats,
            'categories' => $categories,
            'allCategories' => $this->allCategories,
        ]);
    }

    public function create()
    {
        $categories = $this->allCategories;
        return view('admin.videos_create', compact('categories'));
    }

    public function store(Request $request)
    {
        $type = $request->input('type', 'video');

        // Validasi conditional berdasarkan tipe
        $rules = [
            'title' => 'required|string|max:255',
            'category' => 'required|in:' . implode(',', $this->allCategories),
            'type' => 'required|in:video,gambar',
            'description' => 'required|string',
            'status' => 'required|in:published,draft',
            'started_at' => 'required|date',
        ];

        if ($type === 'video') {
            $rules['video_url'] = 'required|url';
            $rules['duration'] = 'required|string|max:10';
            $rules['video_thumbnail'] = 'required|image|mimes:jpeg,png,jpg|max:25600';
        } else { // gambar
            $rules['image_thumbnail'] = 'required|image|mimes:jpeg,png,jpg|max:25600';
        }

        $validated = $request->validate($rules);

        // Upload thumbnail
        if ($type === 'video' && $request->hasFile('video_thumbnail')) {
            $path = $request->file('video_thumbnail')->store('berita-gambar', 'public');
            $validated['thumbnail'] = $path;
        } elseif ($type === 'gambar' && $request->hasFile('image_thumbnail')) {
            $path = $request->file('image_thumbnail')->store('berita-gambar', 'public');
            $validated['thumbnail'] = $path;
            $validated['video_url'] = null;
            $validated['duration'] = null;
        }

        $validated['type'] = $type;
        $validated['started_at'] = Carbon::parse($validated['started_at']);
        // Hapus is_finished karena sekarang dihitung secara dinamis

        Video::create($validated);

        // Pesan notifikasi berdasarkan tipe
        $message = $type === 'video' ? 'Berita video berhasil di upload!' : 'Berita gambar berhasil di upload!';
        
        return redirect()->route('admin.videos.index')->with('success', $message);
    }

    public function update(Request $request, Video $video)
    {
        $type = $request->input('type', $video->type);

        // Validasi conditional berdasarkan tipe
        $rules = [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'type' => 'required|in:video,gambar',
            'started_at' => 'required|date',
            'status' => 'required|in:draft,published',
        ];

        if ($type === 'video') {
            $rules['video_url'] = 'required|url';
            $rules['duration'] = 'required|string|max:10';
            $rules['video_thumbnail'] = 'nullable|image|mimes:jpeg,jpg,png|max:25600';
        } else { // gambar
            $rules['image_thumbnail'] = 'nullable|image|mimes:jpeg,jpg,png|max:25600';
        }

        $validated = $request->validate($rules);

        // Upload thumbnail jika ada
        if ($type === 'video' && $request->hasFile('video_thumbnail')) {
            $path = $request->file('video_thumbnail')->store('berita-gambar', 'public');
            $validated['thumbnail'] = $path;
        } elseif ($type === 'gambar' && $request->hasFile('image_thumbnail')) {
            $path = $request->file('image_thumbnail')->store('berita-gambar', 'public');
            $validated['thumbnail'] = $path;
        }

        // Pastikan jika tipe gambar, video_url & duration null
        if ($type === 'gambar') {
            $validated['video_url'] = null;
            $validated['duration'] = null;
        }

        $validated['type'] = $type;
        $validated['started_at'] = Carbon::parse($validated['started_at']);
        // Hapus is_finished karena sekarang dihitung secara dinamis

        $video->update($validated);

        // Pesan notifikasi berdasarkan tipe
        $message = $type === 'video' ? 'Berita video berhasil di upload!' : 'Berita gambar berhasil di upload!';

        return redirect()->route('admin.videos.index')->with('success', $message);
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('admin.videos.index')->with('success', 'Video berhasil dihapus.');
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);
        $categories = $this->allCategories;
        return view('admin.videos_edit', compact('video', 'categories'));
    }
}
