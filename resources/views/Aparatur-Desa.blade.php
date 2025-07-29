@extends('layouts.app')

@section('title', 'Aparatur Desa - Profil Digital')

@section('content')
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-primary">Aparatur Desa</h2>
            <p class="text-gray-600 mt-2">Struktur organisasi pemerintahan Desa Wonokarang</p>
        </div>
        <div class="grid md:grid-cols-5 gap-8">
            @foreach($aparat as $aparat)
            <div class="bg-white rounded-xl shadow p-6 text-center">
                <img src="{{ $aparat->photo ? asset('storage/' . $aparat->photo) : 'https://via.placeholder.com/150' }}"
                     class="w-32 h-32 mx-auto rounded-full object-cover mb-4">
                <h3 class="text-xl font-semibold text-primary">{{ $aparat->name }}</h3>
                <p class="text-gray-600">{{ $aparat->position }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
