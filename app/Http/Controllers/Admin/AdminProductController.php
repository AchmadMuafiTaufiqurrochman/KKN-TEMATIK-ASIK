<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    protected $allCategories = [
        'makanan', 'kerajinan', 'pakaian', 'elektronik', 'pertanian', 'lainnya'
    ];

    public function index(Request $request)
    {
        $query = Product::query();

        // Filter berdasarkan kategori
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // Filter pencarian
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Statistik sederhana
        $stats = [
            'total' => Product::count(),
            'published' => Product::where('status', 'published')->count(),
            'draft' => Product::where('status', 'draft')->count(),
        ];

        // Hitung kategori
        $categories = ['all' => Product::count()];
        foreach ($this->allCategories as $cat) {
            $categories[$cat] = Product::where('category', $cat)->count();
        }

        $products = $query->latest()->paginate(10);

        return view('admin.products.index', compact('products', 'stats', 'categories'))
            ->with('allCategories', $this->allCategories);
    }

    public function create()
    {
        return view('admin.product.create')->with('categories', $this->allCategories);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:' . implode(',', $this->allCategories),
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'contact' => 'nullable|string|max:255',
            'status' => 'required|in:published,draft',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('produk-gambar', 'public');
            $data['image'] = 'storage/' . $path;
        }

        Product::create($data);

        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.edit', compact('product'))->with('categories', $this->allCategories);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:' . implode(',', $this->allCategories),
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'contact' => 'nullable|string|max:255',
            'status' => 'required|in:published,draft',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('produk-gambar', 'public');
            $data['image'] = 'storage/' . $path;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
