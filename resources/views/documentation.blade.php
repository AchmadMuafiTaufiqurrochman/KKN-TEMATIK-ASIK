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
                <!-- Visible Categories -->
                <div id="visible-categories" class="flex flex-wrap justify-center gap-4">
                    <button onclick="filterVideos('all')"
                        class="filter-btn bg-primary text-white px-4 py-2 rounded-full font-semibold transition-all duration-300 hover:shadow-md">
                        Semua ({{ $categories['all'] ?? 0 }})
                    </button>
                    <button onclick="filterVideos('kesehatan')"
                        class="filter-btn bg-white text-primary hover:bg-secondary hover:text-white border border-gray-300 px-4 py-2 rounded-full font-semibold transition-all duration-300 hover:shadow-md">
                        Kesehatan ({{ $categories['kesehatan'] ?? 0 }})
                    </button>
                    <button onclick="filterVideos('perempuan')"
                        class="filter-btn bg-white text-primary hover:bg-secondary hover:text-white border border-gray-300 px-4 py-2 rounded-full font-semibold transition-all duration-300 hover:shadow-md">
                        Perempuan ({{ $categories['perempuan'] ?? 0 }})
                    </button>
                    <button onclick="filterVideos('pertanian')"
                        class="filter-btn bg-white text-primary hover:bg-secondary hover:text-white border border-gray-300 px-4 py-2 rounded-full font-semibold transition-all duration-300 hover:shadow-md">
                        Pertanian ({{ $categories['pertanian'] ?? 0 }})
                    </button>
                    <button onclick="filterVideos('pemerintahan')"
                        class="filter-btn bg-white text-primary hover:bg-secondary hover:text-white border border-gray-300 px-4 py-2 rounded-full font-semibold transition-all duration-300 hover:shadow-md">
                        Pemerintahan Desa ({{ $categories['pemerintahan'] ?? 0 }})
                    </button>
                </div>

                <!-- Dropdown Toggle -->
                <div class="relative">
                    <button onclick="toggleMoreCategories()"
                        class="flex items-center gap-2 bg-gray-100 text-primary px-4 py-2 rounded-full font-semibold border border-gray-300 transition-all duration-300 hover:shadow-md">
                        Lainnya
                        <svg id="dropdown-icon" class="w-4 h-4 transition-transform duration-300 transform" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Hidden Categories Dropdown -->
                    <div id="more-categories"
                        class="absolute right-0 mt-2 hidden bg-white border border-gray-200 rounded-lg shadow-lg p-4 w-64 transition-all duration-300 ease-in-out z-20">
                        <button onclick="filterVideos('kegiatan')"
                            class="block w-full text-left text-primary hover:bg-gray-100 px-3 py-2 rounded-md transition-all duration-200">
                            Kegiatan Masyarakat ({{ $categories['kegiatan'] ?? 0 }})
                        </button>
                        <button onclick="filterVideos('pembangunan')"
                            class="block w-full text-left text-primary hover:bg-gray-100 px-3 py-2 rounded-md transition-all duration-200">
                            Pembangunan ({{ $categories['pembangunan'] ?? 0 }})
                        </button>
                        <button onclick="filterVideos('pengumuman')"
                            class="block w-full text-left text-primary hover:bg-gray-100 px-3 py-2 rounded-md transition-all duration-200">
                            Pengumuman ({{ $categories['pengumuman'] ?? 0 }})
                        </button>
                        <button onclick="filterVideos('berita')"
                            class="block w-full text-left text-primary hover:bg-gray-100 px-3 py-2 rounded-md transition-all duration-200">
                            Berita Umum ({{ $categories['berita'] ?? 0 }})
                        </button>
                        <button onclick="filterVideos('umkm')"
                            class="block w-full text-left text-primary hover:bg-gray-100 px-3 py-2 rounded-md transition-all duration-200">
                            UMKM ({{ $categories['umkm'] ?? 0 }})
                        </button>
                        <button onclick="filterVideos('karangtaruna')"
                            class="block w-full text-left text-primary hover:bg-gray-100 px-3 py-2 rounded-md transition-all duration-200">
                            Karang Taruna ({{ $categories['karangtaruna'] ?? 0 }})
                        </button>
                    </div>
                </div>
            </div>


            <!-- Videos Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($videos as $video)
                    <div class="video-item bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300"
                        data-category="{{ $video->category }}">
                        <div class="relative group">
                            <img src="{{ $video->thumbnail }}" alt="{{ $video->title }}"
                                class="w-full h-48 object-cover" />
                            <div
                                class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <div
                                    class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                                    <i data-lucide="play" class="w-8 h-8 text-white ml-1"></i>
                                </div>
                            </div>
                            <div class="absolute bottom-2 right-2 bg-black/70 text-white px-2 py-1 rounded text-sm">
                                {{ $video->duration }}
                            </div>
                            <div class="absolute top-2 left-2">
                                <span
                                    class="px-2 py-1 rounded text-xs font-semibold 
                            @if ($video->category === 'kesehatan') bg-red-100 text-red-800
                            @elseif($video->category === 'perempuan') bg-purple-100 text-purple-800
                            @else bg-green-100 text-green-800 @endif">
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
                btn.classList.add('bg-white', 'text-primary', 'hover:bg-secondary', 'hover:text-primary', 'border',
                    'border-gray-200');
            });

            event.target.classList.remove('bg-white', 'text-primary', 'hover:bg-secondary', 'hover:text-primary', 'border',
                'border-gray-200');
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

        function toggleMoreCategories() {
            const dropdown = document.getElementById('more-categories');
            const icon = document.getElementById('dropdown-icon');
            const isHidden = dropdown.classList.contains('hidden');

            if (isHidden) {
                dropdown.classList.remove('hidden');
                icon.classList.add('rotate-180');
            } else {
                dropdown.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
        }

        // Optional: Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('more-categories');
            const button = event.target.closest('button[onclick="toggleMoreCategories()"]');

            if (!button && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
                document.getElementById('dropdown-icon').classList.remove('rotate-180');
            }
        });
    </script>
@endsection
