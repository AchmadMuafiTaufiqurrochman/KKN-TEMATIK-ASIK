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
        {{-- Statistik Card --}}
            <div class="grid md:grid-cols-5 gap-4 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center">
                        <i data-lucide="package" class="w-6 h-6 text-white"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $stats['total'] ?? 0 }}</h3>
                <p class="text-gray-600 text-sm">Total Produk</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center">
                        <i data-lucide="check-circle" class="w-6 h-6 text-white"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $stats['active'] ?? 0 }}</h3>
                <p class="text-gray-600 text-sm">Produk Aktif</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-red-600 rounded-lg flex items-center justify-center">
                        <i data-lucide="x-circle" class="w-6 h-6 text-white"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $stats['inactive'] ?? 0 }}</h3>
                <p class="text-gray-600 text-sm">Produk Tidak Aktif</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center">
                        <i data-lucide="wheat" class="w-6 h-6 text-white"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $categoryStats['pertanian'] ?? 0 }}</h3>
                <p class="text-gray-600 text-sm">Produk Pertanian</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-pink-600 rounded-lg flex items-center justify-center">
                        <i data-lucide="flower" class="w-6 h-6 text-white"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $categoryStats['budidaya-bunga'] ?? 0 }}</h3>
                <p class="text-gray-600 text-sm">Budidaya Bunga</p>
            </div>
        </div>


        {{-- Preview Map --}}
        <div class="bg-white rounded-lg shadow-lg mb-8 p-4">
            <h2 class="text-lg font-semibold text-primary mb-4">Peta Lokasi Produk</h2>
            <div id="previewMap" class="h-96 w-full rounded border"></div>
        </div>

        {{-- Alert Sukses --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center gap-3">
                <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
                <span class="text-green-700">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Tombol Tambah Produk --}}
        <button onclick="openAddModal()"
                class="bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800 transition-colors flex items-center gap-2 mb-6">
            <i data-lucide="plus" class="w-5 h-5"></i>
            Tambah Produk
        </button>

        {{-- Tabel Produk --}}
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <table class="w-full table-fixed">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="px-4 py-3 text-left w-20">Gambar</th>
                        <th class="px-4 py-3 text-left w-40">Nama Produk</th>
                        <th class="px-4 py-3 text-left w-32">Owner</th>
                        <th class="px-4 py-3 text-left w-60">Deskripsi</th>
                        <th class="px-4 py-3 text-left w-32">Kategori</th>
                        <th class="px-4 py-3 text-left w-32">Kontak</th>
                        <th class="px-4 py-3 text-left w-24">Status</th>
                        <th class="px-4 py-3 text-left w-36">Lokasi</th>
                        <th class="px-4 py-3 text-left w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody>
    @forelse($products as $product)
    <tr class="border-b">
        {{-- Gambar --}}
        <td class="px-4 py-3">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name_product }}" class="h-12 w-12 object-cover rounded">
            @else
                <span class="text-gray-400 italic text-sm">-</span>
            @endif
        </td>

        {{-- Nama Produk + Tooltip --}}
        <td class="px-4 py-3 font-medium text-gray-900 truncate relative group max-w-[150px]">
            <span>{{ $product->name_product }}</span>
            <div class="absolute z-10 hidden group-hover:block bg-gray-900 text-white text-xs rounded px-2 py-1 -top-8 left-1/2 -translate-x-1/2 whitespace-nowrap shadow-lg">
                {{ $product->name_product }}
            </div>
        </td>

        {{-- Owner + Tooltip --}}
        <td class="px-4 py-3 text-gray-600 truncate relative group max-w-[120px]">
            <span>{{ $product->owner }}</span>
            <div class="absolute z-10 hidden group-hover:block bg-gray-900 text-white text-xs rounded px-2 py-1 -top-8 left-1/2 -translate-x-1/2 whitespace-nowrap shadow-lg">
                {{ $product->owner }}
            </div>
        </td>

        {{-- Deskripsi + Tooltip --}}
        <td class="px-4 py-3 text-gray-600 truncate relative group max-w-xs">
            <span>{{ $product->description }}</span>
            <div class="absolute z-10 hidden group-hover:block bg-gray-900 text-white text-xs rounded px-2 py-1 -top-10 left-1/2 -translate-x-1/2 max-w-xs whitespace-normal shadow-lg">
                {{ $product->description }}
            </div>
        </td>

        {{-- Kategori --}}
        <td class="px-4 py-3 text-gray-600">
            @if($product->category == 'pertanian')
                <span class="flex items-center gap-2">
                    <i data-lucide="wheat" class="w-4 h-4 text-green-600"></i> Pertanian
                </span>
            @elseif($product->category == 'budidaya-bunga')
                <span class="flex items-center gap-2">
                    <i data-lucide="flower" class="w-4 h-4 text-pink-600"></i> Budidaya Bunga
                </span>
            @else
                <span class="italic text-gray-400">-</span>
            @endif
        </td>

        {{-- Kontak + Tooltip --}}
        <td class="px-4 py-3 text-gray-600 truncate relative group max-w-[140px]">
            <span>{{ $product->contact }}</span>
            <div class="absolute z-10 hidden group-hover:block bg-gray-900 text-white text-xs rounded px-2 py-1 -top-8 left-1/2 -translate-x-1/2 whitespace-nowrap shadow-lg">
                {{ $product->contact }}
            </div>
        </td>

        {{-- Status --}}
        <td class="px-4 py-3">
            @if($product->status == 'active')
                <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">Active</span>
            @else
                <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-700">Inactive</span>
            @endif
        </td>

        {{-- Lokasi --}}
        <td class="px-4 py-3 text-blue-600">
            @if($product->latitude && $product->longitude)
                <a href="https://www.google.com/maps?q={{ $product->latitude }},{{ $product->longitude }}" target="_blank" class="underline hover:text-blue-800 text-sm">
                    Lihat
                </a>
            @else
                <span class="text-gray-400 italic">-</span>
            @endif
        </td>

        {{-- Aksi --}}
        <td class="px-4 py-3">
            <div class="flex items-center gap-3">
                <button type="button"
                    onclick="openEditModal(
                        {{ $product->id }},
                        '{{ addslashes($product->name_product) }}',
                        '{{ addslashes($product->description) }}',
                        '{{ $product->category }}',
                        '{{ $product->contact }}',
                        '{{ $product->status }}',
                        '{{ addslashes($product->owner) }}',
                        '{{ $product->latitude ?? '' }}',
                        '{{ $product->longitude ?? '' }}'
                    )"
                    class="text-blue-600 hover:text-blue-800 transition-colors"
                    title="Edit Produk">
                    <i data-lucide="edit" class="w-5 h-5"></i>
                </button>
                <form method="POST" action="{{ route('admin.products.destroy', $product) }}">
                    @csrf @method('DELETE')
                    <button type="submit"
                        class="text-red-600 hover:text-red-800 transition-colors"
                        title="Hapus Produk">
                        <i data-lucide="trash-2" class="w-5 h-5"></i>
                    </button>
                </form>
            </div>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="9" class="text-center py-6 text-gray-500">Belum ada produk</td>
    </tr>
    @endforelse
</tbody>

            </table>
        </div>
    </div>
</div>

{{-- Modal Tambah Produk --}}
<div id="productModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-2xl w-full p-6">
            <h3 class="text-lg font-bold text-primary mb-4">Tambah Produk</h3>
            <form id="productForm" method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="space-y-4">
                    <input name="name_product" placeholder="Nama Produk" required class="w-full border px-3 py-2 rounded-lg text-gray-700">
                    <input name="owner" placeholder="Owner" required class="w-full border px-3 py-2 rounded-lg text-gray-700">
                    <textarea name="description" placeholder="Deskripsi" class="w-full border px-3 py-2 rounded-lg text-gray-700"></textarea>
                    <select name="category" required class="w-full border px-3 py-2 rounded-lg text-gray-700">
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
                    <div>
                        <label class="block font-semibold mb-2">Pilih Lokasi Produk</label>
                        <div id="addMap" class="h-64 w-full rounded border"></div>
                        <input type="hidden" name="latitude" id="add_latitude">
                        <input type="hidden" name="longitude" id="add_longitude">
                    </div>
                </div>
                <div class="flex gap-4 mt-6">
                    <button type="submit" class="flex-1 bg-primary text-white py-2 rounded-lg hover:bg-blue-800 transition-colors">Simpan</button>
                    <button type="button" onclick="closeModal()" class="flex-1 bg-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-400 transition-colors">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit Produk --}}
<div id="editProductModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-2xl w-full p-6">
            <h3 class="text-lg font-bold text-primary mb-4">Edit Produk</h3>
            <form id="editProductForm" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="space-y-4">
                    <input id="edit_name_product" name="name_product" required class="w-full border px-3 py-2 rounded-lg text-gray-700">
                    <input id="edit_owner" name="owner" required class="w-full border px-3 py-2 rounded-lg text-gray-700">
                    <textarea id="edit_description" name="description" class="w-full border px-3 py-2 rounded-lg text-gray-700"></textarea>
                    <select id="edit_category" name="category" required class="w-full border px-3 py-2 rounded-lg text-gray-700">
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
                    <div>
                        <label class="block font-semibold mb-2">Pilih Lokasi Produk</label>
                        <div id="editMap" class="h-64 w-full rounded border"></div>
                        <input type="hidden" name="latitude" id="edit_latitude">
                        <input type="hidden" name="longitude" id="edit_longitude">
                    </div>
                </div>
                <div class="flex gap-4 mt-6">
                    <button type="submit" class="flex-1 bg-primary text-white py-2 rounded-lg hover:bg-blue-800 transition-colors">Update</button>
                    <button type="button" onclick="closeEditModal()" class="flex-1 bg-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-400 transition-colors">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    // Pusat Desa Wonokarang, Balongbendo, Sidoarjo
    const desaCenter = [-7.4118, 112.5169]; // lat, lng

       const previewMap = L.map('previewMap', {
        center: desaCenter,
        zoom: 14
    });
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(previewMap);
    @foreach($products as $product)
        @if($product->latitude && $product->longitude)
            L.marker([{{ $product->latitude }}, {{ $product->longitude }}]).addTo(previewMap)
                .bindPopup(`<strong>{{ addslashes($product->name_product) }}</strong><br>{{ addslashes($product->owner) }}`);
        @endif
    @endforeach

    let addMap, addMarker, editMap, editMarker;

    function openAddModal() {
        document.getElementById('productModal').classList.remove('hidden');

        setTimeout(() => {
            if (!addMap) {
                addMap = L.map('addMap', {
                    center: desaCenter,
                    zoom: 16
                });
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap'
                }).addTo(addMap);

                // default marker & default nilai form (biar langsung terset ke desaCenter)
                addMarker = L.marker(desaCenter).addTo(addMap);
                document.getElementById('add_latitude').value = desaCenter[0];
                document.getElementById('add_longitude').value = desaCenter[1];

                addMap.on('click', function(e) {
                    if (addMarker) addMap.removeLayer(addMarker);
                    addMarker = L.marker(e.latlng).addTo(addMap);
                    document.getElementById('add_latitude').value = e.latlng.lat;
                    document.getElementById('add_longitude').value = e.latlng.lng;
                });
            } else {
                addMap.setView(desaCenter, 16);
                if (addMarker) addMap.removeLayer(addMarker);
                addMarker = L.marker(desaCenter).addTo(addMap);
                document.getElementById('add_latitude').value = desaCenter[0];
                document.getElementById('add_longitude').value = desaCenter[1];
            }
            addMap.invalidateSize();
        }, 300);
    }

    function closeModal() {
        document.getElementById('productModal').classList.add('hidden');
    }

    function openEditModal(id, name_product, description, category, contact, status, owner, lat, lng) {
        document.getElementById('edit_name_product').value = name_product;
        document.getElementById('edit_description').value = description;
        document.getElementById('edit_category').value = category;
        document.getElementById('edit_contact').value = contact;
        document.getElementById('edit_status').value = status;
        document.getElementById('edit_owner').value = owner;

        // fallback ke desaCenter kalau belum ada koordinat
        const hasCoords = lat && lng;
        const startLatLng = hasCoords ? [parseFloat(lat), parseFloat(lng)] : desaCenter;

        document.getElementById('edit_latitude').value = startLatLng[0];
        document.getElementById('edit_longitude').value = startLatLng[1];

        document.getElementById('editProductForm').action = `/admin/products/${id}`;
        document.getElementById('editProductModal').classList.remove('hidden');

        setTimeout(() => {
            if (!editMap) {
                editMap = L.map('editMap', {
                    center: startLatLng,
                    zoom: 16
                });
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap'
                }).addTo(editMap);

                editMarker = L.marker(startLatLng).addTo(editMap);

                editMap.on('click', function(e) {
                    if (editMarker) editMap.removeLayer(editMarker);
                    editMarker = L.marker(e.latlng).addTo(editMap);
                    document.getElementById('edit_latitude').value = e.latlng.lat;
                    document.getElementById('edit_longitude').value = e.latlng.lng;
                });
            } else {
                editMap.setView(startLatLng, 16);
                if (editMarker) editMap.removeLayer(editMarker);
                editMarker = L.marker(startLatLng).addTo(editMap);
            }
            editMap.invalidateSize();
        }, 300);
    }

    function closeEditModal() {
        document.getElementById('editProductModal').classList.add('hidden');
    }
</script>
@endpush
@endsection
