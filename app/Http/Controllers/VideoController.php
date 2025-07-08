<?php

namespace App\Http\Controllers;

use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $video = Video::where('category', 'profil')->where('status', 'published')->first();
        
        if ($video) {
            $video->incrementViews();
        }

        return view('video-profile', compact('video'));
    }
}