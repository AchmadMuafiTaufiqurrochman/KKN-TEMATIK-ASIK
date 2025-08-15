<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    public function index(Request $request)
    {
        // Ambil kategori dan pencarian dari query string
        $selectedCategory = $request->query('category', 'all');
        $search = $request->query('search');

        // Query dasar: status published dan bukan kategori 'profil'
        $query = Video::where('status', 'published')
                      ->where('category', '!=', 'profil');

        // Filter berdasarkan kategori jika bukan 'all'
        if ($selectedCategory !== 'all') {
            $query->where('category', $selectedCategory);
        }

        // Filter berdasarkan pencarian
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
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
            ->paginate(16)
            ->appends($request->query());

        // Daftar kategori tetap
        $allCategoryList = [
            'profil', 'kesehatan', 'ekonomi', 'pertanian', 'pemerintahan',
            'kegiatan', 'pembangunan', 'pengumuman', 'berita',
            'umkm', 'karangtaruna', 'budidayabunga',
        ];

        // Hitung jumlah total dan per kategori
        $categoriesCount = [
            'all' => Video::where('status', 'published')
                          ->where('category', '!=', 'profil')
                          ->count()
        ];

        foreach ($allCategoryList as $cat) {
            $categoriesCount[$cat] = Video::where('status', 'published')
                                          ->where('category', '!=', 'profil')
                                          ->where('category', $cat)
                                          ->count();
        }

        return view('documentation', [
            'videos' => $videos,
            'categories' => $categoriesCount,
            'selectedCategory' => $selectedCategory,
            'search' => $search,
        ]);
    }
}
