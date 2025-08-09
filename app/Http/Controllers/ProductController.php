<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // Ambil semua produk yang sudah publish
        $products = Product::where('status', 'published')->latest()->get();

        return view('product', compact('products'));
    }
}
