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
        'pembangunan', 'kegiatan', 'pengumuman', 'berita', 'umkm', 'karangtaruna',
    ];

    public function index(Request $request)
    {
        $query = Video::query();

        // Filter berdasarkan kategori jika ada
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // Filter pencarian
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Hitung statistik
        $stats = [
            'total' => Video::count(),
            'video_count' => Video::where('type', 'video')->count(),
            'image_count' => Video::where('type', 'gambar')->count(),
            'published' => Video::where('status', 'published')->count(),
            'draft' => Video::where('status', 'draft')->count(),
            'total_views' => Video::sum('views'),
        ];

        // Bangun data kategori dengan count, termasuk 'all'
        $categories = ['all' => Video::count()];
        foreach ($this->allCategories as $cat) {
            $categories[$cat] = Video::where('category', $cat)->count();
        }

        // Ambil data berita
        $videos = $query->latest()->paginate(9);

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

        if ($type === 'video') {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'category' => 'required|in:' . implode(',', $this->allCategories),
                'video_url' => 'required|url',
                'thumbnail' => 'required|url',
                'description' => 'required|string',
                'duration' => 'required|string|max:10',
                'status' => 'required|in:published,draft',
                'started_at' => 'required|date',
            ]);
        } else {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'category' => 'required|in:' . implode(',', $this->allCategories),
                'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'description' => 'required|string',
                'status' => 'required|in:published,draft',
                'started_at' => 'required|date',
            ]);

            $path = $request->file('thumbnail')->store('berita-gambar', 'public');
            $validated['thumbnail'] = 'storage/' . $path;
            $validated['video_url'] = null;
            $validated['duration'] = null;
        }

        $validated['type'] = $type;

        $startedAt = $validated['started_at']
            ? Carbon::parse($validated['started_at'])
            : now();

        $validated['started_at'] = $startedAt;
        $validated['is_finished'] = now()->greaterThan($startedAt);

        Video::create($validated);

        return redirect()->route('admin.videos.index')->with('success', 'Berita berhasil ditambahkan.');
    }

   public function update(Request $request, Video $video)
{
    // Validasi dinamis berdasarkan tipe
    $data = $request->validate([
        'title' => 'required|string',
        'description' => 'nullable|string',
        'category' => 'required|string',
        'type' => 'required|in:video,gambar',
        'started_at' => 'required|date',
        'status' => 'required|in:draft,published',
        'video_url' => 'nullable|string',
        'duration' => 'nullable|string',
        'thumbnail' => $request->type === 'gambar'
            ? 'nullable|image|mimes:jpg,jpeg,png|max:2048'
            : 'nullable|string',
    ]);

    // Jika tipe gambar, proses upload thumbnail
    if ($request->type === 'gambar' && $request->hasFile('thumbnail')) {
        $path = $request->file('thumbnail')->store('berita-gambar', 'public');
        $data['thumbnail'] = 'storage/' . $path;
        $data['video_url'] = null;
        $data['duration'] = null;
    }

    // Jika tipe video, pastikan thumbnail string (URL)
    if ($request->type === 'video') {
        $data['video_url'] = $request->video_url;
        $data['duration'] = $request->duration;
        $data['thumbnail'] = $request->thumbnail; // URL dari input
    }

    $video->update($data);

    return redirect()->route('admin.videos.index')->with('success', 'Berita berhasil diperbarui.');
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
