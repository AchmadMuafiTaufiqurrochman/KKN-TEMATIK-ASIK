<?php

namespace App\Http\Controllers;

use App\Models\Berita;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::latest()->get();

        $categories = [
            'all' => $berita->count(),
            'kesehatan' => $berita->where('category', 'kesehatan')->count(),
            'pembangunan' => $berita->where('category', 'pembangunan')->count(),
            'pendidikan' => $berita->where('category', 'pendidikan')->count(),
        ];

        return view('berita', compact('berita', 'categories'));
    }
}

