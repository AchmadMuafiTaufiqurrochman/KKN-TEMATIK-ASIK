@extends('layouts.app')

@php
    // Data statis untuk potensi
    $potentials = [
        'pertanian' => [
            'title' => 'Pertanian Unggulan',
            'category' => 'pertanian',
            'image' => 'https://images.pexels.com/photos/1595108/pexels-photo-1595108.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'description' => 'Sektor pertanian menjadi salah satu potensi unggulan Desa Wonokarang, khususnya di wilayah Dusun Tengah yang mayoritas masyarakatnya bertumpu pada bidang ini. Dengan dukungan lahan pertanian yang cukup luas, masyarakat mulai mengembangkan pertanian modern yang lebih efisien melalui penggunaan teknologi, pola tanam yang berkelanjutan, serta pemanfaatan pupuk organik untuk menjaga kualitas tanah. Langkah ini tidak hanya meningkatkan produktivitas hasil panen, tetapi juga menjadi upaya nyata dalam mendukung ketahanan pangan desa.'
        ],
        'budidaya-bunga' => [
            'title' => 'Budidaya Bunga',
            'category' => 'budidaya',
            'image' => 'https://images.pexels.com/photos/1486974/pexels-photo-1486974.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'description' => 'Desa Wonokarang juga memiliki potensi besar dalam budidaya bunga yang mulai dilirik oleh masyarakat sebagai peluang usaha baru. Budidaya bunga tidak hanya bernilai ekonomis tinggi karena tingginya permintaan pasar untuk kebutuhan hias maupun acara, tetapi juga mampu mempercantik lingkungan desa sehingga menghadirkan nilai estetika tersendiri. Kombinasi pertanian modern dan budidaya bunga ini diharapkan dapat membuka lapangan pekerjaan baru, meningkatkan kesejahteraan masyarakat, serta menjadikan Desa Wonokarang sebagai salah satu desa percontohan dalam pengembangan sektor pertanian dan hortikultura di Kecamatan Balongbendo.'
        ]
    ];

    $slug = request()->route('id'); // Mengambil parameter dari route
    $potential = $potentials[$slug] ?? $potentials['pertanian']; // Default ke pertanian jika tidak ada
@endphp

@section('title', $potential['title'])

@section('content')
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 max-w-5xl">

        <!-- Gambar Potensi -->
        <div class="rounded-2xl overflow-hidden shadow-lg mb-8">
            <img src="{{ $potential['image'] }}" alt="{{ $potential['title'] }}" class="w-full h-96 object-cover">
        </div>

        <!-- Judul dan Kategori -->
        <div class="mb-6">
            <h1 class="text-4xl font-bold text-primary mb-2">{{ $potential['title'] }}</h1>
            <span class="inline-block px-4 py-1 text-sm rounded-full
                {{ $potential['category'] === 'pertanian' ? 'bg-green-100 text-green-700' : 'bg-pink-100 text-pink-700' }}">
                {{ ucfirst($potential['category']) }}
            </span>
        </div>

        <!-- Deskripsi -->
        <div class="text-lg text-gray-700 leading-relaxed space-y-4 text-justify">
            @foreach(explode("\n\n", $potential['description']) as $paragraph)
                @if(trim($paragraph))
                    <p>{{ trim($paragraph) }}</p>
                @endif
            @endforeach
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-10">
            <a href="{{ route('home') }}"
               class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-blue-800 transition-colors">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
                Kembali
            </a>
        </div>
    </div>
</section>
@endsection
