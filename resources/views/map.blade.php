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
                        <h3 class="text-lg font-bold text-primary mb-4">Layer Peta</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white">
                                        <i data-lucide="home" class="w-4 h-4"></i>
                                    </div>
                                    <div>
                                        <span class="text-gray-700 font-medium">Balai Desa</span>
                                        <div class="text-xs text-gray-500">{{ $locationTypes['balai'] }} lokasi</div>
                                    </div>
                                </div>
                                <button onclick="toggleLayer('balai')"
                                    class="text-gray-500 hover:text-primary transition-colors">
                                    <i data-lucide="eye" class="w-5 h-5"></i>
                                </button>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center text-white">
                                        <i data-lucide="leaf" class="w-4 h-4"></i>
                                    </div>
                                    <div>
                                        <span class="text-gray-700 font-medium">Pertanian</span>
                                        <div class="text-xs text-gray-500">{{ $locationTypes['pertanian'] }} lokasi</div>
                                    </div>
                                </div>
                                <button onclick="toggleLayer('pertanian')"
                                    class="text-gray-500 hover:text-primary transition-colors">
                                    <i data-lucide="eye" class="w-5 h-5"></i>
                                </button>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 bg-pink-600 rounded-full flex items-center justify-center text-white">
                                        <i data-lucide="flower" class="w-4 h-4"></i>
                                    </div>
                                    <div>
                                        <span class="text-gray-700 font-medium">Budidaya Bunga</span>
                                        <div class="text-xs text-gray-500">{{ $locationTypes['bunga'] }} lokasi</div>
                                    </div>
                                </div>
                                <button onclick="toggleLayer('bunga')"
                                    class="text-gray-500 hover:text-primary transition-colors">
                                    <i data-lucide="eye" class="w-5 h-5"></i>
                                </button>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center text-white">
                                        <i data-lucide="heart" class="w-4 h-4"></i>
                                    </div>
                                    <div>
                                        <span class="text-gray-700 font-medium">Posyandu</span>
                                        <div class="text-xs text-gray-500">{{ $locationTypes['posyandu'] }} lokasi</div>
                                    </div>
                                </div>
                                <button onclick="toggleLayer('posyandu')"
                                    class="text-gray-500 hover:text-primary transition-colors">
                                    <i data-lucide="eye" class="w-5 h-5"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                   

                    <!-- Statistics -->
                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <h3 class="text-lg font-bold text-primary mb-4">Statistik Lokasi</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Total Lokasi:</span>
                                <span class="font-semibold text-primary">{{ $locations->count() }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Area Pertanian:</span>
                                <span class="font-semibold text-green-600">{{ $locationTypes['pertanian'] }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Kebun Bunga:</span>
                                <span class="font-semibold text-pink-600">{{ $locationTypes['bunga'] }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Fasilitas Kesehatan:</span>
                                <span class="font-semibold text-red-600">{{ $locationTypes['posyandu'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @push('scripts')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    var map = L.map('map').setView([ -7.7956, 110.3695 ], 13);

    // Gunakan tile resmi Leaflet OSM
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    @foreach($locations as $location)
        var customIcon = L.divIcon({
            html: `
                <div class="{{ $location->type_color }} w-10 h-10 rounded-full flex items-center justify-center text-white shadow-lg hover:scale-110 transition-transform">
                    @if($location->type === 'balai')
                        <i data-lucide="home" class="w-5 h-5"></i>
                    @elseif($location->type === 'pertanian')
                        <i data-lucide="leaf" class="w-5 h-5"></i>
                    @elseif($location->type === 'bunga')
                        <i data-lucide="flower" class="w-5 h-5"></i>
                    @else
                        <i data-lucide="heart" class="w-5 h-5"></i>
                    @endif
                </div>
            `,
            className: "marker-wrapper",
            iconSize: [40, 40],
            iconAnchor: [20, 20]
        });

        L.marker([{{ $location->latitude }}, {{ $location->longitude }}], { icon: customIcon })
            .addTo(map)
            .bindPopup(`
                <div class="bg-white p-3 rounded-lg shadow-lg border text-sm min-w-48">
                    <h4 class="font-semibold text-primary mb-1">{{ $location->name }}</h4>
                    <p class="text-gray-600">{{ $location->description }}</p>
                </div>
            `);
    @endforeach
});
</script>
@endpush
    <script>
        let visibleLayers = {
            balai: true,
            pertanian: true,
            bunga: true,
            posyandu: true
        };

        function toggleLayer(layerId) {
            visibleLayers[layerId] = !visibleLayers[layerId];

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
