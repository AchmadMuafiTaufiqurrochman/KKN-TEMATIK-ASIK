<?php

namespace App\Http\Controllers;

use App\Models\Video;

class AboutController extends Controller
{
    public function index()
    {
        $video = Video::latest()->first(); // Ambil video terbaru dari DB
        return view('about', compact('video'));
    }
}
