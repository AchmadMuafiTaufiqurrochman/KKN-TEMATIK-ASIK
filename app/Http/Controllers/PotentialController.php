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
        // Data statis untuk potensi (sama dengan yang di blade)
        $potentials = [
            'pertanian' => [
                'title' => 'Pertanian Unggulan',
                'category' => 'pertanian',
                'image' => 'https://images.pexels.com/photos/1595108/pexels-photo-1595108.jpeg?auto=compress&cs=tinysrgb&w=1600',
            ],
            'budidaya-bunga' => [
                'title' => 'Budidaya Bunga',
                'category' => 'budidaya',
                'image' => 'https://images.pexels.com/photos/1486974/pexels-photo-1486974.jpeg?auto=compress&cs=tinysrgb&w=1600',
            ]
        ];
        
        // Jika ID tidak valid, redirect ke halaman pertanian sebagai default
        if (!array_key_exists($id, $potentials)) {
            return redirect()->route('detailpotensi', 'pertanian');
        }
        
        return view('detailpotensi');
    }

    // Halaman semua potensi (kalau berbeda dari index)
    public function allPotensi()
    {
        $potentials = Potential::all();
        return view('allpotensi', compact('potentials'));
    }
}
    