@extends('layouts.app')

@section('title', 'Berita Desa Mekar Sari')

@section('content')
<section class="py-20 bg-gray-50 pt-10">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-primary mb-4">Berita Desa</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Kumpulan berita dan informasi terbaru seputar desa Mekar Sari
            </p>
        </div>

        <!-- Category Filter -->
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <button onclick="filterBerita('all')" class="filter-btn bg-primary text-white px-6 py-3 rounded-full font-semibold transition-colors">
                Semua ({{ $categories['all'] }})
            </button>
            <button onclick="filterBerita('kesehatan')" class="filter-btn bg-white text-primary hover:bg-secondary hover:text-primary border border-gray-200 px-6 py-3 rounded-full font-semibold transition-colors">
                Kesehatan ({{ $categories['kesehatan'] }})
            </button>
            <button onclick="filterBerita('pembangunan')" class="filter-btn bg-white text-primary hover:bg-secondary hover:text-primary border border-gray-200 px-6 py-3 rounded-full font-semibold transition-colors">
                Pembangunan ({{ $categories['pembangunan'] }})
            </button>
            <button onclick="filterBerita('pendidikan')" class="filter-btn bg-white text-primary hover:bg-secondary hover:text-primary border border-gray-200 px-6 py-3 rounded-full font-semibold transition-colors">
                Pendidikan ({{ $categories['pendidikan'] }})
            </button>
        </div>

        <!-- Berita Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($berita as $berita)
            <div class="berita-item bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300" data-category="{{ $berita->category }}">
                <div class="relative group">
                    <img
                        src="{{ $berita->thumbnail ?? 'https://via.placeholder.com/400x200' }}"
                        alt="{{ $berita->title }}"
                        class="w-full h-48 object-cover"
                    />
                    <div class="absolute top-2 left-2">
                        <span class="px-2 py-1 rounded text-xs font-semibold 
                            @if($berita->category === 'kesehatan') bg-red-100 text-red-800
                            @elseif($berita->category === 'pembangunan') bg-yellow-100 text-yellow-800
                            @else bg-blue-100 text-blue-800
                            @endif">
                            {{ ucfirst($berita->category) }}
                        </span>
                    </div>
                </div>
                
                <div class="p-6">
                    <h3 class="text-lg font-bold text-primary mb-2 line-clamp-2">
                        {{ $berita->title }}
                    </h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                        {{ Str::limit(strip_tags($berita->content), 100) }}
                    </p>
                    
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <div class="flex items-center gap-1">
                            <i data-lucide="eye" class="w-4 h-4"></i>
                            <span>{{ number_format($berita->views) }} views</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <i data-lucide="calendar" class="w-4 h-4"></i>
                            <span>{{ $berita->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div id="no-berita" class="text-center py-12 hidden">
            <p class="text-gray-500">Tidak ada berita dalam kategori ini</p>
        </div>
    </div>
</section>

<script>
function filterBerita(category) {
    const beritaItems = document.querySelectorAll('.berita-item');
    const buttons = document.querySelectorAll('.filter-btn');
    const noBerita = document.getElementById('no-berita');
    
    buttons.forEach(btn => {
        btn.classList.remove('bg-primary', 'text-white');
        btn.classList.add('bg-white', 'text-primary', 'hover:bg-secondary', 'hover:text-primary', 'border', 'border-gray-200');
    });
    
    event.target.classList.remove('bg-white', 'text-primary');
    event.target.classList.add('bg-primary', 'text-white');

    let visibleCount = 0;
    beritaItems.forEach(item => {
        if (category === 'all' || item.dataset.category === category) {
            item.style.display = 'block';
            visibleCount++;
        } else {
            item.style.display = 'none';
        }
    });

    if (visibleCount === 0) {
        noBerita.classList.remove('hidden');
    } else {
        noBerita.classList.add('hidden');
    }
}
</script>
@endsection
