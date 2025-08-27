<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MapLocation;
use Illuminate\Http\Request;

class AdminLocationController extends Controller
{
    public function index()
    {
        $locations = MapLocation::orderBy('name')->get();

        $stats = [
            'total' => MapLocation::count(),
            'active' => MapLocation::where('status', 'active')->count(),
            'inactive' => MapLocation::where('status', 'inactive')->count(),
            'open_today' => MapLocation::where('status', 'active')->get()->filter(function($location) {
                return $location->isOpenToday();
            })->count(),
        ];

        // Gunakan method dari model untuk mendapatkan statistik per type
        $locationTypes = MapLocation::getTypesWithCounts();

        return view('admin.locations', compact('locations', 'stats', 'locationTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'type' => 'required|in:pelayanan_publik,pendidikan,kesehatan,ekonomi,sosial_budaya',
            'description' => 'required|string',
            'opening_hours' => 'nullable|string|max:255',
            'pic_name' => 'nullable|string|max:255',
            'contact' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        MapLocation::create($validated);

        return redirect()->route('admin.locations.index')->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function update(Request $request, MapLocation $mapLocation)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'type' => 'required|in:pelayanan_publik,pendidikan,kesehatan,ekonomi,sosial_budaya',
            'description' => 'required|string',
            'opening_hours' => 'nullable|string|max:255',
            'pic_name' => 'nullable|string|max:255',
            'contact' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $mapLocation->update($validated);

        return redirect()->route('admin.locations.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(MapLocation $mapLocation)
    {
        $mapLocation->delete();
        return redirect()->route('admin.locations.index')->with('success', 'Fasilitas berhasil dihapus.');
    }

    public function edit(MapLocation $mapLocation)
    {
        return response()->json($mapLocation);
    }
}