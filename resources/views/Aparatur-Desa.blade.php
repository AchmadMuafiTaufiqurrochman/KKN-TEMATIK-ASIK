@extends('layouts.app')

@section('title', 'Aparatur Desa - Profil Digital')

@section('content')
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-primary">Aparatur Desa</h2>
            <p class="text-gray-600 mt-2">Struktur organisasi pemerintahan Desa Wonokarang</p>
        </div>

        @if($aparat && count($aparat) > 0)
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @foreach($aparat as $aparatItem)
                <div class="bg-white rounded-xl shadow text-center overflow-hidden">
                    <div class="aspect-[3/4] w-full">
                        <img src="{{ $aparatItem->photo ? asset('storage/' . $aparatItem->photo) : 'https://via.placeholder.com/150' }}"
                             class="w-full h-full object-cover object-top">
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-primary leading-tight">{{ $aparatItem->name }}</h3>
                        <p class="text-gray-600 text-sm">{{ $aparatItem->position }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <div class="bg-white rounded-xl shadow-sm p-8 max-w-md mx-auto">
                    <div class="text-gray-400 mb-4">
                        <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Data Aparatur</h3>
                    <p class="text-gray-500">Data aparatur desa belum tersedia saat ini.</p>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
