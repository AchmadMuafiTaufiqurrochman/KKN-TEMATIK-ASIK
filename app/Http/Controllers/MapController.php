<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Product;

class MapController extends Controller
{
    public function index()
    {
        $locations = Fasilitas::where('status', 'active')->get();
        
        // Ambil produk yang aktif dan punya koordinat untuk ditampilkan sebagai marker ekonomi
        $products = Product::where('status', 'active')
                          ->whereNotNull('latitude')
                          ->whereNotNull('longitude')
                          ->get();
        
        $locationTypes = Fasilitas::where('status', 'active')->get()->groupBy('type')->map(function($group) {
            return $group->count();
        })->toArray();

        // Tambahkan hitungan produk ke kategori ekonomi
        $productCount = $products->count();
        $locationTypes['ekonomi'] = ($locationTypes['ekonomi'] ?? 0) + $productCount;

        return view('map', compact('locations', 'locationTypes', 'products'));
    }
}