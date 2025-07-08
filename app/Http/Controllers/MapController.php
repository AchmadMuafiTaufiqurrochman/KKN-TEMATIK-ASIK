<?php

namespace App\Http\Controllers;

use App\Models\MapLocation;

class MapController extends Controller
{
    public function index()
    {
        $locations = MapLocation::where('status', 'active')->get();
        
        $locationTypes = [
            'balai' => $locations->where('type', 'balai')->count(),
            'pertanian' => $locations->where('type', 'pertanian')->count(),
            'bunga' => $locations->where('type', 'bunga')->count(),
            'posyandu' => $locations->where('type', 'posyandu')->count(),
        ];

        return view('map', compact('locations', 'locationTypes'));
    }
}