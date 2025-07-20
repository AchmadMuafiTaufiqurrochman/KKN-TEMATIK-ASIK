<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::latest()->paginate(9);
        $categories = Berita::selectRaw('kategori, COUNT(*) as total')
                            ->groupBy('kategori')
                            ->pluck('total', 'kategori');

        return view('admin.berita.index', compact('berita', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'konten' => 'required',
            'kategori' => 'required',
            'thumbnail' => 'nullable|url',
            'status' => 'required|in:draft,published',
        ]);

        Berita::create($request->all());

        return redirect()->back()->with('success', 'Berita berhasil ditambahkan');
    }

    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul' => 'required|string',
            'konten' => 'required',
            'kategori' => 'required',
            'thumbnail' => 'nullable|url',
            'status' => 'required|in:draft,published',
        ]);

        $berita->update($request->all());

        return redirect()->back()->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy(Berita $berita)
    {
        $berita->delete();

        return redirect()->back()->with('success', 'Berita berhasil dihapus');
    }
}
