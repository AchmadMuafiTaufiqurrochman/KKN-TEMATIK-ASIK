<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // ProductController
public function index()
{
    $products = Product::where('status', 'published')->latest()->get();
    $categories = Product::where('status', 'published')
        ->select('category')
        ->distinct()
        ->pluck('category');

    return view('product', compact('products', 'categories'));
}
}
