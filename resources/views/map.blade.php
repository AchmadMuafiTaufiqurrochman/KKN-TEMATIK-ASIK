@extends('layouts.app')

@section('title', 'Peta Desa - Profil Digital Desa Wonokarang')

@section('content')
    <section class="py-20 bg-white pt-10">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-primary mb-4">Peta Interaktif Desa</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Jelajahi lokasi-lokasi penting di Desa Wonokarang dengan peta interaktif yang menampilkan fasilitas dan
                    area strategis
                </p>
            </div>

            <!-- Mobile/Tablet Layout -->
            <div class="block lg:hidden space-y-6">
                <!-- Sidebar Controls untuk Mobile -->
                <div class="bg-white p-4 rounded-xl shadow-lg">
                    <h3 class="text-lg font-bold text-primary mb-4">Kategori Fasilitas</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        <div class="flex items-center gap-2 transition-opacity duration-200" data-layer="pelayanan_publik">
                            <div class="w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center text-white">
                                <i data-lucide="building-2" class="w-3 h-3"></i>
                            </div>
                            <span class="text-sm text-gray-700">Publik</span>
                            <button onclick="toggleLayer('pelayanan_publik')" class="text-gray-500 hover:text-primary">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </button>
                        </div>
                        <div class="flex items-center gap-2 transition-opacity duration-200" data-layer="pendidikan">
                            <div class="w-6 h-6 bg-green-600 rounded-full flex items-center justify-center text-white">
                                <i data-lucide="graduation-cap" class="w-3 h-3"></i>
                            </div>
                            <span class="text-sm text-gray-700">Pendidikan</span>
                            <button onclick="toggleLayer('pendidikan')" class="text-gray-500 hover:text-primary">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </button>
                        </div>
                        <div class="flex items-center gap-2 transition-opacity duration-200" data-layer="kesehatan">
                            <div class="w-6 h-6 bg-red-600 rounded-full flex items-center justify-center text-white">
                                <i data-lucide="heart-pulse" class="w-3 h-3"></i>
                            </div>
                            <span class="text-sm text-gray-700">Kesehatan</span>
                            <button onclick="toggleLayer('kesehatan')" class="text-gray-500 hover:text-primary">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </button>
                        </div>
                        <div class="flex items-center gap-2 transition-opacity duration-200" data-layer="ekonomi">
                            <div class="w-6 h-6 bg-yellow-600 rounded-full flex items-center justify-center text-white">
                                <i data-lucide="store" class="w-3 h-3"></i>
                            </div>
                            <span class="text-sm text-gray-700">Ekonomi</span>
                            <button onclick="toggleLayer('ekonomi')" class="text-gray-500 hover:text-primary">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Map Area untuk Mobile -->
                <div class="bg-gray-100 rounded-xl overflow-hidden shadow-lg">
                    <div id="map-mobile" class="h-80 sm:h-96 relative z-0"></div>
                    <div class="p-4 bg-white border-t">
                        <h4 class="font-semibold text-primary mb-2">Keterangan Peta:</h4>
                        <div class="text-sm text-gray-600 space-y-1">
                            <p>• Klik marker untuk detail lokasi</p>
                            <p>• Total: {{ $locations->count() }} fasilitas</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Desktop Layout -->
            <div class="hidden lg:grid lg:grid-cols-4 gap-8">
                <!-- Map Area -->
                <div class="lg:col-span-3">
                    <div class="bg-gray-100 rounded-xl overflow-hidden shadow-lg">
                        <div id="map-desktop" class="h-96 lg:h-[500px] relative z-0"></div>
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
                            <div class="flex items-center justify-between transition-opacity duration-200" data-layer="pelayanan_publik">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white">
                                        <i data-lucide="building-2" class="w-4 h-4"></i>
                                    </div>
                                    <div>
                                        <span class="text-gray-700 font-medium">Pelayanan Publik</span>
                                        <div class="text-xs text-gray-500">{{ $locationTypes['pelayanan_publik'] ?? 0 }} fasilitas</div>
                                    </div>
                                </div>
                                <button onclick="toggleLayer('pelayanan_publik')" class="text-gray-500 hover:text-primary transition-colors">
                                    <i data-lucide="eye" class="w-5 h-5"></i>
                                </button>
                            </div>

                            <div class="flex items-center justify-between transition-opacity duration-200" data-layer="pendidikan">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center text-white">
                                        <i data-lucide="graduation-cap" class="w-4 h-4"></i>
                                    </div>
                                    <div>
                                        <span class="text-gray-700 font-medium">Pendidikan</span>
                                        <div class="text-xs text-gray-500">{{ $locationTypes['pendidikan'] ?? 0 }} fasilitas</div>
                                    </div>
                                </div>
                                <button onclick="toggleLayer('pendidikan')" class="text-gray-500 hover:text-primary transition-colors">
                                    <i data-lucide="eye" class="w-5 h-5"></i>
                                </button>
                            </div>

                            <div class="flex items-center justify-between transition-opacity duration-200" data-layer="kesehatan">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center text-white">
                                        <i data-lucide="heart-pulse" class="w-4 h-4"></i>
                                    </div>
                                    <div>
                                        <span class="text-gray-700 font-medium">Kesehatan</span>
                                        <div class="text-xs text-gray-500">{{ $locationTypes['kesehatan'] ?? 0 }} fasilitas</div>
                                    </div>
                                </div>
                                <button onclick="toggleLayer('kesehatan')" class="text-gray-500 hover:text-primary transition-colors">
                                    <i data-lucide="eye" class="w-5 h-5"></i>
                                </button>
                            </div>

                            <div class="flex items-center justify-between transition-opacity duration-200" data-layer="ekonomi">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-yellow-600 rounded-full flex items-center justify-center text-white">
                                        <i data-lucide="store" class="w-4 h-4"></i>
                                    </div>
                                    <div>
                                        <span class="text-gray-700 font-medium">Ekonomi</span>
                                        <div class="text-xs text-gray-500">{{ $locationTypes['ekonomi'] ?? 0 }} fasilitas</div>
                                    </div>
                                </div>
                                <button onclick="toggleLayer('ekonomi')" class="text-gray-500 hover:text-primary transition-colors">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('styles')
        <style>
            /* Fix z-index untuk map container */
            .leaflet-container {
                z-index: 1 !important;
            }
            
            /* Fix z-index untuk popup */
            .leaflet-popup {
                z-index: 1000 !important;
            }
            
            /* Fix z-index untuk controls */
            .leaflet-control-container {
                z-index: 999 !important;
            }
            
            /* Pastikan map tidak overlap dengan navbar */
            #map-mobile,
            #map-desktop {
                position: relative;
                z-index: 1;
            }
            
            /* Responsive touch untuk mobile */
            @media (max-width: 1023px) {
                .leaflet-container {
                    touch-action: pan-x pan-y;
                }
            }
            
            /* Fix untuk marker wrapper */
            .marker-wrapper {
                z-index: 100 !important;
            }
            
            /* Visual feedback untuk kategori yang disembunyikan */
            [data-layer].opacity-50 {
                opacity: 0.5;
                transition: opacity 0.3s ease;
            }
            
            /* Hover effect untuk toggle buttons */
            button[onclick*="toggleLayer"] {
                transition: all 0.2s ease;
            }
            
            button[onclick*="toggleLayer"]:hover {
                transform: scale(1.1);
            }
            
            /* Animasi untuk icon mata */
            i[data-lucide="eye"], i[data-lucide="eye-off"] {
                transition: all 0.2s ease;
            }
        </style>
    @endpush

    @push('scripts')
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Fungsi untuk membuat map
                function createMap(containerId) {
                    // Koordinat Desa Wonokarang yang tepat
                    var map = L.map(containerId, {
                        zoomControl: true,
                        scrollWheelZoom: true,
                        touchZoom: true,
                        doubleClickZoom: true,
                        boxZoom: true,
                        keyboard: true,
                        dragging: true
                    }).setView([-7.4129785, 112.5208843], 16);

                    // Gunakan tile resmi Leaflet OSM
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors',
                        maxZoom: 19
                    }).addTo(map);

                    return map;
                }

                // Buat map untuk desktop dan mobile
                var mapDesktop = null;
                var mapMobile = null;

                if (window.innerWidth >= 1024) {
                    mapDesktop = createMap('map-desktop');
                } else {
                    mapMobile = createMap('map-mobile');
                }

                // Fungsi untuk menambah markers
                function addMarkersToMap(map) {
                    @foreach ($locations as $location)
                        @php
                            $iconColors = [
                                'pelayanan_publik' => '#2563eb',
                                'pendidikan' => '#16a34a',
                                'kesehatan' => '#dc2626',
                                'ekonomi' => '#ca8a04',
                            ];
                            $iconHtml = [
                                'pelayanan_publik' => '<i class="fas fa-building" style="color: white; font-size: 12px;"></i>',
                                'pendidikan' => '<i class="fas fa-graduation-cap" style="color: white; font-size: 12px;"></i>',
                                'kesehatan' => '<i class="fas fa-heartbeat" style="color: white; font-size: 12px;"></i>',
                                'ekonomi' => '<i class="fas fa-store" style="color: white; font-size: 12px;"></i>',
                            ];
                            $color = $iconColors[$location->type] ?? '#6b7280';
                            $icon = $iconHtml[$location->type] ?? '<i class="fas fa-map-marker-alt" style="color: white; font-size: 12px;"></i>';
                        @endphp

                        var customIcon = L.divIcon({
                            html: `
                                <div style="background-color: {{ $color }}; width: 28px; height: 28px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 4px rgba(0,0,0,0.2); border: 2px solid white;">
                                    {!! $icon !!}
                                </div>
                            `,
                            className: "marker-wrapper {{ $location->type }}",
                            iconSize: [28, 28],
                            iconAnchor: [14, 14]
                        });

                        var marker = L.marker([{{ $location->latitude }}, {{ $location->longitude }}], {
                            icon: customIcon
                        }).addTo(map);

                        // Store reference untuk toggle functionality
                        marker._layerType = '{{ $location->type }}';
                        
                        // Store marker reference in global object untuk easier access
                        if (!window.mapMarkers) {
                            window.mapMarkers = {};
                        }
                        if (!window.mapMarkers['{{ $location->type }}']) {
                            window.mapMarkers['{{ $location->type }}'] = [];
                        }
                        window.mapMarkers['{{ $location->type }}'].push(marker);

                        marker.bindPopup(`
                            <div style="font-family: Arial; font-size: 13px; max-width: 250px;">
                                <div style="display: flex; align-items: center; margin-bottom: 8px;">
                                    <div style="background-color: {{ $color }}; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 8px;">
                                        {!! $icon !!}
                                    </div>
                                    <div>
                                        <strong style="font-size: 14px; color: #1e293b;">{{ e($location->name) }}</strong><br>
                                        <small style="color: #475569;">{{ $location->type_text ?? ucfirst(str_replace('_', ' ', $location->type)) }}</small>
                                    </div>
                                </div>

                                @if ($location->description)
                                    <p style="margin: 6px 0; color: #334155; font-size: 12px;">{{ e($location->description) }}</p>
                                @endif

                                @if ($location->opening_hours)
                                    <p style="margin: 4px 0; display: flex; align-items: center; color: #475569; font-size: 12px;">
                                        <i class="fas fa-clock" style="margin-right: 6px; color: #6b7280; font-size: 10px;"></i>
                                        {{ e($location->opening_hours) }}
                                    </p>
                                @endif

                                @if ($location->pic_name)
                                    <p style="margin: 4px 0; display: flex; align-items: center; color: #475569; font-size: 12px;">
                                        <i class="fas fa-user" style="margin-right: 6px; color: #6b7280; font-size: 10px;"></i>
                                        {{ e($location->pic_name) }}
                                    </p>
                                @endif

                                @if ($location->contact)
                                    <p style="margin: 4px 0; display: flex; align-items: center; color: #475569; font-size: 12px;">
                                        <i class="fas fa-phone" style="margin-right: 6px; color: #6b7280; font-size: 10px;"></i>
                                        <a href="tel:{{ e($location->contact) }}" style="color: #2563eb; text-decoration: none;">{{ e($location->contact) }}</a>
                                    </p>
                                @endif

                                <p style="margin-top: 6px;">
                                    <span style="display:inline-block; padding:2px 6px; border-radius: 4px; font-size: 10px; 
                                        {{ $location->status === 'active' ? 'background:#dcfce7; color:#166534;' : 'background:#f1f5f9; color:#475569;' }}">
                                        {{ $location->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </p>

                                @if ($location->gmaps_link)
                                    <p style="margin-top: 6px;">
                                        <a href="{{ e($location->gmaps_link) }}" target="_blank" style="color: #2563eb; text-decoration: none; display: inline-flex; align-items: center; font-size: 11px;">
                                            <i class="fas fa-map-pin" style="margin-right: 4px; font-size: 10px;"></i> Lihat di Google Maps
                                        </a>
                                    </p>
                                @endif
                            </div>
                        `);
                    @endforeach
                }

                // Tambah markers ke map yang aktif
                if (mapDesktop) {
                    addMarkersToMap(mapDesktop);
                }
                if (mapMobile) {
                    addMarkersToMap(mapMobile);
                }

                // Handle resize window
                window.addEventListener('resize', function() {
                    if (mapDesktop) {
                        setTimeout(() => mapDesktop.invalidateSize(), 100);
                    }
                    if (mapMobile) {
                        setTimeout(() => mapMobile.invalidateSize(), 100);
                    }
                });
            });

            // Global variables untuk layer toggle
            let visibleLayers = {
                pelayanan_publik: true,
                pendidikan: true,
                kesehatan: true,
                ekonomi: true
            };

            function toggleLayer(layerId) {
                // Toggle visibility state
                visibleLayers[layerId] = !visibleLayers[layerId];
                
                console.log(`Toggling layer ${layerId} to ${visibleLayers[layerId] ? 'visible' : 'hidden'}`);

                // Method 1: Toggle menggunakan marker references yang disimpan
                if (window.mapMarkers && window.mapMarkers[layerId]) {
                    window.mapMarkers[layerId].forEach(marker => {
                        if (visibleLayers[layerId]) {
                            marker.setOpacity(1);
                            if (marker._icon) {
                                marker._icon.style.display = 'block';
                                marker._icon.style.visibility = 'visible';
                            }
                        } else {
                            marker.setOpacity(0);
                            if (marker._icon) {
                                marker._icon.style.display = 'none';
                                marker._icon.style.visibility = 'hidden';
                            }
                        }
                    });
                }

                // Method 2: Toggle menggunakan DOM selector (fallback)
                const markers = document.querySelectorAll(`.marker-wrapper.${layerId}`);
                console.log(`Found ${markers.length} markers for layer ${layerId}`);
                
                markers.forEach(marker => {
                    // Find the closest leaflet marker container
                    const leafletMarker = marker.closest('.leaflet-marker-icon') || marker.parentElement;
                    if (leafletMarker) {
                        leafletMarker.style.display = visibleLayers[layerId] ? 'block' : 'none';
                        leafletMarker.style.visibility = visibleLayers[layerId] ? 'visible' : 'hidden';
                        leafletMarker.style.opacity = visibleLayers[layerId] ? '1' : '0';
                    }
                });

                // Update all toggle buttons for this layer
                const buttons = document.querySelectorAll(`button[onclick*="${layerId}"]`);
                buttons.forEach(button => {
                    const icon = button.querySelector('i[data-lucide]');
                    if (icon) {
                        // Update icon
                        icon.setAttribute('data-lucide', visibleLayers[layerId] ? 'eye' : 'eye-off');
                        
                        // Update button appearance
                        if (visibleLayers[layerId]) {
                            button.classList.remove('text-gray-400');
                            button.classList.add('text-gray-500', 'hover:text-primary');
                        } else {
                            button.classList.remove('text-gray-500', 'hover:text-primary');
                            button.classList.add('text-gray-400');
                        }
                        
                        // Re-render lucide icons
                        if (typeof lucide !== 'undefined') {
                            lucide.createIcons();
                        }
                    }
                });

                // Update category row appearance
                const categoryRows = document.querySelectorAll(`[data-layer="${layerId}"]`);
                categoryRows.forEach(row => {
                    if (visibleLayers[layerId]) {
                        row.classList.remove('opacity-50');
                    } else {
                        row.classList.add('opacity-50');
                    }
                });
            }
        </script>
    @endpush
@endsection