<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Villager;
use Illuminate\Http\Request;

class VillagerController extends Controller
{
    public function index(Request $request)
    {
        $query = Villager::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        if ($request->filled('rt')) {
            $query->where('rt', $request->rt);
        }

        if ($request->filled('rw')) {
            $query->where('rw', $request->rw);
        }

        $villagers = $query->orderBy('name')->paginate(20);

        $stats = [
            'total' => Villager::count(),
            'male' => Villager::where('gender', 'L')->count(),
            'female' => Villager::where('gender', 'P')->count(),
        ];

        $educationStats = [
            'SD' => Villager::where('education', 'SD')->count(),
            'SMP' => Villager::where('education', 'SMP')->count(),
            'SMA' => Villager::where('education', 'SMA')->count(),
            'D3' => Villager::where('education', 'D3')->count(),
            'S1' => Villager::where('education', 'S1')->count(),
        ];

        return view('admin.citizens', compact('villagers', 'stats', 'educationStats'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:villagers',
            'gender' => 'required|in:L,P',
            'birth_date' => 'required|date',
            'job' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'rt' => 'required|string|max:10',
            'rw' => 'required|string|max:10',
        ]);

        Villager::create($validated);

        return redirect()->route('admin.citizens.index')->with('success', 'Data warga berhasil ditambahkan.');
    }

    public function update(Request $request, Villager $villager)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:villagers,nik,' . $villager->id,
            'gender' => 'required|in:L,P',
            'birth_date' => 'required|date',
            'job' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'rt' => 'required|string|max:10',
            'rw' => 'required|string|max:10',
        ]);

        $villager->update($validated);

        return redirect()->route('admin.citizens.index')->with('success', 'Data warga berhasil diperbarui.');
    }

    public function destroy(Villager $villager)
    {
        $villager->delete();
        return redirect()->route('admin.citizens.index')->with('success', 'Data warga berhasil dihapus.');
    }
}