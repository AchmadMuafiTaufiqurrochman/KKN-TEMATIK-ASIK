@extends('layouts.app')

@section('title', 'Peta Desa - Profil Digital Desa Mekar Sari')

@section('content')
<section class="py-20 bg-white pt-32">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-primary mb-4">Peta Interaktif Desa</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Jelajahi lokasi-lokasi penting di Desa Mekar Sari dengan peta interaktif yang menampilkan fasilitas dan area strategis
            </p>
        </div>

        <div class="grid lg:grid-cols-4 gap-8">
            <!-- Map Area -->
            <div class="lg:col-span-3">
                <div class="bg-gray-100 rounded-xl overflow-hidden shadow-lg">
                    <div id="map" class="h-96 lg:h-[500px] relative bg-gradient-to-br from-green-100 to-blue-100">
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
                        <div class="absolute transform -translate-x-1/2 -translate-y-1/2 group cursor-pointer location-marker" 
                             data-type="{{ $location->type }}"
                             style="left: {{ 50 + ($location->longitude - 110.3695) * 2000 }}%; top: {{ 50 + ($location->latitude + 7.7956) * 2000 }}%;">
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
                            
                            <!-- Tooltip -->
                            <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <div class="bg-white p-3 rounded-lg shadow-lg border text-sm min-w-48">
                                    <h4 class="font-semibold text-primary mb-1">{{ $location->name }}</h4>
                                    <p class="text-gray-600">{{ $location->description }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <!-- Map Controls -->
                        <div class="absolute top-4 right-4 flex flex-col gap-2">
                            <button class="bg-white p-2 rounded-lg shadow-lg hover:bg-gray-50 transition-colors">
                                <i data-lucide="navigation" class="w-5 h-5 text-gray-600"></i>
                            </button>
                        </div>
                    </div>

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
                                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white">
                                    <i data-lucide="home" class="w-4 h-4"></i>
                                </div>
                                <div>
                                    <span class="text-gray-700 font-medium">Balai Desa</span>
                                    <div class="text-xs text-gray-500">{{ $locationTypes['balai'] }} lokasi</div>
                                </div>
                            </div>
                            <button onclick="toggleLayer('balai')" class="text-gray-500 hover:text-primary transition-colors">
                                <i data-lucide="eye" class="w-5 h-5"></i>
                            </button>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center text-white">
                                    <i data-lucide="leaf" class="w-4 h-4"></i>
                                </div>
                                <div>
                                    <span class="text-gray-700 font-medium">Pertanian</span>
                                    <div class="text-xs text-gray-500">{{ $locationTypes['pertanian'] }} lokasi</div>
                                </div>
                            </div>
                            <button onclick="toggleLayer('pertanian')" class="text-gray-500 hover:text-primary transition-colors">
                                <i data-lucide="eye" class="w-5 h-5"></i>
                            </button>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-pink-600 rounded-full flex items-center justify-center text-white">
                                    <i data-lucide="flower" class="w-4 h-4"></i>
                                </div>
                                <div>
                                    <span class="text-gray-700 font-medium">Budidaya Bunga</span>
                                    <div class="text-xs text-gray-500">{{ $locationTypes['bunga'] }} lokasi</div>
                                </div>
                            </div>
                            <button onclick="toggleLayer('bunga')" class="text-gray-500 hover:text-primary transition-colors">
                                <i data-lucide="eye" class="w-5 h-5"></i>
                            </button>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center text-white">
                                    <i data-lucide="heart" class="w-4 h-4"></i>
                                </div>
                                <div>
                                    <span class="text-gray-700 font-medium">Posyandu</span>
                                    <div class="text-xs text-gray-500">{{ $locationTypes['posyandu'] }} lokasi</div>
                                </div>
                            </div>
                            <button onclick="toggleLayer('posyandu')" class="text-gray-500 hover:text-primary transition-colors">
                                <i data-lucide="eye" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Location List -->
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <h3 class="text-lg font-bold text-primary mb-4">Daftar Lokasi</h3>
                    <div class="space-y-3 max-h-60 overflow-y-auto">
                        @foreach($locations as $location)
                        <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors location-item" data-type="{{ $location->type }}">
                            <div class="{{ $location->type_color }} w-6 h-6 rounded-full flex items-center justify-center text-white flex-shrink-0">
                                @if($location->type === 'balai')
                                    <i data-lucide="home" class="w-3 h-3"></i>
                                @elseif($location->type === 'pertanian')
                                    <i data-lucide="leaf" class="w-3 h-3"></i>
                                @elseif($location->type === 'bunga')
                                    <i data-lucide="flower" class="w-3 h-3"></i>
                                @else
                                    <i data-lucide="heart" class="w-3 h-3"></i>
                                @endif
                            </div>
                            <div>
                                <h4 class="font-medium text-primary text-sm">{{ $location->name }}</h4>
                                <p class="text-gray-600 text-xs mt-1">{{ $location->description }}</p>
                            </div>
                        </div>
                        @endforeach
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