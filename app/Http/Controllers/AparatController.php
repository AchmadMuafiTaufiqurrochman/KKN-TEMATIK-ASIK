<?php

namespace App\Http\Controllers;

use App\Models\Aparat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AparatController extends Controller
{
    // TAMPILKAN UNTUK PUBLIK
    public function public()
    {
        $aparat = Aparat::all();
        return view('Aparatur-Desa', compact('aparat'));
    }

    // TAMPILKAN UNTUK ADMIN (plus statistik)
    public function index()
    {
        $aparat = Aparat::latest()->get();

        $stats = [
            'total' => $aparat->count(),
            'male' => $aparat->where('gender', 'L')->count(),
            'female' => $aparat->where('gender', 'P')->count(),
        ];

        return view('admin.aparat', compact('aparat', 'stats'));
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required',
        'nip' => 'required',
        'position' => 'required',
        'motto' => 'nullable|string',
        'visi' => 'nullable|string',
        'misi' => 'nullable|string',
        'prestasi' => 'nullable|string',
        'gender' => 'required|in:L,P',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('photo')) {
        $data['photo'] = $request->file('photo')->store('aparat', 'public');
    }

    Aparat::create($data);
    return back()->with('success', 'Data berhasil ditambahkan');
}


    // UPDATE DATA
    public function update(Request $request, $id)
    {
        $aparat = Aparat::findOrFail($id);

        $data = $request->validate([
    'name' => 'required',
    'nip' => 'required',
    'position' => 'required',
    'motto' => 'nullable|string',
    'visi' => 'nullable|string',
    'misi' => 'nullable|string',
    'prestasi' => 'nullable|string',
    'gender' => 'required|in:L,P',
    'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
]);


        if ($request->hasFile('photo')) {
            if ($aparat->photo) {
                Storage::disk('public')->delete($aparat->photo);
            }
            $data['photo'] = $request->file('photo')->store('aparat', 'public');
        }

        $aparat->update($data);
        return back()->with('success', 'Data berhasil diupdate');
        
    }

    // HAPUS DATA
    public function destroy($id)
    {
        $aparat = Aparat::findOrFail($id);
        if ($aparat->photo) {
            Storage::disk('public')->delete($aparat->photo);
        }
        $aparat->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }

    
}
