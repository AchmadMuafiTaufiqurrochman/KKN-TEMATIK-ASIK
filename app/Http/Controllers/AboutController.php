<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
{
    $video = Video::where('category', 'profil')
                  ->where('status', 'published')
                  ->orderByDesc('created_at')
                  ->first();

    if ($video) {
        $video->incrementViews();
    }

    return view('about', compact('video'));
}

}
