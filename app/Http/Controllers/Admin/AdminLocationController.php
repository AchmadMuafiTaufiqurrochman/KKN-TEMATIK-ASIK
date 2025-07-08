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
        ];

        $locationTypes = [
            'balai' => MapLocation::where('type', 'balai')->count(),
            'pertanian' => MapLocation::where('type', 'pertanian')->count(),
            'bunga' => MapLocation::where('type', 'bunga')->count(),
            'posyandu' => MapLocation::where('type', 'posyandu')->count(),
        ];

        return view('admin.locations', compact('locations', 'stats', 'locationTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'type' => 'required|in:balai,pertanian,bunga,posyandu',
            'description' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        MapLocation::create($validated);

        return redirect()->route('admin.locations.index')->with('success', 'Lokasi berhasil ditambahkan.');
    }

    public function update(Request $request, MapLocation $mapLocation)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'type' => 'required|in:balai,pertanian,bunga,posyandu',
            'description' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $mapLocation->update($validated);

        return redirect()->route('admin.locations.index')->with('success', 'Lokasi berhasil diperbarui.');
    }

    public function destroy(MapLocation $mapLocation)
    {
        $mapLocation->delete();
        return redirect()->route('admin.locations.index')->with('success', 'Lokasi berhasil dihapus.');
    }
}