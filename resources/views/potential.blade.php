@extends('layouts.app')

@section('title', 'Potensi Desa - Profil Digital Desa Mekar Sari')

@section('content')
<section class="py-20 bg-white pt-32">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-primary mb-4">Potensi Desa</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Dua sektor unggulan yang menjadi kebanggaan dan sumber kemakmuran masyarakat Desa Mekar Sari
            </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-12 max-w-6xl mx-auto">
            @foreach($potentials as $potential)
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                <div class="relative h-64 overflow-hidden">
                    <img 
                        src="{{ $potential->image }}" 
                        alt="{{ $potential->title }}"
                        class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    <div class="absolute top-4 left-4 bg-white/20 backdrop-blur-sm rounded-full p-3">
                        @if($potential->category === 'pertanian')
                            <i data-lucide="leaf" class="w-12 h-12 text-green-600"></i>
                        @else
                            <i data-lucide="flower" class="w-12 h-12 text-pink-600"></i>
                        @endif
                    </div>
                </div>
                
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-primary mb-4">{{ $potential->title }}</h3>
                    <p class="text-gray-700 mb-6 leading-relaxed">{{ $potential->description }}</p>
                    
                    <div class="mb-6">
                        <h4 class="text-lg font-semibold text-primary mb-3">Keunggulan:</h4>
                        <div class="grid grid-cols-2 gap-2">
                            @if($potential->category === 'pertanian')
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <div class="w-2 h-2 bg-secondary rounded-full"></div>
                                    Sistem Irigasi Modern
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <div class="w-2 h-2 bg-secondary rounded-full"></div>
                                    Pupuk Organik
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <div class="w-2 h-2 bg-secondary rounded-full"></div>
                                    Teknologi Sensor
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <div class="w-2 h-2 bg-secondary rounded-full"></div>
                                    Hasil Panen 40% Lebih Tinggi
                                </div>
                            @else
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <div class="w-2 h-2 bg-secondary rounded-full"></div>
                                    Bunga Potong Premium
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <div class="w-2 h-2 bg-secondary rounded-full"></div>
                                    Tanaman Hias Eksotis
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <div class="w-2 h-2 bg-secondary rounded-full"></div>
                                    Kualitas Ekspor
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <div class="w-2 h-2 bg-secondary rounded-full"></div>
                                    Pasar Internasional
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-4 p-4 bg-gray-50 rounded-lg mb-6">
                        @if($potential->category === 'pertanian')
                            <div class="text-center">
                                <div class="text-lg font-bold text-primary">150 Ha</div>
                                <div class="text-sm text-gray-600">Luas Area</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-bold text-primary">320 Petani</div>
                                <div class="text-sm text-gray-600">Petani</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-bold text-primary">850 Ton/Tahun</div>
                                <div class="text-sm text-gray-600">Produksi</div>
                            </div>
                        @else
                            <div class="text-center">
                                <div class="text-lg font-bold text-primary">75 Ha</div>
                                <div class="text-sm text-gray-600">Luas Area</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-bold text-primary">180 Petani</div>
                                <div class="text-sm text-gray-600">Petani</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-bold text-primary">2.5 Juta Batang/Tahun</div>
                                <div class="text-sm text-gray-600">Produksi</div>
                            </div>
                        @endif
                    </div>
                    
                    <button class="w-full bg-secondary text-primary py-3 rounded-lg font-semibold hover:bg-yellow-400 transition-colors flex items-center justify-center gap-2 group">
                        Lihat Detail
                        <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection