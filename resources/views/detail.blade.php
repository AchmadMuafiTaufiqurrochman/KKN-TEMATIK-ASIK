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
            // TikTok → sama seperti Instagram (1:1)
            elseif (strpos($url, 'tiktok.com') !== false) {
                return "
        <div class='flex justify-center'>
            <iframe class='w-full h-full rounded-lg' src='{$url}embed' frameborder='0' allowfullscreen></iframe>
        </div>";
            }
            // Facebook → sama seperti Instagram (1:1)
            elseif (strpos($url, 'facebook.com') !== false) {
                return "
        <div class='flex justify-center'>
            <iframe class='w-full h-full rounded-lg' src='{$url}embed' frameborder='0' allowfullscreen></iframe>
        </div>";
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
                            <img src="{{ asset($highlighted->thumbnail) }}" alt="{{ $highlighted->title }}"
                                class="rounded-lg w-full">
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

            <h2 class="text-xl font-semibold mb-6 text-primary">Berita Lainnya</h2>
            <div
                class="grid grid-cols-2 xs:grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
                @foreach ($beritas as $video)
                    <a href="{{ route('berita.detail', $video->id) }}"
                        class="block bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden"
                        data-category="{{ $video->category }}">
                        <div class="relative group">
                            <img src="{{ asset($video->thumbnail) }}" alt="{{ $video->title }}"
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
                    </a>
                @endforeach
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
        lucide.createIcons();
    </script>
@endsection
