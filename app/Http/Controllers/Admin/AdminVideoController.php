<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class AdminVideoController extends Controller
{
    protected $allCategories = [
        'profil', 'kesehatan', 'perempuan', 'pertanian', 'pemerintahan',
        'pembangunan', 'kegiatan', 'pengumuman', 'berita', 'umkm', 'karangtaruna',
    ];

    public function index(Request $request)
    {
        $query = Video::query();

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $videos = $query->orderBy('created_at', 'desc')->paginate(12)->appends($request->all());

        $stats = [
            'total' => Video::count(),
            'published' => Video::where('status', 'published')->count(),
            'draft' => Video::where('status', 'draft')->count(),
            'total_views' => Video::sum('views'),
        ];

        $categories = ['all' => $stats['total']];
        foreach ($this->allCategories as $cat) {
            $categories[$cat] = Video::where('category', $cat)->count();
        }

        return view('admin.videos', compact('videos', 'stats', 'categories'));
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
            ]);
        } else {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'category' => 'required|in:' . implode(',', $this->allCategories),
                'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'description' => 'required|string',
                'status' => 'required|in:published,draft',
            ]);

            // ✅ Simpan file gambar ke public storage
            $path = $request->file('thumbnail')->store('berita-gambar', 'public');

            // ✅ Simpan path yang bisa diakses publik
            $validated['thumbnail'] = 'storage/' . $path;
            $validated['video_url'] = null;
            $validated['duration'] = null;
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
            $rules['thumbnail'] = 'nullable|image|mimes:jpeg,png,jpg|max:2048';
        }

        $validated = $request->validate($rules);

        if ($type === 'gambar' && $request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('berita-gambar', 'public');
            $validated['thumbnail'] = 'storage/' . $path;
            $validated['video_url'] = null;
            $validated['duration'] = null;
        }

        $video->update($validated);

        return redirect()->route('admin.videos.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('admin.videos.index')->with('success', 'Video berhasil dihapus.');
    }
}
