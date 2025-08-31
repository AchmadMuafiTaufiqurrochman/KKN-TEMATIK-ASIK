<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Menampilkan produk unggulan untuk publik
     */
   public function index(Request $request)
{
    $query = Product::query()->where('status', 'active');

    if ($request->search) {
        $query->where('name_product', 'like', '%' . $request->search . '%');
    }

    if ($request->category) {
        $query->where('category', $request->category);
    }

    $products = $query->paginate(8);

    $categories = Product::select('category')->distinct()->pluck('category');

    if ($request->ajax()) {
        return response()->json($products);
    }

    return view('product', compact('products', 'categories'));
}
    /**
     * Menampilkan detail produk berdasarkan ID
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('product-detail', compact('product'));
    }
}
