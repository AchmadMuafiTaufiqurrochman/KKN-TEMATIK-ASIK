@extends('layouts.admin')

@section('title', 'Manajemen Lokasi - Admin Desa Mekar Sari')

@section('content')
<div class="min-h-screen bg-gray-50 pt-0">
    <!-- Admin Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-primary">Manajemen Lokasi Peta</h1>
                    <p class="text-gray-600">Kelola lokasi dan marker pada peta interaktif desa</p>
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
        <div class="grid md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center">
                        <i data-lucide="map-pin" class="w-6 h-6 text-white"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $stats['total'] }}</h3>
                <p class="text-gray-600 text-sm">Total Lokasi</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center">
                        <i data-lucide="eye" class="w-6 h-6 text-white"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $stats['active'] }}</h3>
                <p class="text-gray-600 text-sm">Aktif</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-orange-600 rounded-lg flex items-center justify-center">
                        <i data-lucide="eye-off" class="w-6 h-6 text-white"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $stats['inactive'] }}</h3>
                <p class="text-gray-600 text-sm">Tidak Aktif</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center">
                        <i data-lucide="map-pin" class="w-6 h-6 text-white"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-1">4</h3>
                <p class="text-gray-600 text-sm">Kategori</p>
            </div>
        </div>

        <div class="container mx-auto px-4 py-8">
            <!-- Map Preview -->
            <div class="lg:col-span-3">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
                    <div class="p-4 border-b border-gray-200">
                        <h3 class="text-lg font-bold text-primary">Preview Peta</h3>
                    </div>
                    <div class="h-96 relative bg-gradient-to-br from-green-100 to-blue-100">
                        <!-- Simulated Map Background -->
                        <div class="absolute inset-0 opacity-20">
                            <div class="w-full h-full bg-green-200 relative">
                                <div class="absolute top-0 left-0 w-full h-20 bg-blue-200"></div>
                                <div class="absolute bottom-0 right-0 w-40 h-40 bg-yellow-200 rounded-full"></div>
                                <div class="absolute top-20 left-20 w-60 h-60 bg-green-300 rounded-full"></div>
                            </div>
                        </div>

                        <!-- Location Markers -->
                        @foreach($locations as $location)
                        <div class="absolute transform -translate-x-1/2 -translate-y-1/2 group cursor-pointer"
                             style="left: {{ 50 + ($location->longitude - 110.3695) * 2000 }}%; top: {{ 50 + ($location->latitude + 7.7956) * 2000 }}%;">
                            <div class="{{ $location->type_color }} w-8 h-8 rounded-full flex items-center justify-center text-white shadow-lg hover:scale-110 transition-transform {{ $location->status === 'inactive' ? 'opacity-50' : '' }}">
                                @if($location->type === 'balai')
                                    <i data-lucide="home" class="w-4 h-4"></i>
                                @elseif($location->type === 'pertanian')
                                    <i data-lucide="leaf" class="w-4 h-4"></i>
                                @elseif($location->type === 'bunga')
                                    <i data-lucide="flower" class="w-4 h-4"></i>
                                @else
                                    <i data-lucide="heart" class="w-4 h-4"></i>
                                @endif
                            </div>
                            
                            <!-- Tooltip -->
                            <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <div class="bg-white p-2 rounded-lg shadow-lg border text-xs min-w-32">
                                    <h4 class="font-semibold text-primary">{{ $location->name }}</h4>
                                    <p class="text-gray-600">{{ $location->description }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4 mb-6">
                    <button onclick="openAddLocationModal()" class="bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800 transition-colors flex items-center gap-2">
                        <i data-lucide="plus" class="w-5 h-5"></i>
                        Tambah Lokasi
                    </button>
                </div>

                <!-- Locations Table -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="px-6 py-4 text-left">Nama Lokasi</th>
                                    <th class="px-6 py-4 text-left">Kategori</th>
                                    <th class="px-6 py-4 text-left">Koordinat</th>
                                    <th class="px-6 py-4 text-left">Status</th>
                                    <th class="px-6 py-4 text-left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($locations as $index => $location)
                                <tr class="{{ $index % 2 === 0 ? 'bg-gray-50' : 'bg-white' }}">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="{{ $location->type_color }} w-8 h-8 rounded-full flex items-center justify-center text-white">
                                                @if($location->type === 'balai')
                                                    <i data-lucide="home" class="w-4 h-4"></i>
                                                @elseif($location->type === 'pertanian')
                                                    <i data-lucide="leaf" class="w-4 h-4"></i>
                                                @elseif($location->type === 'bunga')
                                                    <i data-lucide="flower" class="w-4 h-4"></i>
                                                @else
                                                    <i data-lucide="heart" class="w-4 h-4"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900">{{ $location->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $location->description }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold 
                                            @if($location->type === 'balai') bg-blue-100 text-blue-800
                                            @elseif($location->type === 'pertanian') bg-green-100 text-green-800
                                            @elseif($location->type === 'bunga') bg-pink-100 text-pink-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            {{ $location->type_text }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 font-mono text-sm">
                                        {{ number_format($location->latitude, 4) }}, {{ number_format($location->longitude, 4) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $location->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $location->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-2">
                                            <button onclick="openEditLocationModal({{ $location->id }})" class="text-blue-600 hover:text-blue-800 transition-colors">
                                                <i data-lucide="edit" class="w-4 h-4"></i>
                                            </button>
                                            <form action="{{ route('admin.locations.destroy', $location) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus lokasi ini?')">
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
                                    <td colspan="5" class="text-center py-12">
                                        <p class="text-gray-500">Tidak ada data lokasi</p>
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
                        @foreach($locationTypes as $type => $count)
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-2">
                                @php
                                    $colors = [
                                        'balai' => 'bg-blue-600',
                                        'pertanian' => 'bg-green-600',
                                        'bunga' => 'bg-pink-600',
                                        'posyandu' => 'bg-red-600'
                                    ];
                                @endphp
                                <div class="w-3 h-3 {{ $colors[$type] }} rounded-full"></div>
                                <span class="text-sm text-gray-700">{{ ucfirst($type) }}</span>
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
        <div class="bg-white rounded-lg max-w-md w-full p-6">
            <h3 id="locationModalTitle" class="text-lg font-bold text-primary mb-4">Tambah Lokasi Baru</h3>
            
            <form id="locationForm" method="POST">
                @csrf
                <div id="locationMethodField"></div>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lokasi</label>
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
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Lokasi</label>
                        <select name="type" required class="w-full px-3 py-2 border  text-gray-800 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            <option value="">Pilih Tipe</option>
                            <option value="balai">Balai Desa</option>
                            <option value="pertanian">Pertanian</option>
                            <option value="bunga">Budidaya Bunga</option>
                            <option value="posyandu">Posyandu</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description" required rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" required class="w-full px-3 py-2 border  text-gray-800 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
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
function openAddLocationModal() {
    document.getElementById('locationModalTitle').textContent = 'Tambah Lokasi Baru';
    document.getElementById('locationForm').action = '{{ route("admin.locations.store") }}';
    document.getElementById('locationMethodField').innerHTML = '';
    document.getElementById('locationForm').reset();
    document.getElementById('locationModal').classList.remove('hidden');
}

function openEditLocationModal(id) {
    document.getElementById('locationModalTitle').textContent = 'Edit Lokasi';
    document.getElementById('locationForm').action = `/admin/locations/${id}`;
    document.getElementById('locationMethodField').innerHTML = '@method("PUT")';
    document.getElementById('locationModal').classList.remove('hidden');
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
</script>
@endsection