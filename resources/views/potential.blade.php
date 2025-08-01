@extends('layouts.app')

@section('title', 'Potensi & Produk Desa - Profil Digital Desa Wonokarang')

@section('content')
<section class="py-20 bg-white pt-10">
    <div class="container mx-auto px-4">

        {{-- === POTENSI DESA === --}}
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-primary mb-4">Potensi Desa</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Eksplorasi potensi unggulan yang dimiliki Desa Wonokarang
            </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-12 max-w-6xl mx-auto mb-24">
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

                    {{-- Statistik --}}
                    <div class="grid grid-cols-3 gap-4 p-4 bg-gray-50 rounded-lg mb-6">
                        @if($potential->category === 'pertanian')
                            <div class="text-center"><div class="text-lg font-bold text-primary">150 Ha</div><div class="text-sm text-gray-600">Luas Area</div></div>
                            <div class="text-center"><div class="text-lg font-bold text-primary">320 Petani</div><div class="text-sm text-gray-600">Petani</div></div>
                            <div class="text-center"><div class="text-lg font-bold text-primary">850 Ton/Tahun</div><div class="text-sm text-gray-600">Produksi</div></div>
                        @else
                            <div class="text-center"><div class="text-lg font-bold text-primary">75 Ha</div><div class="text-sm text-gray-600">Luas Area</div></div>
                            <div class="text-center"><div class="text-lg font-bold text-primary">180 Petani</div><div class="text-sm text-gray-600">Petani</div></div>
                            <div class="text-center"><div class="text-lg font-bold text-primary">2.5 Juta Batang/Tahun</div><div class="text-sm text-gray-600">Produksi</div></div>
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

        {{-- === PRODUK DESA === --}}
        <div class="text-center mb-10">
            <h2 class="text-4xl font-bold text-primary mb-4">Produk Desa</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Inilah hasil olahan dan karya warga desa yang siap jual!
            </p>
        </div>

        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 max-w-7xl mx-auto">
            @foreach($potentials as $potential)
                @foreach($potential->products as $product)
                <div class="bg-gray-100 rounded-xl overflow-hidden shadow hover:shadow-lg transition-shadow duration-300">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-600 mb-3">{{ Str::limit($product->description, 60) }}</p>
                        <a 
                            href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $product->whatsapp_number) }}" 
                            target="_blank" 
                            class="text-green-600 hover:text-green-800 text-sm font-semibold flex items-center gap-1"
                        >
                            <i data-lucide="message-circle" class="w-4 h-4"></i>
                            Hubungi Penjual
                        </a>
                    </div>
                </div>
                @endforeach
            @endforeach
        </div>

    </div>
</section>
@endsection
