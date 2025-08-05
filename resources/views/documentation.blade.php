@extends('layouts.app')

@section('title', 'Berita - Profil Digital Desa Wonokarang')

@section('content')
    <section class="py-20 bg-gray-50 pt-10">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-primary mb-4">Berita</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Kumpulan berita terkini seputar kegiatan desa dalam bidang kesehatan, pemberdayaan perempuan, dan
                    pertanian
                </p>
            </div>

            <!-- Kategori Filter -->
            <div class="flex flex-wrap justify-center gap-4 mb-12 relative">
                <div id="visible-categories" class="flex flex-wrap justify-center gap-4">
                    @foreach (['all', 'kesehatan', 'ekonomi', 'pertanian', 'pemerintahan'] as $cat)
                        <button onclick="filterVideos('{{ $cat }}')"
                            class="filter-btn {{ $cat === 'all' ? 'bg-primary text-white' : 'bg-white text-primary hover:bg-secondary hover:text-white' }} border border-gray-300 px-4 py-2 rounded-full font-semibold transition-all duration-300 hover:shadow-md">
                            {{ ucfirst($cat) }} ({{ $categories[$cat] ?? 0 }})
                        </button>
                    @endforeach
                </div>

                <div class="relative">
                    <button onclick="toggleMoreCategories()"
                        class="flex items-center gap-2 bg-gray-100 text-primary px-4 py-2 rounded-full font-semibold border border-gray-300 transition-all duration-300 hover:shadow-md">
                        Lainnya
                        <svg id="dropdown-icon" class="w-4 h-4 transition-transform duration-300 transform" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="more-categories"
                        class="absolute right-0 mt-2 hidden bg-white border border-gray-200 rounded-lg shadow-lg p-4 w-64 transition-all duration-300 ease-in-out z-20">
                        @foreach (['kegiatan', 'pembangunan', 'pengumuman', 'berita', 'umkm', 'karangtaruna'] as $cat)
                            <button onclick="filterVideos('{{ $cat }}')"
                                class="block w-full text-left text-primary hover:bg-gray-100 px-3 py-2 rounded-md transition-all duration-200">
                                {{ ucfirst($cat) }} ({{ $categories[$cat] ?? 0 }})
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Videos Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                @foreach ($videos as $video)
                    <a href="{{ route('berita.detail', $video->id) }}"
                        onclick="sessionStorage.setItem('highlightedId', {{ $video->id }})"
                        class="video-item block bg-white rounded-xl shadow-lg overflow-hidden transition-shadow duration-300"
                        data-id="{{ $video->id }}" data-category="{{ $video->category }}">

                        <div class="relative group">
                            <img src="{{ asset($video->thumbnail) }}" alt="{{ $video->title }}"
                                class="w-full h-48 object-cover" />

                            <div
                                class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                @if ($video->type === 'video')
                                    <i data-lucide="play" class="w-8 h-8 text-white ml-1"></i>
                                @else
                                    <i data-lucide="image" class="w-8 h-8 text-white"></i>
                                @endif
                            </div>

                            <div class="absolute bottom-2 right-2 bg-black/70 text-white px-2 py-1 rounded text-sm">
                                {{ $video->duration }}
                            </div>

                            <div class="absolute top-2 left-2 max-w-[50%] sm:max-w-full">
                                <span
                                    class="px-2 py-0.5 rounded text-[10px] sm:text-xs font-semibold whitespace-nowrap
        @if ($video->category === 'kesehatan') bg-red-100 text-red-800
        @elseif($video->category === 'ekonomi') bg-purple-100 text-purple-800
        @else bg-green-100 text-green-800 @endif">
                                    {{ ucfirst($video->category) }}
                                </span>
                            </div>

                            <div class="absolute top-2 right-2 max-w-[50%] sm:max-w-full text-right">
                                @if ($video->is_finished)
                                    <span
                                        class="inline-block px-2 py-0.5 text-[10px] sm:text-xs bg-green-100 text-green-800 rounded whitespace-nowrap">Selesai</span>
                                @else
                                    <span
                                        class="inline-block px-2 py-0.5 text-[10px] sm:text-xs bg-yellow-100 text-yellow-800 rounded whitespace-nowrap">Akan
                                        Dimulai</span>
                                @endif
                            </div>
                        </div>

                        <div class="p-4">
                            <h3 class="text-sm font-bold text-primary mb-1 line-clamp-2">
                                {{ $video->title }}
                            </h3>
                            <div class="text-gray-600 text-xs mb-2 line-clamp-2">
                                {!! $video->description !!}
                            </div>

                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <div class="flex items-center gap-1">
                                    <i data-lucide="eye" class="w-3 h-3"></i>
                                    <span>{{ number_format($video->views) }} views</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <i data-lucide="calendar" class="w-3 h-3"></i>
                                    <span>
                                        {{ $video->started_at ? \Carbon\Carbon::parse($video->started_at)->translatedFormat('d M Y') : 'Belum ada tanggal' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
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

            buttons.forEach(btn => {
                btn.classList.remove('bg-primary', 'text-white');
                btn.classList.add('bg-white', 'text-primary', 'hover:bg-secondary', 'hover:text-primary', 'border',
                    'border-gray-200');
            });

            event.target.classList.remove('bg-white', 'text-primary', 'hover:bg-secondary', 'hover:text-primary', 'border',
                'border-gray-200');
            event.target.classList.add('bg-primary', 'text-white');

            let visibleCount = 0;
            videos.forEach(video => {
                if (category === 'all' || video.dataset.category === category) {
                    video.style.display = 'block';
                    visibleCount++;
                } else {
                    video.style.display = 'none';
                }
            });

            noVideos.classList.toggle('hidden', visibleCount !== 0);
        }

        function toggleMoreCategories() {
            const dropdown = document.getElementById('more-categories');
            const icon = document.getElementById('dropdown-icon');
            const isHidden = dropdown.classList.contains('hidden');

            dropdown.classList.toggle('hidden', !isHidden);
            icon.classList.toggle('rotate-180', isHidden);
        }

        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('more-categories');
            const button = event.target.closest('button[onclick="toggleMoreCategories()"]');

            if (!button && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
                document.getElementById('dropdown-icon').classList.remove('rotate-180');
            }
        });

        lucide.createIcons();
    </script>
@endsection
