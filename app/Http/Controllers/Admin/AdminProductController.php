<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\MapLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with('mapLocation')->get();
        $locations = MapLocation::all();
        return view('admin.product.index', compact('products', 'locations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_product' => 'required|string|max:255',
            'owner' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'contact' => 'required|string',
            'status' => 'required|in:active,inactive',
            'map_location_id' => 'required|exists:maps_locations,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name_product' => 'required|string|max:255',
            'owner' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'contact' => 'required|string',
            'status' => 'required|in:active,inactive',
            'map_location_id' => 'required|exists:maps_locations,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
