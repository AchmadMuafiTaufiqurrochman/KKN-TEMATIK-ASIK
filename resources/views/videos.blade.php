@extends('layouts.app')

@section('title', 'Video - Profil Digital Desa Mekar Sari')

@section('content')
<section class="py-20 bg-gray-50 pt-32">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-primary mb-4">Video Desa Mekar Sari</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Kumpulan video profil dan dokumentasi kegiatan desa dalam berbagai bidang pembangunan
            </p>
        </div>

        <!-- Category Filter -->
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            @php
                $categories = [
                    'all' => 'Semua Video',
                    'profil' => 'Profil Desa',
                    'kesehatan' => 'Kesehatan',
                    'perempuan' => 'Perempuan',
                    'pertanian' => 'Pertanian'
                ];
                $currentCategory = request('category', 'all');
            @endphp
            
            @foreach($categories as $key => $label)
            <a href="{{ $key === 'all' ? route('videos') : route('videos', ['category' => $key]) }}" 
               class="px-6 py-3 rounded-full font-semibold transition-colors {{ $currentCategory === $key ? 'bg-primary text-white' : 'bg-white text-primary hover:bg-secondary hover:text-primary border border-gray-200' }}">
                {{ $label }}
            </a>
            @endforeach
        </div>

        <!-- Videos Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $videos = \App\Models\Video::where('status', 'published');
                if(request('category') && request('category') !== 'all') {
                    $videos->where('category', request('category'));
                }
                $videos = $videos->orderBy('created_at', 'desc')->get();
            @endphp

            @foreach($videos as $video)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="relative group">
                    <img
                        src="{{ $video->thumbnail }}"
                        alt="{{ $video->title }}"
                        class="w-full h-48 object-cover"
                    />
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                            <i data-lucide="play" class="w-8 h-8 text-white ml-1"></i>
                        </div>
                    </div>
                    <div class="absolute bottom-2 right-2 bg-black/70 text-white px-2 py-1 rounded text-sm">
                        {{ $video->duration }}
                    </div>
                    <div class="absolute top-2 left-2">
                        <span class="px-2 py-1 rounded text-xs font-semibold 
                            @if($video->category === 'profil') bg-blue-100 text-blue-800
                            @elseif($video->category === 'kesehatan') bg-red-100 text-red-800
                            @elseif($video->category === 'perempuan') bg-purple-100 text-purple-800
                            @else bg-green-100 text-green-800
                            @endif">
                            {{ ucfirst($video->category) }}
                        </span>
                    </div>
                </div>
                
                <div class="p-6">
                    <h3 class="text-lg font-bold text-primary mb-2 line-clamp-2">
                        {{ $video->title }}
                    </h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                        {{ $video->description }}
                    </p>
                    
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                        <div class="flex items-center gap-1">
                            <i data-lucide="eye" class="w-4 h-4"></i>
                            <span>{{ number_format($video->views) }} views</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <i data-lucide="calendar" class="w-4 h-4"></i>
                            <span>{{ $video->created_at->format('d M Y') }}</span>
                        </div>
                    </div>

                    <a href="{{ $video->video_url }}" target="_blank" class="w-full bg-secondary text-primary py-2 rounded-lg font-semibold hover:bg-yellow-400 transition-colors flex items-center justify-center gap-2">
                        <i data-lucide="play" class="w-4 h-4"></i>
                        <span>Tonton Video</span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        @if($videos->isEmpty())
        <div class="text-center py-12">
            <i data-lucide="video" class="w-16 h-16 text-gray-400 mx-auto mb-4"></i>
            <p class="text-gray-500 text-lg">Tidak ada video dalam kategori ini</p>
        </div>
        @endif
    </div>
</section>
@endsection