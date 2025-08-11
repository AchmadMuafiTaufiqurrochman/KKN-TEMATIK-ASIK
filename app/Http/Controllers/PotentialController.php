<?php

namespace App\Http\Controllers;

use App\Models\Potential;

class PotentialController extends Controller
{
    // Halaman utama potensi
    public function index()
    {
        $potentials = Potential::all();
        return view('product', compact('potentials'));
    }

    // Halaman detail potensi
    public function detailPotensi($id)
    {
        $potential = Potential::findOrFail($id);
        return view('detailpotensi', compact('potential'));
    }

    // Halaman semua potensi (kalau berbeda dari index)
    public function allPotensi()
    {
        $potentials = Potential::all();
        return view('allpotensi', compact('potentials'));
    }
}
    