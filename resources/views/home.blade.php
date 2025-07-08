@extends('layouts.app')

@section('title', 'Beranda - Profil Digital Desa Mekar Sari')

@section('content')
<!-- Hero Section -->
<section class="relative h-screen flex items-center justify-center overflow-hidden">
    <div 
        class="absolute inset-0 bg-cover bg-center"
        style="background-image: url('https://images.pexels.com/photos/1595108/pexels-photo-1595108.jpeg?auto=compress&cs=tinysrgb&w=1600')"
    ></div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
    
    <div class="relative z-10 text-center text-white max-w-4xl mx-auto px-4">
        <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
            Selamat Datang di <br />
            <span class="text-secondary">Desa Mekar Sari</span>
        </h1>
        
        <p class="text-xl md:text-2xl mb-8 max-w-2xl mx-auto leading-relaxed">
            Menjadi Sentra Budidaya Bunga & Pertanian Unggul dengan Teknologi Modern
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-12">
            <a href="{{ route('about') }}" class="bg-secondary text-primary px-8 py-4 rounded-lg font-semibold hover:bg-yellow-400 transition-colors flex items-center gap-2 group">
                Lihat Profil Desa
                <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
            </a>
            
            <a href="{{ route('potential') }}" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-primary transition-colors">
                Jelajahi Potensi
            </a>
        </div>
        
        <div class="flex flex-wrap justify-center gap-8 md:gap-12">
            <div class="flex items-center gap-2 text-center">
                <i data-lucide="users" class="w-8 h-8 text-secondary"></i>
                <div>
                    <div class="text-2xl font-bold">{{ number_format($stats['total_villagers']) }}</div>
                    <div class="text-sm opacity-90">Warga</div>
                </div>
            </div>
            
            <div class="flex items-center gap-2 text-center">
                <i data-lucide="leaf" class="w-8 h-8 text-secondary"></i>
                <div>
                    <div class="text-2xl font-bold">150 Ha</div>
                    <div class="text-sm opacity-90">Lahan Pertanian</div>
                </div>
            </div>
            
            <div class="flex items-center gap-2 text-center">
                <i data-lucide="map-pin" class="w-8 h-8 text-secondary"></i>
                <div>
                    <div class="text-2xl font-bold">{{ $stats['total_rt'] }} RT</div>
                    <div class="text-sm opacity-90">Rukun Tetangga</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Preview -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-primary mb-4">Tentang Desa Mekar Sari</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Desa yang berdiri sejak tahun 1945, kini menjadi salah satu sentra budidaya bunga dan pertanian terbaik
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-12 items-center mb-12">
                <div>
                    <p class="text-gray-700 mb-6 leading-relaxed">
                        Desa Mekar Sari didirikan pada tahun 1945 oleh para transmigran yang ingin membangun kehidupan baru. 
                        Dengan tanah yang subur dan iklim yang mendukung, desa ini berkembang menjadi pusat pertanian dan budidaya bunga.
                    </p>
                    <a href="{{ route('about') }}" class="bg-secondary text-primary px-6 py-3 rounded-lg font-semibold hover:bg-yellow-400 transition-colors inline-flex items-center gap-2">
                        Selengkapnya
                        <i data-lucide="arrow-right" class="w-5 h-5"></i>
                    </a>
                </div>

                <div class="flex flex-col items-center">
                    <div class="w-64 h-64 rounded-full overflow-hidden mb-6 border-4 border-secondary">
                        <img 
                            src="https://images.pexels.com/photos/1300402/pexels-photo-1300402.jpeg?auto=compress&cs=tinysrgb&w=500" 
                            alt="Kepala Desa"
                            class="w-full h-full object-cover"
                        />
                    </div>
                    <h4 class="text-xl font-bold text-primary mb-2">Bapak Sutrisno</h4>
                    <p class="text-gray-600">Kepala Desa Mekar Sari</p>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                    <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="target" class="w-8 h-8 text-white"></i>
                    </div>
                    <h4 class="text-xl font-bold text-primary mb-4">Misi Desa</h4>
                    <p class="text-gray-600">
                        Mengembangkan potensi pertanian dan budidaya bunga dengan teknologi modern
                    </p>
                </div>

                <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                    <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="eye" class="w-8 h-8 text-white"></i>
                    </div>
                    <h4 class="text-xl font-bold text-primary mb-4">Visi Desa</h4>
                    <p class="text-gray-600">
                        Menjadi desa mandiri, sejahtera, dan berkelanjutan melalui pengembangan sektor pertanian
                    </p>
                </div>

                <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                    <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="award" class="w-8 h-8 text-white"></i>
                    </div>
                    <h4 class="text-xl font-bold text-primary mb-4">Prestasi</h4>
                    <p class="text-gray-600">
                        Meraih berbagai penghargaan tingkat kabupaten dan provinsi untuk inovasi pertanian
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Potential Preview -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-primary mb-4">Potensi Unggulan</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Dua sektor unggulan yang menjadi kebanggaan dan sumber kemakmuran masyarakat
            </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-12 max-w-4xl mx-auto">
            @foreach($potentials as $potential)
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="relative h-48">
                    <img 
                        src="{{ $potential->image }}" 
                        alt="{{ $potential->title }}"
                        class="w-full h-full object-cover"
                    />
                    <div class="absolute top-4 left-4 bg-white/20 backdrop-blur-sm rounded-full p-3">
                        @if($potential->category === 'pertanian')
                            <i data-lucide="leaf" class="w-8 h-8 text-green-600"></i>
                        @else
                            <i data-lucide="flower" class="w-8 h-8 text-pink-600"></i>
                        @endif
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-primary mb-3">{{ $potential->title }}</h3>
                    <p class="text-gray-700 mb-4">
                        {{ Str::limit($potential->description, 100) }}
                    </p>
                    <a href="{{ route('potential') }}" class="text-secondary font-semibold hover:text-yellow-600 transition-colors inline-flex items-center gap-2">
                        Lihat Detail
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('potential') }}" class="bg-primary text-white px-8 py-4 rounded-lg font-semibold hover:bg-blue-800 transition-colors inline-flex items-center gap-2">
                Lihat Semua Potensi
                <i data-lucide="arrow-right" class="w-5 h-5"></i>
            </a>
        </div>
    </div>
</section>

<!-- Video Preview -->
@if($featured_video)
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-primary mb-4">Video Profil Desa</h2>
            <p class="text-xl text-gray-600">
                Saksikan keindahan dan potensi Desa Mekar Sari
            </p>
        </div>

        <div class="max-w-3xl mx-auto">
            <div class="relative group cursor-pointer">
                <img 
                    src="{{ $featured_video->thumbnail }}" 
                    alt="Video Thumbnail"
                    class="w-full h-64 lg:h-80 object-cover rounded-xl"
                />
                <div class="absolute inset-0 bg-black/40 rounded-xl flex items-center justify-center group-hover:bg-black/50 transition-colors">
                    <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                        <i data-lucide="play" class="w-10 h-10 text-white ml-1"></i>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-8">
                <a href="{{ route('video-profile') }}" class="bg-secondary text-primary px-8 py-4 rounded-lg font-semibold hover:bg-yellow-400 transition-colors inline-flex items-center gap-2">
                    Tonton Video Lengkap
                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </a>
            </div>
        </div>
    </div>
</section>
@endif
@endsection