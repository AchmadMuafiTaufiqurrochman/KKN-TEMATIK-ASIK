@extends('layouts.app')

@section('title', 'Aparatur Desa - Profil Digital')

@section('content')
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-primary">Aparatur Desa</h2>
            <p class="text-gray-600 mt-2">Struktur organisasi pemerintahan Desa Wonokarang</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach($aparat as $aparat)
            <div class="bg-white rounded-xl shadow text-center overflow-hidden">
                <div class="aspect-[3/4] w-full">
                    <img src="{{ $aparat->photo ? asset('storage/' . $aparat->photo) : 'https://via.placeholder.com/150' }}"
                         class="w-full h-full object-cover object-top">
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-primary leading-tight">{{ $aparat->name }}</h3>
                    <p class="text-gray-600 text-sm">{{ $aparat->position }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
