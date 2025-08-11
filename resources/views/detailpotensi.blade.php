@extends('layouts.app') {{-- Gunakan layout utama, tanpa header di sini --}}

@section('title', $potential->title)

@section('content')
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 max-w-5xl">
        
        <!-- Gambar Potensi -->
        <div class="rounded-2xl overflow-hidden shadow-lg mb-8">
            <img src="{{ $potential->image }}" alt="{{ $potential->title }}" class="w-full h-96 object-cover">
        </div>

        <!-- Judul dan Kategori -->
        <div class="mb-6">
            <h1 class="text-4xl font-bold text-primary mb-2">{{ $potential->title }}</h1>
            <span class="inline-block px-4 py-1 text-sm rounded-full 
                {{ $potential->category === 'pertanian' ? 'bg-green-100 text-green-700' : 'bg-pink-100 text-pink-700' }}">
                {{ ucfirst($potential->category) }}
            </span>
        </div>

        <!-- Deskripsi -->
        <div class="text-lg text-gray-700 leading-relaxed">
            {!! nl2br(e($potential->description)) !!}
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-10">
            <a href="{{ route('home') }}" 
               class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-blue-800 transition-colors">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
                Kembali ke Potensi
            </a>
        </div>
    </div>
</section>
@endsection
