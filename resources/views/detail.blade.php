@extends('layouts.app')

@section('title', $highlighted->title)

@section('content')
    <section class="py-20 bg-gray-50 pt-10">
        <div class="container mx-auto px-4">
            <!-- Highlighted Berita -->
            <div class="bg-white rounded-xl shadow-xl p-6 mb-16">
                <div class="text-left">
                    <a href="{{ route('documentation') }}"
                        class="text-primary hover:text-blue-800 font-medium transition-colors">
                        ← Kembali
                    </a>
                </div><br>
                <div class="flex flex-col lg:flex-row gap-8">
                    <div class="lg:w-1/2">
                        @if ($highlighted->type === 'video')
                            <div class="aspect-video rounded overflow-hidden">
                                <iframe class="w-full h-full" src="{{ $highlighted->video_url }}" frameborder="0"
                                    allowfullscreen></iframe>
                            </div>
                        @else
                            <img src="{{ asset($highlighted->thumbnail) }}" alt="{{ $highlighted->title }}"
                                class="rounded-lg w-full">
                        @endif
                    </div>
                    <div class="lg:w-1/2">
                        <!-- Status + Kategori + Tanggal -->
                        <div class="mb-4 space-y-1 flex flex-wrap items-center gap-2">
                            <!-- Status -->
                            @if ($highlighted->is_finished)
                                <span
                                    class="inline-block px-3 py-1 text-xs bg-green-100 text-green-800 rounded-full">Selesai</span>
                            @else
                                <span
                                    class="inline-block px-3 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">Akan Dimulai</span>
                            @endif

                            <!-- Kategori -->
                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                                @if ($highlighted->category === 'kesehatan') bg-red-100 text-red-800
                                @elseif ($highlighted->category === 'ekonomi') bg-purple-100 text-purple-800
                                @elseif ($highlighted->category === 'pertanian') bg-green-100 text-green-800
                                @elseif ($highlighted->category === 'pemerintahan') bg-blue-100 text-blue-800
                                @else bg-yellow-100 text-yellow-800 @endif">
                                {{ ucfirst($highlighted->category) }}
                            </span>

                            <!-- Tanggal -->
                            <span class="text-sm text-gray-500">
                                {{ $highlighted->started_at ? \Carbon\Carbon::parse($highlighted->started_at)->translatedFormat('d M Y') : 'Belum ada tanggal' }}
                            </span>
                        </div>

                        <!-- Judul dan Deskripsi -->
                        <h1 class="text-3xl font-bold text-primary mb-4">{{ $highlighted->title }}</h1>
                        <div class="prose max-w-none break-words">
                            {!! $highlighted->description !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Semua Berita -->
           <!-- Semua Berita -->
<h2 class="text-xl font-semibold mb-6 text-primary">Berita Lainnya</h2>
<div class="grid grid-cols-2 xs:grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
    @foreach ($beritas as $video)
        <a href="{{ route('berita.detail', $video->id) }}"
            class="block bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden"
            data-category="{{ $video->category }}">
            <div class="relative group">
                <img src="{{ asset($video->thumbnail) }}" alt="{{ $video->title }}"
                    class="w-full h-40 sm:h-48 object-cover">

                <!-- Durasi -->
                <div class="absolute bottom-2 right-2 bg-black/70 text-white text-xs px-2 py-1 rounded">
                    {{ $video->duration }}
                </div>

                <!-- Kategori -->
                <div class="absolute top-2 left-2 max-w-[70%]">
                    <span class="px-2 py-1 rounded text-xs font-semibold block truncate
                        @if ($video->category === 'kesehatan') bg-red-100 text-red-800
                        @elseif($video->category === 'ekonomi') bg-purple-100 text-purple-800
                        @else bg-green-100 text-green-800 @endif">
                        {{ ucfirst($video->category) }}
                    </span>
                </div>

                <!-- Status -->
                <div class="absolute top-2 right-2">
                    @if ($video->is_finished)
                        <span
                            class="inline-block px-2 py-1 text-xs bg-green-100 text-green-800 rounded">Selesai</span>
                    @else
                        <span
                            class="inline-block px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded">Akan Dimulai</span>
                    @endif
                </div>
            </div>

            <!-- Konten -->
            <div class="p-4">
                <h3 class="text-sm sm:text-base font-semibold text-primary mb-2 line-clamp-2">{{ $video->title }}</h3>
                <p class="text-xs sm:text-sm text-gray-600 line-clamp-2 break-words">{!! $video->description !!}</p>
                <div class="mt-2 text-xs text-gray-500 flex items-center gap-1">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                    {{ $video->started_at ? \Carbon\Carbon::parse($video->started_at)->translatedFormat('d M Y') : 'Belum ada tanggal' }}
                </div>
            </div>
        </a>
    @endforeach
</div>

        </div>
    </section>

    <script>
        lucide.createIcons();
    </script>
@endsection
