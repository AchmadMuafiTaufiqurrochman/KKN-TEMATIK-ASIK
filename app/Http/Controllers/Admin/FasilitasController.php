<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::orderBy('name')->get();

        $stats = [
            'total' => Fasilitas::count(),
            'active' => Fasilitas::where('status', 'active')->count(),
            'inactive' => Fasilitas::where('status', 'inactive')->count(),
            'open_today' => Fasilitas::where('status', 'active')->get()->filter(function($fasilitas) {
                return $fasilitas->isOpenToday();
            })->count(),
        ];

        $fasilitasTypes = Fasilitas::getTypesWithCounts();

        return view('admin.locations', compact('fasilitas', 'stats', 'fasilitasTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'type' => 'required|in:pelayanan_publik,pendidikan,kesehatan,ekonomi',
            'description' => 'required|string',
            'opening_hours' => 'nullable|string|max:255',
            'pic_name' => 'nullable|string|max:255',
            'contact' => 'nullable|string|max:255',
            'gmaps_link' => 'nullable|url|max:500',
            'status' => 'required|in:active,inactive',
        ]);

        Fasilitas::create($validated);

        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function update(Request $request, Fasilitas $fasilitas)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'type' => 'required|in:pelayanan_publik,pendidikan,kesehatan,ekonomi',
            'description' => 'required|string',
            'opening_hours' => 'nullable|string|max:255',
            'pic_name' => 'nullable|string|max:255',
            'contact' => 'nullable|string|max:255',
            'gmaps_link' => 'nullable|url|max:500',
            'status' => 'required|in:active,inactive',
        ]);

        $fasilitas->update($validated);

        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(Fasilitas $fasilitas)
    {
        $fasilitas->delete();
        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil dihapus.');
    }

    public function edit(Fasilitas $fasilitas)
    {
        return response()->json($fasilitas);
    }

    public function show(Fasilitas $fasilitas)
    {
        return response()->json([
            'id' => $fasilitas->id,
            'name' => $fasilitas->name,
            'latitude' => $fasilitas->latitude,
            'longitude' => $fasilitas->longitude,
            'type' => $fasilitas->type,
            'type_text' => $fasilitas->getTypeTextAttribute(),
            'type_color' => $fasilitas->getTypeColorAttribute(),
            'description' => $fasilitas->description,
            'opening_hours' => $fasilitas->opening_hours,
            'pic_name' => $fasilitas->pic_name,
            'contact' => $fasilitas->contact,
            'gmaps_link' => $fasilitas->gmaps_link,
            'status' => $fasilitas->status,
            'is_open_today' => $fasilitas->isOpenToday(),
            'created_at' => $fasilitas->created_at->format('d M Y H:i'),
            'updated_at' => $fasilitas->updated_at->format('d M Y H:i'),
        ]);
    }
}
