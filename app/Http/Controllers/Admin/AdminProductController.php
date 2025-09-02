<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    /**
     * Tampilkan daftar produk + statistik
     */
    public function index()
    {
        $products = Product::latest()->get();

        // Statistik global
        $stats = [
            'total'    => Product::count(),
            'active'   => Product::where('status', 'active')->count(),
            'inactive' => Product::where('status', 'inactive')->count(),
        ];

        // Statistik per kategori (otomatis, nggak hardcode)
        $categories = Product::select('category')
            ->distinct()
            ->pluck('category');

        $categoryStats = [];
        foreach ($categories as $category) {
            $categoryStats[$category] = Product::where('category', $category)->count();
        }

        return view('admin.product.index', compact('products', 'stats', 'categoryStats'));
    }

    /**
     * Simpan produk baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_product' => 'required|string|max:255',
            'description'  => 'required|string',
            'category'     => 'required|string',
            'contact'      => 'required|string|max:50',
            'status'       => 'required|in:active,inactive',
            'owner'        => 'required|string|max:255',
            'latitude'     => 'nullable|numeric',
            'longitude'    => 'nullable|numeric',
            'image'        => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Update produk
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name_product' => 'required|string|max:255',
            'description'  => 'required|string',
            'category'     => 'required|string',
            'contact'      => 'required|string|max:50',
            'status'       => 'required|in:active,inactive',
            'owner'        => 'required|string|max:255',
            'latitude'     => 'nullable|numeric',
            'longitude'    => 'nullable|numeric',
            'image'        => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Hapus produk
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
