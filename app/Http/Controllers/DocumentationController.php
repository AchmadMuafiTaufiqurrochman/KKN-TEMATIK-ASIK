<?php

namespace App\Http\Controllers;

use App\Models\Video;

class DocumentationController extends Controller
{
    public function index()
    {
        $videos = Video::where('status', 'published')
                      ->where('category', '!=', 'profil')
                      ->orderBy('created_at', 'desc')
                      ->get();

        $categories = [
            'all' => $videos->count(),
            'kesehatan' => $videos->where('category', 'kesehatan')->count(),
            'ekonomi' => $videos->where('category', 'ekonomi')->count(),
            'pertanian' => $videos->where('category', 'pertanian')->count(),
        ];

        return view('documentation', compact('videos', 'categories'));
    }

   

}