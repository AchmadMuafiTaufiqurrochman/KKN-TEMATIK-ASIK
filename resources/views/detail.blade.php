@extends('layouts.app')

@section('title', $highlighted->title)

@section('content')

    @php
        function getEmbedCode($url)
        {
            // YouTube → 16:9
            if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
                preg_match('/(youtu\.be\/|v=)([^&]+)/', $url, $matches);
                $videoId = $matches[2] ?? '';
                return "
    <div class='flex justify-center w-full max-w-[800px] aspect-[16/9]'>
        <iframe class='w-full h-full rounded-lg' src='https://www.youtube.com/embed/{$videoId}' frameborder='0' allowfullscreen></iframe>
    </div>";
            }
            // Instagram → 1:1
            elseif (strpos($url, 'instagram.com') !== false) {
                return "
    <div class='flex justify-center'>
        <blockquote class='instagram-media' data-instgrm-permalink='{$url}' data-instgrm-version='14'></blockquote>
    </div>
    <script async src='//www.instagram.com/embed.js'></script>";
            }
            // TikTok → sama ukuran dengan Instagram
            elseif (strpos($url, 'tiktok.com') !== false) {
                // Extract TikTok video ID
                preg_match('/tiktok\.com\/.*\/video\/(\d+)/', $url, $matches);
                $videoId = $matches[1] ?? '';

                return "
    <div class='flex justify-center'>
        <blockquote class='tiktok-embed' cite='{$url}' data-video-id='{$videoId}' style='max-width: 605px;min-width: 325px;'>
            <section>
                <a target='_blank' title='@username' href='{$url}'>Video TikTok</a>
            </section>
        </blockquote>
    </div>
    <script async src='https://www.tiktok.com/embed.js'></script>";
            }
            // Facebook → sama ukuran dengan Instagram
            elseif (strpos($url, 'facebook.com') !== false || strpos($url, 'fb.watch') !== false) {
                // Convert fb.watch to facebook.com format if needed
                $facebookUrl = str_replace('fb.watch/', 'facebook.com/watch/?v=', $url);

                return "
    <div class='flex justify-center'>
        <div class='fb-video' data-href='{$facebookUrl}' data-width='500' data-show-text='false'>
            <blockquote cite='{$facebookUrl}' class='fb-xfbml-parse-ignore'>
                <a href='{$facebookUrl}'>Video Facebook</a>
            </blockquote>
        </div>
    </div>
    <div id='fb-root'></div>
    <script async defer crossorigin='anonymous' src='https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v18.0'>
    </script>";
            }

            return '<p>Video tidak dapat ditampilkan. Platform tidak dikenali.</p>';
        }
    @endphp


    <section class="py-20 bg-gray-50 pt-10">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-6">
                <a href="{{ route('documentation') }}" class="text-primary hover:text-blue-800 font-medium transition-colors">
                    ← Kembali
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-xl p-6 mb-16">
                <div class="flex flex-col lg:flex-row gap-8">
                    <div class="lg:w-1/2">
                        @if ($highlighted->type === 'video')
                            <div class="rounded overflow-hidden">
                                {!! getEmbedCode($highlighted->video_url) !!}
                            </div>
                        @else
                            @if (Str::startsWith($highlighted->thumbnail, ['http://', 'https://']))
                                <img src="{{ $highlighted->thumbnail }}" alt="{{ $highlighted->title }}"
                                    class="rounded-lg w-full">
                            @else
                                <img src="{{ asset('storage/' . $highlighted->thumbnail) }}" alt="{{ $highlighted->title }}"
                                    class="rounded-lg w-full">
                            @endif

                        @endif
                    </div>
                    <div class="lg:w-1/2">
                        <div class="mb-4 space-y-1 flex flex-wrap items-center gap-2">
                            @if ($highlighted->is_finished)
                                <span
                                    class="inline-block px-3 py-1 text-xs bg-green-100 text-green-800 rounded-full">Selesai</span>
                            @else
                                <span class="inline-block px-3 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">Akan
                                    Dimulai</span>
                            @endif

                            <span
                                class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                                @if ($highlighted->category === 'kesehatan') bg-red-100 text-red-800
                                @elseif ($highlighted->category === 'ekonomi') bg-purple-100 text-purple-800
                                @elseif ($highlighted->category === 'pertanian') bg-green-100 text-green-800
                                @elseif ($highlighted->category === 'pemerintahan') bg-blue-100 text-blue-800
                                @else bg-yellow-100 text-yellow-800 @endif">
                                {{ ucfirst($highlighted->category) }}
                            </span>
                        </div>

                        <h1 class="text-3xl font-bold text-primary mb-4">{{ $highlighted->title }}</h1>
                        <div class="prose max-w-none break-words">
                            {!! $highlighted->description !!}
                        </div><br>

                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <div class="flex items-center gap-1">
                                <i data-lucide="eye" class="w-3 h-3"></i>
                                <span>{{ number_format($highlighted->views) }} views</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <i data-lucide="calendar" class="w-3 h-3"></i>
                                <span>
                                    {{ $highlighted->started_at ? \Carbon\Carbon::parse($highlighted->started_at)->translatedFormat('d M Y') : 'Belum ada tanggal' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h2 class="text-xl font-semibold mb-6 text-primary">
                Berita Lainnya
                @if($selectedCategory !== 'semua')
                    - {{ ucfirst($selectedCategory) }}
                @endif
                @if($search)
                    - "{{ $search }}"
                @endif
                ({{ $beritas->total() }} hasil)
            </h2>
            <!-- Search and Filter Section -->
            <div class="mb-6 space-y-4">
                <!-- Search Form -->
                <form method="GET" action="{{ route('berita.detail', $highlighted->id) }}" class="w-full">
                    <input type="hidden" name="category" value="{{ $selectedCategory }}">
                    <div class="relative w-full max-w-md mx-auto lg:mx-0">
                        <input type="text" name="search" value="{{ $search ?? '' }}"
                            placeholder="Cari berita..."
                            class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-sm">
                        <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-primary transition-colors">
                            <i data-lucide="search" class="w-5 h-5"></i>
                        </button>
                    </div>
                </form>

                <!-- Category Filter -->
                <div class="flex flex-wrap gap-2 justify-center lg:justify-start">
                    @foreach(['semua', 'profil', 'kesehatan', 'ekonomi', 'pertanian', 'pemerintahan'] as $cat)
                        <a href="{{ route('berita.detail', $highlighted->id) }}?category={{ $cat }}{{ $search ? '&search=' . $search : '' }}"
                           class="px-3 py-2 rounded-lg text-xs sm:text-sm font-medium transition-colors border {{ $selectedCategory === $cat ? 'bg-primary text-white border-primary' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50 hover:border-primary' }}">
                            {{ ucfirst($cat === 'semua' ? 'Semua' : $cat) }} ({{ $categories[$cat] ?? 0 }})
                        </a>
                    @endforeach

                    <!-- Dropdown for more categories -->
                    <div class="relative">
                        <button onclick="toggleMoreCategories()"
                            class="flex items-center gap-1 px-3 py-2 rounded-lg text-xs sm:text-sm font-medium bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 hover:border-primary transition-colors">
                            Lainnya
                            <svg id="dropdown-icon" class="w-3 h-3 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div id="more-categories" class="absolute right-0 top-full mt-1 hidden bg-white border border-gray-200 rounded-lg shadow-lg p-2 w-48 z-10">
                            @foreach(['pembangunan', 'kegiatan', 'pengumuman', 'berita', 'umkm', 'karangtaruna', 'budidayabunga'] as $cat)
                                <a href="{{ route('berita.detail', $highlighted->id) }}?category={{ $cat }}{{ $search ? '&search=' . $search : '' }}"
                                   class="block w-full text-left px-3 py-2 rounded text-xs sm:text-sm transition-colors {{ $selectedCategory === $cat ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                                    {{ ucfirst($cat) }} ({{ $categories[$cat] ?? 0 }})
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="grid grid-cols-2 xs:grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
                @forelse ($beritas as $video)
                    <a href="{{ route('berita.detail', $video->id) }}"
                        class="block bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden"
                        data-category="{{ $video->category }}">
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="{{ $video->title }}"
                                class="w-full h-40 sm:h-48 object-cover">
                            <div class="absolute bottom-2 right-2 bg-black/70 text-white text-xs px-2 py-1 rounded">
                                {{ $video->duration }}
                            </div>
                            <div class="absolute top-2 left-2 max-w-[70%]">
                                <span
                                    class="px-2 py-1 rounded text-xs font-semibold block truncate
                                    @if ($video->category === 'kesehatan') bg-red-100 text-red-800
                                    @elseif($video->category === 'ekonomi') bg-purple-100 text-purple-800
                                    @else bg-green-100 text-green-800 @endif">
                                    {{ ucfirst($video->category) }}
                                </span>
                            </div>
                            <div class="absolute top-2 right-2">
                                @if ($video->is_finished)
                                    <span
                                        class="inline-block px-2 py-1 text-xs bg-green-100 text-green-800 rounded">Selesai</span>
                                @else
                                    <span class="inline-block px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded">Akan
                                        Dimulai</span>
                                @endif
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-sm sm:text-base font-semibold text-primary mb-2 line-clamp-2">
                                {{ $video->title }}</h3>
                            <p class="text-xs sm:text-sm text-gray-600 line-clamp-2 break-words">
                                {{ \Illuminate\Support\Str::limit(strip_tags($video->description), 80, '...') }}
                            </p>
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
                @empty
                    <div class="col-span-full text-center py-12">
                        <div class="text-gray-500">
                            <i data-lucide="search-x" class="w-16 h-16 mx-auto mb-4 text-gray-300"></i>
                            <h3 class="text-lg font-semibold mb-2">Tidak ada berita ditemukan</h3>
                            <p class="text-sm">
                                @if($search && $selectedCategory !== 'semua')
                                    Tidak ada berita dalam kategori "{{ ucfirst($selectedCategory) }}" dengan kata kunci "{{ $search }}"
                                @elseif($search)
                                    Tidak ada berita dengan kata kunci "{{ $search }}"
                                @elseif($selectedCategory !== 'semua')
                                    Tidak ada berita dalam kategori "{{ ucfirst($selectedCategory) }}"
                                @else
                                    Belum ada berita yang tersedia
                                @endif
                            </p>
                            <a href="{{ route('berita.detail', $highlighted->id) }}"
                               class="inline-block mt-4 px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-800 transition-colors">
                                Lihat Semua Berita
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            @if ($beritas->hasPages())
                <div class="mt-10 flex flex-col items-center justify-center gap-2 text-sm text-gray-600">
                    <div class="flex gap-2 items-center flex-wrap justify-center">
                        @if ($beritas->onFirstPage())
                            <span
                                class="px-3 py-1 rounded border border-gray-300 bg-gray-100 text-gray-400 cursor-not-allowed">←
                                Prev</span>
                        @else
                            <a href="{{ $beritas->previousPageUrl() }}"
                                class="px-3 py-1 rounded border border-gray-300 hover:bg-primary hover:text-white transition">←
                                Prev</a>
                        @endif

                        @foreach ($beritas->getUrlRange(1, $beritas->lastPage()) as $page => $url)
                            @if ($page == $beritas->currentPage())
                                <span
                                    class="px-3 py-1 rounded border bg-primary text-white font-semibold">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}"
                                    class="px-3 py-1 rounded border border-gray-300 hover:bg-primary hover:text-white transition">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if ($beritas->hasMorePages())
                            <a href="{{ $beritas->nextPageUrl() }}"
                                class="px-3 py-1 rounded border border-gray-300 hover:bg-primary hover:text-white transition">Next
                                →</a>
                        @else
                            <span
                                class="px-3 py-1 rounded border border-gray-300 bg-gray-100 text-gray-400 cursor-not-allowed">Next
                                →</span>
                        @endif
                    </div>
                    <div class="mt-1">Page {{ $beritas->currentPage() }} of {{ $beritas->lastPage() }}</div>
                </div>
            @endif
        </div>
    </section>

    <script>
        // Toggle dropdown for more categories
        function toggleMoreCategories() {
            const dropdown = document.getElementById('more-categories');
            const icon = document.getElementById('dropdown-icon');
            const isHidden = dropdown.classList.contains('hidden');

            dropdown.classList.toggle('hidden', !isHidden);
            icon.classList.toggle('rotate-180', isHidden);
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('more-categories');
            const button = event.target.closest('button[onclick="toggleMoreCategories()"]');

            if (!button && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
                document.getElementById('dropdown-icon').classList.remove('rotate-180');
            }
        });

         Initialize Lucide icons
        lucide.createIcons();
    </script>
@endsection
