<?php

namespace App\Http\Controllers;

use App\Models\Video;

class DocumentationController extends Controller
{
    public function index()
    {
        // Ambil semua video (kecuali kategori 'profil')
        $videos = Video::where('status', 'published')
                      ->where('category', '!=', 'profil')
                      ->orderBy('created_at', 'desc')
                      ->get();

        // Daftar semua kategori yang ditampilkan (termasuk dropdown lainnya)
        $allCategoryList = [
            'kesehatan', 'ekonomi', 'pertanian', 'pemerintahan',
            'kegiatan', 'pembangunan', 'pengumuman', 'berita',
            'umkm', 'karangtaruna'
        ];

        // Hitung jumlah per kategori
        $categoriesCount = ['all' => $videos->count()];
        foreach ($allCategoryList as $cat) {
            $categoriesCount[$cat] = $videos->where('category', $cat)->count();
        }

        return view('documentation', [
            'videos' => $videos,
            'categories' => $categoriesCount
        ]);
    }
}
