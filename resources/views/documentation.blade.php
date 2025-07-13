@extends('layouts.app')

@section('title', 'Dokumentasi - Profil Digital Desa Mekar Sari')

@section('content')
<section class="py-20 bg-gray-50 pt-10">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-primary mb-4">Dokumentasi Video</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Kumpulan video dokumentasi kegiatan desa dalam bidang kesehatan, pemberdayaan perempuan, dan pertanian
            </p>
        </div>

        <!-- Category Filter -->
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <button onclick="filterVideos('all')" class="filter-btn bg-primary text-white px-6 py-3 rounded-full font-semibold transition-colors">
                Semua ({{ $categories['all'] }})
            </button>
            <button onclick="filterVideos('kesehatan')" class="filter-btn bg-white text-primary hover:bg-secondary hover:text-primary border border-gray-200 px-6 py-3 rounded-full font-semibold transition-colors">
                Kesehatan ({{ $categories['kesehatan'] }})
            </button>
            <button onclick="filterVideos('perempuan')" class="filter-btn bg-white text-primary hover:bg-secondary hover:text-primary border border-gray-200 px-6 py-3 rounded-full font-semibold transition-colors">
                Perempuan ({{ $categories['perempuan'] }})
            </button>
            <button onclick="filterVideos('pertanian')" class="filter-btn bg-white text-primary hover:bg-secondary hover:text-primary border border-gray-200 px-6 py-3 rounded-full font-semibold transition-colors">
                Pertanian ({{ $categories['pertanian'] }})
            </button>
        </div>

        <!-- Videos Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($videos as $video)
            <div class="video-item bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300" data-category="{{ $video->category }}">
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
                            @if($video->category === 'kesehatan') bg-red-100 text-red-800
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
                    
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <div class="flex items-center gap-1">
                            <i data-lucide="eye" class="w-4 h-4"></i>
                            <span>{{ number_format($video->views) }} views</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <i data-lucide="calendar" class="w-4 h-4"></i>
                            <span>{{ $video->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div id="no-videos" class="text-center py-12 hidden">
            <p class="text-gray-500">Tidak ada video dalam kategori ini</p>
        </div>
    </div>
</section>

<script>
function filterVideos(category) {
    const videos = document.querySelectorAll('.video-item');
    const buttons = document.querySelectorAll('.filter-btn');
    const noVideos = document.getElementById('no-videos');
    
    // Update button styles
    buttons.forEach(btn => {
        btn.classList.remove('bg-primary', 'text-white');
        btn.classList.add('bg-white', 'text-primary', 'hover:bg-secondary', 'hover:text-primary', 'border', 'border-gray-200');
    });
    
    event.target.classList.remove('bg-white', 'text-primary', 'hover:bg-secondary', 'hover:text-primary', 'border', 'border-gray-200');
    event.target.classList.add('bg-primary', 'text-white');
    
    // Filter videos
    let visibleCount = 0;
    videos.forEach(video => {
        if (category === 'all' || video.dataset.category === category) {
            video.style.display = 'block';
            visibleCount++;
        } else {
            video.style.display = 'none';
        }
    });
    
    // Show/hide no videos message
    if (visibleCount === 0) {
        noVideos.classList.remove('hidden');
    } else {
        noVideos.classList.add('hidden');
    }
}
</script>
@endsection