<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    public function index(Request $request)
    {
        // Ambil kategori dari query string (?category=xxx)
        $selectedCategory = $request->query('category', 'all');

        // Query dasar: status published dan bukan kategori 'profil'
        $query = Video::where('status', 'published')
                      ->where('category', '!=', 'profil');

        // Filter berdasarkan kategori jika bukan 'all'
        if ($selectedCategory !== 'all') {
            $query->where('category', $selectedCategory);
        }

        // Paginate 12 data per halaman
        $videos = $query->orderBy('created_at', 'desc')->paginate(12);

        // Daftar kategori tetap
        $allCategoryList = [
            'kesehatan', 'ekonomi', 'pertanian', 'pemerintahan',
            'kegiatan', 'pembangunan', 'pengumuman', 'berita',
            'umkm', 'karangtaruna'
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
        ]);
    }
}
