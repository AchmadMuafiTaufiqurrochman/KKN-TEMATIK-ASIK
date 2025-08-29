@extends('layouts.app') 

@php
    // Data statis untuk potensi
    $potentials = [
        'pertanian' => [
            'title' => 'Pertanian Unggulan',
            'category' => 'pertanian',
            'image' => 'https://images.pexels.com/photos/1595108/pexels-photo-1595108.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'description' => 'Desa Wonokarang memiliki lahan pertanian yang sangat subur dengan sistem irigasi yang modern dan terkelola dengan baik. Hasil pertanian utama meliputi padi berkualitas tinggi dengan produktivitas mencapai 7 ton per hektar, jagung hibrida yang tahan terhadap hama, serta berbagai jenis sayuran organik seperti bayam, kangkung, tomat, cabai, dan timun yang dipasok ke pasar-pasar besar di sekitar wilayah. 

Para petani di desa ini telah menerapkan teknologi pertanian modern termasuk penggunaan pupuk organik yang diproduksi sendiri dari kompos limbah pertanian dan peternakan. Sistem tanam tumpang sari juga diterapkan untuk memaksimalkan hasil panen dan menjaga kesuburan tanah secara berkelanjutan.

Selain itu, terdapat program pembinaan berkelanjutan dari dinas pertanian setempat yang memberikan pelatihan teknik budidaya modern, manajemen hama terpadu, dan pengolahan hasil pertanian. Kelompok tani yang aktif di desa ini juga rutin mengadakan diskusi dan sharing pengalaman untuk terus meningkatkan produktivitas dan kualitas hasil pertanian.'
        ],
        'budidaya-bunga' => [
            'title' => 'Budidaya Bunga',
            'category' => 'budidaya',
            'image' => 'https://images.pexels.com/photos/1486974/pexels-photo-1486974.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'description' => 'Desa Wonokarang telah menjadi sentra budidaya bunga potong dan tanaman hias yang terkenal hingga ke luar daerah. Keunggulan utama terletak pada kualitas bunga yang dihasilkan mencapai standar ekspor dengan berbagai jenis unggulan seperti mawar holland, melati putih yang harum, anggrek dendrobium dan phalaenopsis, serta krisan dengan beragam warna yang menarik.

Greenhouse modern dengan sistem kontrol suhu dan kelembaban otomatis telah dibangun untuk menjaga kualitas bunga tetap prima sepanjang tahun. Teknologi hidroponik dan aeroponik juga diterapkan untuk beberapa jenis tanaman hias premium yang membutuhkan perawatan khusus.

Para petani bunga di desa ini memiliki keahlian tinggi yang diperoleh melalui pelatihan intensif dan pengalaman bertahun-tahun. Mereka mampu menghasilkan bunga dengan standar kualitas internasional yang tidak hanya dipasarkan di dalam negeri, tapi juga diekspor ke beberapa negara tetangga.

Sistem pemasaran yang terorganisir dengan baik melalui koperasi petani bunga memungkinkan distribusi yang efisien ke berbagai kota besar. Selain itu, agrowisata bunga juga dikembangkan sebagai daya tarik tambahan yang memberikan edukasi kepada masyarakat tentang proses budidaya bunga yang berkualitas.'
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
