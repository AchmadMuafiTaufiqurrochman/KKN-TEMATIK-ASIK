<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;

class MapController extends Controller
{
    public function index()
    {
        $locations = Fasilitas::where('status', 'active')->get();
        
        $locationTypes = Fasilitas::where('status', 'active')->get()->groupBy('type')->map(function($group) {
            return $group->count();
        })->toArray();

        return view('map', compact('locations', 'locationTypes'));
    }
}