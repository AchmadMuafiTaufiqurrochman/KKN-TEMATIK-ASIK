@extends('layouts.admin')

@section('title', 'Manajemen Produk Desa - Admin Desa Wonokarang')

@section('content')
<div class="min-h-screen bg-gray-50 pt-0">
    <div class="bg-white shadow-sm border-b">
        <div class="container mx-auto px-4 py-4">
            <h1 class="text-2xl font-bold text-primary">Manajemen Produk Desa</h1>
            <p class="text-gray-600">Kelola data produk unggulan dari Desa Wonokarang</p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center gap-3">
                <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
                <span class="text-green-700">{{ session('success') }}</span>
            </div>
        @endif

        <button onclick="openAddModal()" class="bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800 transition-colors flex items-center gap-2 mb-6">
            <i data-lucide="plus" class="w-5 h-5"></i>
            Tambah Produk
        </button>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <table class="w-full">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="px-6 py-4 text-left">Gambar</th>
                        <th class="px-6 py-4 text-left">Nama Produk</th>
                        <th class="px-6 py-4 text-left">Owner</th>
                        <th class="px-6 py-4 text-left">Deskripsi</th>
                        <th class="px-6 py-4 text-left">Kategori</th>
                        <th class="px-6 py-4 text-left">Kontak</th>
                        <th class="px-6 py-4 text-left">Status</th>
                        <th class="px-6 py-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td class="px-6 py-4">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name_product }}" class="h-16 w-16 object-cover rounded">
                            @else
                                <span class="text-gray-400 italic">Tidak ada gambar</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $product->name_product }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $product->owner }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $product->description }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ ucfirst(str_replace('-', ' ', $product->catagory)) }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $product->contact }}</td>
                        <td class="px-6 py-4 text-gray-600">
                            @if($product->status == 'active')
                                <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">Active</span>
                            @else
                                <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-700">Inactive</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <!-- Tombol Edit -->
                                <button type="button"
                                    onclick="openEditModal({{ $product->id }}, '{{ addslashes($product->name_product) }}', '{{ addslashes($product->description) }}', '{{ $product->catagory }}', '{{ $product->contact }}', '{{ $product->status }}', '{{ addslashes($product->owner) }}')"
                                    class="bg-blue-500 text-white px-3 py-2 rounded hover:bg-blue-700 transition-colors">
                                    <i data-lucide="edit" class="w-5 h-5"></i>
                                </button>

                                <!-- Tombol Hapus -->
                                <form method="POST" action="{{ route('admin.products.destroy', $product) }}">
                                    @csrf @method('DELETE')
                                    <button class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-700 transition-colors">
                                        <i data-lucide="trash-2" class="w-5 h-5"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-12 text-gray-500">Belum ada produk yang ditambahkan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Produk -->
<div id="productModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-md w-full p-6">
            <h3 class="text-lg font-bold text-primary mb-4">Tambah Produk</h3>

            <form id="productForm" method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="space-y-4">
                    <input name="name_product" placeholder="Nama Produk" required class="w-full border px-3 py-2 rounded-lg text-gray-700">
                    <input name="owner" placeholder="Owner" required class="w-full border px-3 py-2 rounded-lg text-gray-700">
                    <textarea name="description" placeholder="Deskripsi" class="w-full border px-3 py-2 rounded-lg text-gray-700"></textarea>
                    <select name="catagory" required class="w-full border px-3 py-2 rounded-lg text-gray-700">
                        <option value="">Pilih Kategori</option>
                        <option value="pertanian">Pertanian</option>
                        <option value="budidaya-bunga">Budidaya Bunga</option>
                    </select>
                    <input name="contact" placeholder="Kontak (HP/WA)" required class="w-full border px-3 py-2 rounded-lg text-gray-700">
                    <input type="file" name="image" accept="image/*" class="w-full border px-3 py-2 rounded-lg">
                    <select name="status" required class="w-full border px-3 py-2 rounded-lg text-gray-700">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="flex gap-4 mt-6">
                    <button type="submit" class="flex-1 bg-primary text-white py-2 rounded-lg hover:bg-blue-800 transition-colors">Simpan</button>
                    <button type="button" onclick="closeModal()" class="flex-1 bg-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-400 transition-colors">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Produk -->
<div id="editProductModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-md w-full p-6">
            <h3 class="text-lg font-bold text-primary mb-4">Edit Produk</h3>

            <form id="editProductForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <input id="edit_name_product" name="name_product" required class="w-full border px-3 py-2 rounded-lg text-gray-700">
                    <input id="edit_owner" name="owner" required class="w-full border px-3 py-2 rounded-lg text-gray-700">
                    <textarea id="edit_description" name="description" class="w-full border px-3 py-2 rounded-lg text-gray-700"></textarea>
                    <select id="edit_catagory" name="catagory" required class="w-full border px-3 py-2 rounded-lg text-gray-700">
                        <option value="">Pilih Kategori</option>
                        <option value="pertanian">Pertanian</option>
                        <option value="budidaya-bunga">Budidaya Bunga</option>
                    </select>
                    <input id="edit_contact" name="contact" required class="w-full border px-3 py-2 rounded-lg text-gray-700">
                    <input type="file" name="image" accept="image/*" class="w-full border px-3 py-2 rounded-lg">
                    <select id="edit_status" name="status" required class="w-full border px-3 py-2 rounded-lg text-gray-700">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="flex gap-4 mt-6">
                    <button type="submit" class="flex-1 bg-primary text-white py-2 rounded-lg hover:bg-blue-800 transition-colors">Update</button>
                    <button type="button" onclick="closeEditModal()" class="flex-1 bg-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-400 transition-colors">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openAddModal() {
    document.getElementById('productModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('productModal').classList.add('hidden');
}

document.getElementById('productModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});

function openEditModal(id, name_product, description, catagory, contact, status, owner) {
    document.getElementById('edit_name_product').value = name_product;
    document.getElementById('edit_description').value = description;
    document.getElementById('edit_catagory').value = catagory;
    document.getElementById('edit_contact').value = contact;
    document.getElementById('edit_status').value = status;
    document.getElementById('edit_owner').value = owner;

    document.getElementById('editProductForm').action = `/admin/products/${id}`;

    document.getElementById('editProductModal').classList.remove('hidden');
}
function closeEditModal() {
    document.getElementById('editProductModal').classList.add('hidden');
}
document.getElementById('editProductModal').addEventListener('click', function(e) {
    if (e.target === this) closeEditModal();
});
</script>
@endsection
