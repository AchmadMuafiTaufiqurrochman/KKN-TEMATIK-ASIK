@extends('layouts.app')

@section('title', 'Beranda - Profil Digital Desa Wonokarang')

@section('content')
    <!-- Hero Carousel with Sliding Effect -->
    <section x-data="{
        slides: [
            'https://images.pexels.com/photos/1595108/pexels-photo-1595108.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'https://images.pexels.com/photos/1486974/pexels-photo-1486974.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'https://images.pexels.com/photos/1595108/pexels-photo-1595108.jpeg?auto=compress&cs=tinysrgb&w=1600'
        ],
        activeIndex: 0,
        init() {
            setInterval(() => {
                this.activeIndex = (this.activeIndex + 1) % this.slides.length
            }, 5000)
        }
    }" class="relative h-screen overflow-hidden">
        <!-- Slider wrapper -->
        <div class="flex transition-transform duration-1000 ease-in-out h-full w-full absolute inset-0"
            :style="`transform: translateX(-${activeIndex * 100}%)`">
            <template x-for="(slide, index) in slides" :key="index">
                <div class="flex-shrink-0 w-full h-full bg-cover bg-center" :style="`background-image: url(${slide})`"></div>
            </template>
        </div>

        <!-- Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent z-10"></div>

        <!-- Content -->
        <div
            class="relative z-20 text-center text-white max-w-4xl mx-auto px-4 flex flex-col justify-center items-center h-full">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                Selamat Datang di <br />
                <span class="text-secondary">Desa Wonokarang</span>
            </h1>

            <p class="text-xl md:text-2xl mb-8 max-w-2xl mx-auto leading-relaxed">
                Menjadi Sentra Budidaya Bunga & Pertanian Unggul dengan Teknologi Modern
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-12">
                <a href="{{ route('about') }}"
                    class="bg-secondary text-primary px-8 py-4 rounded-lg font-semibold hover:bg-yellow-400 transition-colors flex items-center gap-2 group">
                    Lihat Profil Desa
                    <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                </a>

                <a href="{{ route('potential') }}"
                    class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-primary transition-colors">
                    Jelajahi Potensi
                </a>
            </div>

            <div class="flex flex-wrap justify-center gap-8 md:gap-12">
                <div class="flex items-center gap-2 text-center">
                    <i data-lucide="package" class="w-8 h-8 text-secondary"></i>
                    <div>
                        <div class="text-2xl font-bold">{{ number_format($stats['total_products'] ?? 0) }}</div>
                        <div class="text-sm opacity-90">Produk</div>
                    </div>
                </div>

               <div class="flex items-center gap-2 text-center">
                    <i data-lucide="newspaper" class="w-8 h-8 text-secondary"></i>
                    <div>
                        <div class="text-2xl font-bold">{{ number_format($stats['total_news'] ?? 0) }}</div>
                        <div class="text-sm opacity-90">Berita</div>
                    </div>
                </div>

                <div class="flex items-center gap-2 text-center">
                    <i data-lucide="building" class="w-8 h-8 text-secondary"></i>
                    <div>
                        <div class="text-2xl font-bold">{{ number_format($stats['total_facilities'] ?? 0) }}</div>
                        <div class="text-sm opacity-90">Fasilitas</div>
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
                    <h2 class="text-4xl font-bold text-primary mb-4">Tentang Desa Wonokarang</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Desa yang berdiri sejak tahun 1924, kini menjadi salah satu sentra budidaya bunga dan pertanian
                        terbaik
                    </p>
                </div>

                <div class="grid lg:grid-cols-2 gap-12 items-center mb-12">
                    <div class="flex flex-col items-center">
                        <div class="w-[300px] h-[300px] rounded-full overflow-hidden mb-6 border-2 border-gray-300">
                            <img src="{{ asset('storage/' . $kepalaDesa->photo) }}" alt="{{ $kepalaDesa->name }}"
                                class="w-full h-full object-cover" />
                        </div>
                        <h4 class="text-xl font-bold text-primary mb-2">{{ $kepalaDesa->name }}</h4>
                        <p class="text-gray-600">{{ $kepalaDesa->position }}</p>
                    </div>

                    <div>
                        <p class="text-gray-700 mb-6 leading-relaxed">
                            Desa Wonokarang yang berada di Kecamatan Balongbendo, Kabupaten Sidoarjo, telah melalui perjalanan panjang sejak awal berdirinya. Pada masa lalu, pemimpin desa dikenal dengan sebutan Kalebhun dan Tenggi, sebelum akhirnya sesuai regulasi terbaru berganti menjadi Kepala Desa. Hingga saat ini, sudah enam Kepala Desa yang pernah memimpin dan turut membawa perubahan bagi kemajuan masyarakat Wonokarang.
                        </p>
                        <a href="{{ route('about') }}"
                            class="bg-secondary text-primary px-6 py-3 rounded-lg font-semibold hover:bg-yellow-400 transition-colors inline-flex items-center gap-2">
                            Selengkapnya
                            <i data-lucide="arrow-right" class="w-5 h-5"></i>
                        </a>
                    </div>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                        <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="target" class="w-8 h-8 text-white"></i>
                        </div>
                        <h4 class="text-xl font-bold text-primary mb-4">Misi Desa</h4>
                        <div class="text-gray-600">
                            {!! $kepalaDesa->misi ?? 'Misi belum diisi' !!}
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                        <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="eye" class="w-8 h-8 text-white"></i>
                        </div>
                        <h4 class="text-xl font-bold text-primary mb-4">Visi Desa</h4>
                        <div class="text-gray-600">
                            {!! $kepalaDesa->visi ?? 'Visi belum diisi' !!}
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                        <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="award" class="w-8 h-8 text-white"></i>
                        </div>
                        <h4 class="text-xl font-bold text-primary mb-4">Prestasi</h4>
                        <div class="text-gray-600">
                            {!! $kepalaDesa->prestasi ?? 'Prestasi belum diisi' !!}
                        </div>
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
                <!-- Potensi Pertanian -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="relative h-48">
                        <img src="https://images.pexels.com/photos/1595108/pexels-photo-1595108.jpeg?auto=compress&cs=tinysrgb&w=1600"
                             alt="Pertanian Desa Wonokarang"
                             class="w-full h-full object-cover" />
                        <div class="absolute top-4 left-4 bg-white/20 backdrop-blur-sm rounded-full p-3">
                            <i data-lucide="leaf" class="w-8 h-8 text-green-600"></i>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-primary mb-3">Pertanian Unggulan</h3>
                        <p class="text-gray-700 mb-4">
                            Sektor pertanian menjadi salah satu potensi unggulan Desa Wonokarang, khususnya di wilayah Dusun Tengah yang mayoritas masyarakatnya bertumpu pada bidang ini
                        </p>
                        <a href="{{ route('detailpotensi', 'pertanian') }}"
                            class="text-secondary font-semibold hover:text-yellow-600 transition-colors inline-flex items-center gap-2">
                            Lihat Detail
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

                <!-- Potensi Budidaya Bunga -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="relative h-48">
                        <img src="https://images.pexels.com/photos/1486974/pexels-photo-1486974.jpeg?auto=compress&cs=tinysrgb&w=1600"
                             alt="Budidaya Bunga Desa Wonokarang"
                             class="w-full h-full object-cover" />
                        <div class="absolute top-4 left-4 bg-white/20 backdrop-blur-sm rounded-full p-3">
                            <i data-lucide="flower" class="w-8 h-8 text-pink-600"></i>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-primary mb-3">Budidaya Bunga</h3>
                        <p class="text-gray-700 mb-4">
                            Desa Wonokarang juga memiliki potensi besar dalam budidaya bunga yang mulai dilirik oleh masyarakat sebagai peluang usaha baru.
                        </p>
                        <a href="{{ route('detailpotensi', 'budidaya-bunga') }}"
                            class="text-secondary font-semibold hover:text-yellow-600 transition-colors inline-flex items-center gap-2">
                            Lihat Detail
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

   <!-- Highlight Produk Desa -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-primary mb-4">Produk Unggulan Desa</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Beberapa produk pilihan hasil karya masyarakat Desa Wonokarang.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                @foreach ($products->take(3) as $product)
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group">
                        <div class="relative h-48">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                            <div class="absolute top-4 left-4 bg-white/20 backdrop-blur-sm rounded-full px-3 py-1 text-sm font-semibold capitalize
                                @if ($product->category === 'pertanian') text-green-700 bg-green-100/80
                                @elseif($product->category === 'budidaya-bunga') text-pink-700 bg-pink-100/80
                                @else text-gray-700 bg-gray-100/80 @endif">
                                {{ str_replace('-', ' ', $product->category) }}
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-primary mb-2">{{ $product->title }}</h3>
                            <p class="text-gray-700 mb-4">
                                {{ Str::limit($product->description, 80) }}
                            </p>

                            <a href="{{ route('product') }}"
                                class="text-secondary font-semibold hover:text-yellow-600 transition-colors inline-flex items-center gap-2">
                                Lihat Detail
                                <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>


            <div class="text-center mt-12">
                <a href="{{ route('product') }}"
                    class="bg-primary text-white px-8 py-4 rounded-lg font-semibold hover:bg-blue-800 transition-colors inline-flex items-center gap-2">
                    Lihat Semua Produk
                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </a>
            </div>
        </div>
    </section>

    <section class="py-20 bg-white pt-10">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-primary mb-4">Video Profil Desa</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Saksikan keindahan dan potensi Desa Wonokarang melalui video profil yang menampilkan kehidupan
                    sehari-hari masyarakat
                </p>
            </div>

            @if ($video)
                <div class="max-w-4xl mx-auto">
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="relative">
                            <div class="aspect-w-16 aspect-h-9">
                                <iframe src="{{ $video->embed_video_url }}" title="{{ $video->title }}" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen class="w-full h-96 lg:h-[500px] rounded-t-2xl"></iframe>
                            </div>
                        </div>

                        <div class="p-8">
                            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-6">
                                <div>
                                    <h3 class="text-2xl font-bold text-primary mb-2">{{ $video->title }}</h3>
                                    <div class="flex items-center gap-6 text-gray-600">
                                        <div class="flex items-center gap-2">
                                            <i data-lucide="calendar" class="w-4 h-4"></i>
                                            <span>Dipublikasikan {{ $video->created_at->format('d F Y') }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <i data-lucide="eye" class="w-4 h-4"></i>
                                            <span>{{ number_format($video->views) }} views</span>
                                        </div>
                                    </div>
                                </div>

                                <a href="{{ route('about') }}"
                                    class="mt-4 lg:mt-0 bg-secondary text-primary px-6 py-3 rounded-lg font-semibold hover:bg-yellow-400 transition-colors flex items-center gap-2">
                                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                                    Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">
                        Video profil belum tersedia saat ini. Silakan cek kembali nanti.
                    </p>
                </div>
            @endif
        </div>
    </section>



    <!-- Dokumentasi Unggulan -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-primary mb-4">Berita Terbaru</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Berita dan kegiatan terkini berdasarkan jadwal acara di Desa Wonokarang.
                </p>
            </div>


            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                @foreach ($featuredVideos as $video)
                    <a href="{{ route('berita.detail', $video->id) }}" class="block h-full">
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden group h-full flex flex-col">
                            <div class="relative group flex-shrink-0">
                                <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="{{ $video->title }}"
                                    class="w-full h-48 object-cover" />
                                <div
                                    class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    @if ($video->type === 'video')
                                        <i data-lucide="play" class="w-8 h-8 text-white ml-1"></i>
                                    @else
                                        <i data-lucide="image" class="w-8 h-8 text-white"></i>
                                    @endif
                                </div>
                                <div class="absolute bottom-2 right-2 bg-black/70 text-white text-xs px-2 py-1 rounded">
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
                                <div class="absolute top-2 right-2">
                                    @if ($video->is_finished)
                                        <span
                                            class="inline-block px-2 py-1 text-xs bg-green-100 text-green-800 rounded">Selesai</span>
                                    @else
                                        <span
                                            class="inline-block px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded">Akan
                                            Dimulai</span>
                                    @endif
                                </div>
                            </div>

                            <div class="p-4 md:p-6 flex flex-col flex-grow">
                                <h3
                                    class="text-base md:text-lg font-bold text-primary mb-2 line-clamp-2 min-h-[3rem] md:min-h-[3.5rem]">
                                    {{ $video->title }}
                                </h3>
                                <div class="text-gray-600 text-sm mb-4 line-clamp-3 flex-grow">
                                    {!! Str::limit(strip_tags($video->description), 120) !!}
                                </div>
                                <div
                                    class="flex flex-col gap-1 sm:flex-row sm:justify-between text-sm text-gray-500 mt-auto">
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
                    </a>
                @endforeach
            </div>



            <div class="text-center mt-12">
                <a href="{{ route('documentation') }}"
                    class="bg-primary text-white px-8 py-4 rounded-lg font-semibold hover:bg-blue-800 transition-colors inline-flex items-center gap-2">
                    Lihat Semua Berita
                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </a>
            </div>
        </div>
    </section>

@endsection
