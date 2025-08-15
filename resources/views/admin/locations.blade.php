@extends('layouts.admin')

@section('title', 'Manajemen Fasilitas Desa - Admin Desa Wonokarang')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" 
      integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" 
      crossorigin="" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
.custom-marker {
    background: transparent !important;
    border: none !important;
}
#adminMap {
    z-index: 1;
}
.leaflet-popup-content-wrapper {
    border-radius: 8px;
}
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gray-50 pt-0">
    <!-- Admin Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-primary">Manajemen Fasilitas Desa</h1>
                    <p class="text-gray-600">Kelola fasilitas dan layanan desa pada peta interaktif</p>
                </div>
               
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center gap-3">
                <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
                <span class="text-green-700">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Statistics -->
        <div class="grid md:grid-cols-5 gap-4 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center">
                        <i data-lucide="building-2" class="w-6 h-6 text-white"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $stats['total'] ?? 0 }}</h3>
                <p class="text-gray-600 text-sm">Total Fasilitas</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center">
                        <i data-lucide="check-circle" class="w-6 h-6 text-white"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $stats['active'] ?? 0 }}</h3>
                <p class="text-gray-600 text-sm">Aktif</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-orange-600 rounded-lg flex items-center justify-center">
                        <i data-lucide="x-circle" class="w-6 h-6 text-white"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $stats['inactive'] ?? 0 }}</h3>
                <p class="text-gray-600 text-sm">Tidak Aktif</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center">
                        <i data-lucide="grid-3x3" class="w-6 h-6 text-white"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ count($fasilitasTypes ?? []) }}</h3>
                <p class="text-gray-600 text-sm">Kategori</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center">
                        <i data-lucide="clock" class="w-6 h-6 text-white"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $stats['open_today'] ?? 0 }}</h3>
                <p class="text-gray-600 text-sm">Buka Hari Ini</p>
            </div>
        </div>

        <div class="container mx-auto px-4 py-8">
            <!-- Map Preview -->
            <div class="lg:col-span-3">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
                    <div class="p-4 border-b border-gray-200">
                        <h3 class="text-lg font-bold text-primary">Preview Peta Fasilitas</h3>
                        <p class="text-sm text-gray-600">Klik pada marker untuk melihat detail fasilitas. Klik pada peta kosong untuk menambah fasilitas baru di lokasi tersebut.</p>
                    </div>
                    <div id="adminMap" class="h-96 relative"></div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4 mb-6">
                    <button onclick="openAddLocationModal()" class="bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800 transition-colors flex items-center gap-2">
                        <i data-lucide="plus" class="w-5 h-5"></i>
                        Tambah Fasilitas
                    </button>
                </div>

                <!-- Locations Table -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="px-6 py-4 text-left">Nama Fasilitas</th>
                                    <th class="px-6 py-4 text-left">Kategori</th>
                                    <th class="px-6 py-4 text-left">Jam Operasional</th>
                                    <th class="px-6 py-4 text-left">Penanggung Jawab</th>
                                    <th class="px-6 py-4 text-left">Kontak</th>
                                    <th class="px-6 py-4 text-left">Google Maps</th>
                                    <th class="px-6 py-4 text-left">Status</th>
                                    <th class="px-6 py-4 text-left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($fasilitas as $index => $fasilitasItem)
                                <tr class="{{ $index % 2 === 0 ? 'bg-gray-50' : 'bg-white' }}">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="{{ $fasilitasItem->type_color ?? 'bg-gray-600' }} w-8 h-8 rounded-full flex items-center justify-center text-white">
                                                @if($fasilitasItem->type === 'pelayanan_publik')
                                                    <i data-lucide="building-2" class="w-4 h-4"></i>
                                                @elseif($fasilitasItem->type === 'pendidikan')
                                                    <i data-lucide="graduation-cap" class="w-4 h-4"></i>
                                                @elseif($fasilitasItem->type === 'kesehatan')
                                                    <i data-lucide="heart-pulse" class="w-4 h-4"></i>
                                                @elseif($fasilitasItem->type === 'ekonomi')
                                                    <i data-lucide="store" class="w-4 h-4"></i>
                                                @elseif($fasilitasItem->type === 'sosial_budaya')
                                                    <i data-lucide="users" class="w-4 h-4"></i>
                                                @else
                                                    <i data-lucide="map-pin" class="w-4 h-4"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900">{{ $fasilitasItem->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $fasilitasItem->description }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold 
                                            @if($fasilitasItem->type === 'pelayanan_publik') bg-blue-100 text-blue-800
                                            @elseif($fasilitasItem->type === 'pendidikan') bg-green-100 text-green-800
                                            @elseif($fasilitasItem->type === 'kesehatan') bg-red-100 text-red-800
                                            @elseif($fasilitasItem->type === 'ekonomi') bg-yellow-100 text-yellow-800
                                            @elseif($fasilitasItem->type === 'sosial_budaya') bg-purple-100 text-purple-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ $fasilitasItem->type_text ?? ucfirst(str_replace('_', ' ', $fasilitasItem->type)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 text-sm">
                                        {{ $fasilitasItem->opening_hours ?? 'Tidak ditentukan' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 text-sm">
                                        {{ $fasilitasItem->pic_name ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 text-sm">
                                        {{ $fasilitasItem->contact ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 text-sm">
                                        @if($fasilitasItem->gmaps_link)
                                            <a href="{{ $fasilitasItem->gmaps_link }}" target="_blank" 
                                               class="text-blue-600 hover:text-blue-800 inline-flex items-center gap-1 text-xs">
                                                <i data-lucide="map-pin" class="w-3 h-3"></i>
                                                Lihat Maps
                                            </a>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $fasilitasItem->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $fasilitasItem->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-2">
                                           
                                            <button onclick="openEditLocationModal({{ $fasilitasItem->id }})" class="text-blue-600 hover:text-blue-800 transition-colors">
                                                <i data-lucide="edit" class="w-4 h-4"></i>
                                            </button>
                                            <form action="{{ route('admin.fasilitas.destroy', $fasilitasItem) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus fasilitas ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 transition-colors">
                                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-12">
                                        <p class="text-gray-500">Tidak ada data fasilitas</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Sidebar Controls -->
            <div class="space-y-6">
                <!-- Statistics by Category -->
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <h3 class="text-lg font-bold text-primary mb-4">Statistik Kategori</h3>
                    <div class="space-y-3">
                        @foreach($locationTypes ?? [] as $type => $count)
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-2">
                                @php
                                    $colors = [
                                        'pelayanan_publik' => 'bg-blue-600',
                                        'pendidikan' => 'bg-green-600',
                                        'kesehatan' => 'bg-red-600',
                                        'ekonomi' => 'bg-yellow-600',
                                        'sosial_budaya' => 'bg-purple-600',
                                    ];
                                    $typeLabels = [
                                        'pelayanan_publik' => 'Pelayanan Publik',
                                        'pendidikan' => 'Pendidikan',
                                        'kesehatan' => 'Kesehatan',
                                        'ekonomi' => 'Ekonomi',
                                        'sosial_budaya' => 'Sosial & Budaya',
                                    ];
                                @endphp
                                <div class="w-3 h-3 {{ $colors[$type] ?? 'bg-gray-600' }} rounded-full"></div>
                                <span class="text-sm text-gray-700">{{ $typeLabels[$type] ?? ucfirst(str_replace('_', ' ', $type)) }}</span>
                            </div>
                            <span class="text-sm font-semibold text-gray-900">{{ $count }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add/Edit Location Modal -->
<div id="locationModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-2xl w-full p-6 max-h-[90vh] overflow-y-auto">
            <h3 id="locationModalTitle" class="text-lg font-bold text-primary mb-4">Tambah Fasilitas Baru</h3>
            
            <form id="locationForm" method="POST">
                @csrf
                <div id="locationMethodField"></div>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Fasilitas</label>
                        <input type="text" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Latitude</label>
                            <input type="number" name="latitude" step="0.00000001" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Longitude</label>
                            <input type="number" name="longitude" step="0.00000001" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori Fasilitas</label>
                        <select name="type" required class="w-full px-3 py-2 border text-gray-800 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            <option value="">Pilih Kategori</option>
                            <option value="pelayanan_publik">Pelayanan Publik & Pemerintah</option>
                            <option value="pendidikan">Pendidikan</option>
                            <option value="kesehatan">Kesehatan</option>
                            <option value="ekonomi">Ekonomi</option>
                            <option value="sosial_budaya">Sosial & Budaya</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description" required rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jam Operasional</label>
                        <input type="text" name="opening_hours" placeholder="Contoh: Senin-Jumat 08:00-16:00" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Penanggung Jawab</label>
                            <input type="text" name="pic_name" placeholder="Nama penanggung jawab" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kontak</label>
                            <input type="text" name="contact" placeholder="No. telepon / email" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Link Google Maps</label>
                        <input type="url" name="gmaps_link" placeholder="https://maps.google.com/..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        <p class="text-xs text-gray-500 mt-1">Link ke Google Maps untuk navigasi lebih mudah</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" required class="w-full px-3 py-2 border text-gray-800 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            <option value="active">Aktif</option>
                            <option value="inactive">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                
                <div class="flex gap-4 mt-6">
                    <button type="submit" class="flex-1 bg-primary text-white py-2 rounded-lg hover:bg-blue-800 transition-colors">
                        Simpan
                    </button>
                    <button type="button" onclick="closeLocationModal()" class="flex-1 bg-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-400 transition-colors">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
function openDetailModal(id) {
    // Fetch data untuk detail
    fetch(`/admin/fasilitas/${id}`)
        .then(response => response.json())
        .then(data => {
            const typeLabels = {
                'pelayanan_publik': 'Pelayanan Publik & Pemerintah',
                'pendidikan': 'Pendidikan',
                'kesehatan': 'Kesehatan',
                'ekonomi': 'Ekonomi',
                'sosial_budaya': 'Sosial & Budaya'
            };
            
            const typeColors = {
                'pelayanan_publik': 'bg-blue-100 text-blue-800',
                'pendidikan': 'bg-green-100 text-green-800',
                'kesehatan': 'bg-red-100 text-red-800',
                'ekonomi': 'bg-yellow-100 text-yellow-800',
                'sosial_budaya': 'bg-purple-100 text-purple-800'
            };
            
            const detailContent = `
                <div class="bg-white p-4 rounded-lg shadow-lg border max-w-80">
                    <div class="flex items-start gap-3 mb-3">
                        <div style="background-color: #2563eb; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-map-pin" style="color: white; font-size: 14px;"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-bold text-primary text-lg mb-1">${data.name}</h4>
                            <span class="inline-block px-2 py-1 ${typeColors[data.type] || 'bg-gray-100 text-gray-800'} text-xs font-medium rounded-full mb-2">
                                ${typeLabels[data.type] || data.type}
                            </span>
                        </div>
                    </div>
                    
                    <div class="space-y-2 text-sm">
                        ${data.description ? `
                        <div class="flex items-start gap-2">
                            <i class="fas fa-info-circle text-gray-400 mt-0.5 flex-shrink-0"></i>
                            <p class="text-gray-700">${data.description}</p>
                        </div>
                        ` : ''}
                        
                        ${data.opening_hours ? `
                        <div class="flex items-center gap-2">
                            <i class="fas fa-clock text-gray-400 flex-shrink-0"></i>
                            <span class="text-gray-600">${data.opening_hours}</span>
                        </div>
                        ` : ''}
                        
                        ${data.pic_name ? `
                        <div class="flex items-center gap-2">
                            <i class="fas fa-user text-gray-400 flex-shrink-0"></i>
                            <span class="text-gray-600">${data.pic_name}</span>
                        </div>
                        ` : ''}
                        
                        ${data.contact ? `
                        <div class="flex items-center gap-2">
                            <i class="fas fa-phone text-gray-400 flex-shrink-0"></i>
                            <a href="tel:${data.contact}" class="text-blue-600 hover:underline">${data.contact}</a>
                        </div>
                        ` : ''}
                    </div>
                    
                    ${data.gmaps_link ? `
                    <div class="mt-3 pt-3 border-t border-gray-100">
                        <a href="${data.gmaps_link}" target="_blank" 
                           class="inline-flex items-center gap-1 px-3 py-1 bg-blue-600 text-white text-xs font-medium rounded-md hover:bg-blue-700 transition-colors">
                            <i class="fas fa-map-marker-alt"></i>
                            Google Maps
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                    ` : ''}
                    
                    <div class="mt-3 pt-3 border-t border-gray-100">
                        <div class="grid grid-cols-2 gap-2 text-xs">
                            <div>
                                <span class="text-gray-500">Status:</span>
                                <span class="inline-block px-2 py-1 ${data.status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'} text-xs rounded-full ml-1">
                                    ${data.status === 'active' ? 'Aktif' : 'Tidak Aktif'}
                                </span>
                            </div>
                            <div>
                                <span class="text-gray-500">Hari Ini:</span>
                                <span class="inline-block px-2 py-1 ${data.is_open_today ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'} text-xs rounded-full ml-1">
                                    ${data.is_open_today ? 'Buka' : 'Tutup'}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            document.getElementById('detailContent').innerHTML = detailContent;
            document.getElementById('detailModal').classList.remove('hidden');
            lucide.createIcons();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memuat data fasilitas');
        });
}

function closeDetailModal() {
    document.getElementById('detailModal').classList.add('hidden');
}

function openAddLocationModal() {
    document.getElementById('locationModalTitle').textContent = 'Tambah Fasilitas Baru';
    document.getElementById('locationForm').action = '{{ route("admin.fasilitas.store") }}';
    document.getElementById('locationMethodField').innerHTML = '';
    document.getElementById('locationForm').reset();
    document.getElementById('locationModal').classList.remove('hidden');
}

function openEditLocationModal(id) {
    // Fetch data untuk edit
    fetch(`/admin/fasilitas/${id}/edit`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('locationModalTitle').textContent = 'Edit Fasilitas';
            document.getElementById('locationForm').action = `/admin/fasilitas/${id}`;
            document.getElementById('locationMethodField').innerHTML = '@method("PUT")';
            
            // Populate form fields
            document.querySelector('input[name="name"]').value = data.name || '';
            document.querySelector('input[name="latitude"]').value = data.latitude || '';
            document.querySelector('input[name="longitude"]').value = data.longitude || '';
            document.querySelector('select[name="type"]').value = data.type || '';
            document.querySelector('textarea[name="description"]').value = data.description || '';
            document.querySelector('input[name="opening_hours"]').value = data.opening_hours || '';
            document.querySelector('input[name="pic_name"]').value = data.pic_name || '';
            document.querySelector('input[name="contact"]').value = data.contact || '';
            document.querySelector('input[name="gmaps_link"]').value = data.gmaps_link || '';
            document.querySelector('select[name="status"]').value = data.status || 'active';
            
            document.getElementById('locationModal').classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error:', error);
            // Fallback untuk edit manual
            document.getElementById('locationModalTitle').textContent = 'Edit Fasilitas';
            document.getElementById('locationForm').action = `/admin/fasilitas/${id}`;
            document.getElementById('locationMethodField').innerHTML = '@method("PUT")';
            document.getElementById('locationModal').classList.remove('hidden');
        });
}

function closeLocationModal() {
    document.getElementById('locationModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('locationModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeLocationModal();
    }
});

// Auto-populate jam operasional berdasarkan kategori
document.querySelector('select[name="type"]').addEventListener('change', function() {
    const openingHoursInput = document.querySelector('input[name="opening_hours"]');
    const defaultHours = {
        'pelayanan_publik': 'Senin-Jumat 07:30-16:00',
        'pendidikan': 'Senin-Sabtu 07:00-14:00',
        'kesehatan': 'Senin-Sabtu 08:00-15:00',
        'ekonomi': 'Setiap hari 06:00-18:00',
        'sosial_budaya': 'Senin-Minggu 08:00-17:00'
    };
    
    if (defaultHours[this.value] && !openingHoursInput.value) {
        openingHoursInput.value = defaultHours[this.value];
    }
});

// Data fasilitas untuk map
window.facilitiesData = @json($fasilitas ?? []);

// Initialize map setelah DOM loaded
document.addEventListener('DOMContentLoaded', function() {
    if (window.adminMap && window.facilitiesData) {
        // Add all existing facilities to map
        window.facilitiesData.forEach(facility => {
            window.adminMap.addMarker(facility);
        });
    }
});
</script>

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" 
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" 
        crossorigin=""></script>
<script src="{{ asset('js/admin-map.js') }}"></script>
@endpush

@endsection