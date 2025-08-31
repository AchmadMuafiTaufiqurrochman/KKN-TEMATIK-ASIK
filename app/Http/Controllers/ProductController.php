<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Menampilkan produk unggulan untuk publik
     */
    public function index()
    {
        // Ambil hanya produk dengan status aktif
        $products = Product::where('status', 'active')
            ->latest()
            ->get();

        return view('product', compact('products'));
    }

    /**
     * Menampilkan detail satu produk (opsional, kalau mau ada detail)
     */
    // public function show($id)
    // {
    //     $product = Product::where('status', 'active')->findOrFail($id);
    //     return view('produk-unggulan.show', compact('product'));
    // }
}
