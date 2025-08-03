@extends('layouts.app')

@section('title', $highlighted->title)

@section('content')
    <section class="py-20 bg-gray-50 pt-10">
        <div class="container mx-auto px-4">
            <!-- Highlighted Berita -->
            <div class="bg-white rounded-xl shadow-xl p-6 mb-16">
                <div class="text-left">
                <a href="{{ route('documentation') }}" class="text-primary hover:text-blue-800 font-medium transition-colors">
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
                        <div class="mb-4 space-y-1">
                            <!-- Status -->
                            @if ($highlighted->is_finished)
                                <span
                                    class="inline-block px-3 py-1 text-xs bg-green-100 text-green-800 rounded-full">Selesai</span>
                            @else
                                <span class="inline-block px-3 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">Akan
                                    Dimulai</span>
                            @endif

                            <!-- Kategori -->
                            <span
                                class="inline-block px-3 py-1 text-xs font-semibold rounded-full ml-2
                            @if ($highlighted->category === 'kesehatan') bg-red-100 text-red-800
                            @elseif ($highlighted->category === 'ekonomi') bg-purple-100 text-purple-800
                            @elseif ($highlighted->category === 'pertanian') bg-green-100 text-green-800
                            @elseif ($highlighted->category === 'pemerintahan') bg-blue-100 text-blue-800
                            @else bg-yellow-100 text-yellow-800 @endif">
                                {{ ucfirst($highlighted->category) }}
                            </span>

                            <!-- Tanggal -->
                            <span class="ml-2 text-sm text-gray-500">
                                {{ $highlighted->started_at ? \Carbon\Carbon::parse($highlighted->started_at)->translatedFormat('d M Y') : 'Belum ada tanggal' }}
                            </span>
                        </div>

                        <!-- Judul dan Deskripsi -->
                        <h1 class="text-3xl font-bold text-primary mb-4">{{ $highlighted->title }}</h1>
                        <div class="prose max-w-none">
                            {!! $highlighted->description !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Semua Berita -->
            <h2 class="text-xl font-semibold mb-6 text-primary">Berita Lainnya</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($beritas as $video)
                    <a href="{{ route('berita.detail', $video->id) }}"
                        class="block bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden"
                        data-category="{{ $video->category }}">
                        <div class="relative group">
                            <img src="{{ asset($video->thumbnail) }}" alt="{{ $video->title }}"
                                class="w-full h-48 object-cover">
                            <div class="absolute bottom-2 right-2 bg-black/70 text-white text-xs px-2 py-1 rounded">
                                {{ $video->duration }}
                            </div>
                            <div class="absolute top-2 left-2">
                                <span
                                    class="px-2 py-1 rounded text-xs font-semibold
                                @if ($video->category === 'kesehatan') bg-red-100 text-red-800
                                @elseif($video->category === 'ekonomi') bg-purple-100 text-purple-800
                                @else bg-green-100 text-green-800 @endif">
                                    {{ ucfirst($video->category) }}
                                </span>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-primary mb-2 line-clamp-2">{{ $video->title }}</h3>
                            <p class="text-sm text-gray-600 line-clamp-2">{!! $video->description !!}</p>
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
