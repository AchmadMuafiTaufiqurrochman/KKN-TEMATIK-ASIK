<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class AdminVideoController extends Controller
{
    public function index(Request $request)
    {
        $query = Video::query();

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        $videos = $query->orderBy('created_at', 'desc')->paginate(12);

        $stats = [
            'total' => Video::count(),
            'published' => Video::where('status', 'published')->count(),
            'draft' => Video::where('status', 'draft')->count(),
            'total_views' => Video::sum('views'),
        ];

        $categories = [
            'all' => Video::count(),
            'profil' => Video::where('category', 'profil')->count(),
            'kesehatan' => Video::where('category', 'kesehatan')->count(),
            'perempuan' => Video::where('category', 'perempuan')->count(),
            'pertanian' => Video::where('category', 'pertanian')->count(),
        ];

        return view('admin.videos', compact('videos', 'stats', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:profil,kesehatan,perempuan,pertanian',
            'video_url' => 'required|url',
            'thumbnail' => 'required|url',
            'description' => 'required|string',
            'duration' => 'required|string|max:10',
            'status' => 'required|in:published,draft',
        ]);

        Video::create($validated);

        return redirect()->route('admin.videos.index')->with('success', 'Video berhasil ditambahkan.');
    }

    public function update(Request $request, Video $video)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:profil,kesehatan,perempuan,pertanian',
            'video_url' => 'required|url',
            'thumbnail' => 'required|url',
            'description' => 'required|string',
            'duration' => 'required|string|max:10',
            'status' => 'required|in:published,draft',
        ]);

        $video->update($validated);

        return redirect()->route('admin.videos.index')->with('success', 'Video berhasil diperbarui.');
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('admin.videos.index')->with('success', 'Video berhasil dihapus.');
    }
}