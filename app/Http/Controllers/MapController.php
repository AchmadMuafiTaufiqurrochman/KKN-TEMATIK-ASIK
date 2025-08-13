<?php

namespace App\Http\Controllers;

use App\Models\MapLocation;

class MapController extends Controller
{
    public function index()
    {
        $locations = MapLocation::where('status', 'active')->get();
        
        // Gunakan method dari model untuk mendapatkan statistik per type
        $locationTypes = MapLocation::where('status', 'active')->get()->groupBy('type')->map(function($group) {
            return $group->count();
        })->toArray();

        return view('map', compact('locations', 'locationTypes'));
    }
}