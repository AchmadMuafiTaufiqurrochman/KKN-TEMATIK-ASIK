@extends('layouts.app')

@section('title', 'Peta Desa - Profil Digital Desa Wonokarang')

@section('content')
    <section class="py-20 bg-white pt-10">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-primary mb-4">Peta Interaktif Desa</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Jelajahi lokasi-lokasi penting di Desa Wonokarang dengan peta interaktif yang menampilkan fasilitas dan
                    area strategis bruuh
                </p>
            </div>

            <div class="grid lg:grid-cols-4 gap-8">
                <!-- Map Area -->
                <div class="lg:col-span-3">
                    <div class="bg-gray-100 rounded-xl overflow-hidden shadow-lg">
                        <div id="map" class="h-96 lg:h-[500px] relative"></div>

                        <!-- Map Legend -->
                        <div class="p-4 bg-white border-t">
                            <h4 class="font-semibold text-primary mb-2">Keterangan Peta:</h4>
                            <div class="text-sm text-gray-600">
                                <p>• Klik pada marker untuk melihat detail lokasi</p>
                                <p>• Gunakan sidebar untuk mengatur tampilan layer</p>
                                <p>• Peta menampilkan lokasi strategis dan fasilitas penting desa</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Controls -->
                <div class="space-y-6">
                    <!-- Layer Controls -->
                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <h3 class="text-lg font-bold text-primary mb-4">Kategori Fasilitas</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white">
                                        <i data-lucide="building-2" class="w-4 h-4"></i>
                                    </div>
                                    <div>
                                        <span class="text-gray-700 font-medium">Pelayanan Publik</span>
                                        <div class="text-xs text-gray-500">{{ $locationTypes['pelayanan_publik'] ?? 0 }} fasilitas</div>
                                    </div>
                                </div>
                                <button onclick="toggleLayer('pelayanan_publik')"
                                    class="text-gray-500 hover:text-primary transition-colors">
                                    <i data-lucide="eye" class="w-5 h-5"></i>
                                </button>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center text-white">
                                        <i data-lucide="graduation-cap" class="w-4 h-4"></i>
                                    </div>
                                    <div>
                                        <span class="text-gray-700 font-medium">Pendidikan</span>
                                        <div class="text-xs text-gray-500">{{ $locationTypes['pendidikan'] ?? 0 }} fasilitas</div>
                                    </div>
                                </div>
                                <button onclick="toggleLayer('pendidikan')"
                                    class="text-gray-500 hover:text-primary transition-colors">
                                    <i data-lucide="eye" class="w-5 h-5"></i>
                                </button>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center text-white">
                                        <i data-lucide="heart-pulse" class="w-4 h-4"></i>
                                    </div>
                                    <div>
                                        <span class="text-gray-700 font-medium">Kesehatan</span>
                                        <div class="text-xs text-gray-500">{{ $locationTypes['kesehatan'] ?? 0 }} fasilitas</div>
                                    </div>
                                </div>
                                <button onclick="toggleLayer('kesehatan')"
                                    class="text-gray-500 hover:text-primary transition-colors">
                                    <i data-lucide="eye" class="w-5 h-5"></i>
                                </button>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-yellow-600 rounded-full flex items-center justify-center text-white">
                                        <i data-lucide="store" class="w-4 h-4"></i>
                                    </div>
                                    <div>
                                        <span class="text-gray-700 font-medium">Ekonomi</span>
                                        <div class="text-xs text-gray-500">{{ $locationTypes['ekonomi'] ?? 0 }} fasilitas</div>
                                    </div>
                                </div>
                                <button onclick="toggleLayer('ekonomi')"
                                    class="text-gray-500 hover:text-primary transition-colors">
                                    <i data-lucide="eye" class="w-5 h-5"></i>
                                </button>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-purple-600 rounded-full flex items-center justify-center text-white">
                                        <i data-lucide="users" class="w-4 h-4"></i>
                                    </div>
                                    <div>
                                        <span class="text-gray-700 font-medium">Sosial & Budaya</span>
                                        <div class="text-xs text-gray-500">{{ $locationTypes['sosial_budaya'] ?? 0 }} fasilitas</div>
                                    </div>
                                </div>
                                <button onclick="toggleLayer('sosial_budaya')"
                                    class="text-gray-500 hover:text-primary transition-colors">
                                    <i data-lucide="eye" class="w-5 h-5"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                   

                    <!-- Statistics -->
                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <h3 class="text-lg font-bold text-primary mb-4">Statistik Fasilitas</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Total Fasilitas:</span>
                                <span class="font-semibold text-primary">{{ $locations->count() }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Pelayanan Publik:</span>
                                <span class="font-semibold text-blue-600">{{ $locationTypes['pelayanan_publik'] ?? 0 }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Pendidikan:</span>
                                <span class="font-semibold text-green-600">{{ $locationTypes['pendidikan'] ?? 0 }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Kesehatan:</span>
                                <span class="font-semibold text-red-600">{{ $locationTypes['kesehatan'] ?? 0 }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Ekonomi:</span>
                                <span class="font-semibold text-yellow-600">{{ $locationTypes['ekonomi'] ?? 0 }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Sosial & Budaya:</span>
                                <span class="font-semibold text-purple-600">{{ $locationTypes['sosial_budaya'] ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @push('scripts')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Koordinat Desa Wonokarang yang tepat
    var map = L.map('map').setView([-7.4129785, 112.5208843], 16);

    // Gunakan tile resmi Leaflet OSM
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    @foreach($locations as $location)
        @php
            $iconColors = [
                'pelayanan_publik' => '#2563eb',
                'pendidikan' => '#16a34a',
                'kesehatan' => '#dc2626',
                'ekonomi' => '#ca8a04',
                'sosial_budaya' => '#9333ea'
            ];
            $iconHtml = [
                'pelayanan_publik' => '<i class="fas fa-building" style="color: white; font-size: 14px;"></i>',
                'pendidikan' => '<i class="fas fa-graduation-cap" style="color: white; font-size: 14px;"></i>',
                'kesehatan' => '<i class="fas fa-heartbeat" style="color: white; font-size: 14px;"></i>',
                'ekonomi' => '<i class="fas fa-store" style="color: white; font-size: 14px;"></i>',
                'sosial_budaya' => '<i class="fas fa-users" style="color: white; font-size: 14px;"></i>'
            ];
            $color = $iconColors[$location->type] ?? '#6b7280';
            $icon = $iconHtml[$location->type] ?? '<i class="fas fa-map-marker-alt" style="color: white; font-size: 14px;"></i>';
        @endphp
        
        var customIcon = L.divIcon({
            html: `
                <div style="background-color: {{ $color }}; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border: 2px solid white;">
                    {!! $icon !!}
                </div>
            `,
            className: "marker-wrapper {{ $location->type }}",
            iconSize: [32, 32],
            iconAnchor: [16, 16]
        });

        L.marker([{{ $location->latitude }}, {{ $location->longitude }}], { icon: customIcon })
            .addTo(map)
            .bindPopup(`
                <div class="bg-white p-4 rounded-lg shadow-lg border max-w-80">
                    <div class="flex items-start gap-3 mb-3">
                        <div style="background-color: {{ $color }}; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            {!! $icon !!}
                        </div>
                        <div class="flex-1">
                            <h4 class="font-bold text-primary text-lg mb-1">{{ $location->name }}</h4>
                            <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full mb-2">
                                {{ $location->type_text ?? ucfirst(str_replace('_', ' ', $location->type)) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="space-y-2 text-sm">
                        @if($location->description)
                        <div class="flex items-start gap-2">
                            <i class="fas fa-info-circle text-gray-400 mt-0.5 flex-shrink-0"></i>
                            <p class="text-gray-700">{{ $location->description }}</p>
                        </div>
                        @endif
                        
                        @if($location->opening_hours)
                        <div class="flex items-center gap-2">
                            <i class="fas fa-clock text-gray-400 flex-shrink-0"></i>
                            <span class="text-gray-600">{{ $location->opening_hours }}</span>
                        </div>
                        @endif
                        
                        @if($location->pic_name)
                        <div class="flex items-center gap-2">
                            <i class="fas fa-user text-gray-400 flex-shrink-0"></i>
                            <span class="text-gray-600">{{ $location->pic_name }}</span>
                        </div>
                        @endif
                        
                        @if($location->contact)
                        <div class="flex items-center gap-2">
                            <i class="fas fa-phone text-gray-400 flex-shrink-0"></i>
                            <a href="tel:{{ $location->contact }}" class="text-blue-600 hover:underline">{{ $location->contact }}</a>
                        </div>
                        @endif
                    </div>
                    
                    @if($location->gmaps_link)
                    <div class="mt-3 pt-3 border-t border-gray-100">
                        <a href="{{ $location->gmaps_link }}" target="_blank" 
                           class="inline-flex items-center gap-1 px-3 py-1 bg-blue-600 text-white text-xs font-medium rounded-md hover:bg-blue-700 transition-colors">
                            <i class="fas fa-map-marker-alt"></i>
                            Google Maps
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                    @endif
                    
                    <div class="mt-3 pt-3 border-t border-gray-100">
                        <div class="grid grid-cols-2 gap-2 text-xs">
                            <div>
                                <span class="text-gray-500">Status:</span>
                                <span class="inline-block px-2 py-1 {{ $location->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }} text-xs rounded-full ml-1">
                                    {{ $location->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </div>
                            <div>
                                <span class="text-gray-500">Hari Ini:</span>
                                <span class="inline-block px-2 py-1 {{ $location->isOpenToday() ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} text-xs rounded-full ml-1">
                                    {{ $location->isOpenToday() ? 'Buka' : 'Tutup' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            `);
    @endforeach
});
</script>
@endpush
    <script>
        let visibleLayers = {
            pelayanan_publik: true,
            pendidikan: true,
            kesehatan: true,
            ekonomi: true,
            sosial_budaya: true
        };

        function toggleLayer(layerId) {
            visibleLayers[layerId] = !visibleLayers[layerId];
            
            // Toggle marker visibility
            const markers = document.querySelectorAll(`.marker-wrapper.${layerId}`);
            markers.forEach(marker => {
                marker.style.display = visibleLayers[layerId] ? 'block' : 'none';
            });

            // Toggle button icon
            const button = event.target.closest('button');
            const icon = button.querySelector('i[data-lucide]');
            if (visibleLayers[layerId]) {
                icon.setAttribute('data-lucide', 'eye');
            } else {
                icon.setAttribute('data-lucide', 'eye-off');
            }
            lucide.createIcons(); // Re-render icons
        }

            // Toggle markers
            const markers = document.querySelectorAll(`.location-marker[data-type="${layerId}"]`);
            const items = document.querySelectorAll(`.location-item[data-type="${layerId}"]`);

            markers.forEach(marker => {
                marker.style.display = visibleLayers[layerId] ? 'block' : 'none';
            });

            items.forEach(item => {
                item.style.display = visibleLayers[layerId] ? 'flex' : 'none';
            });

            // Update button icon
            const button = event.target.closest('button');
            const icon = button.querySelector('i');
            icon.setAttribute('data-lucide', visibleLayers[layerId] ? 'eye' : 'eye-off');
            lucide.createIcons();
        }
    </script>
@endsection
