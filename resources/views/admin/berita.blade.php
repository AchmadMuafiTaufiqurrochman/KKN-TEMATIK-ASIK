@extends('layouts.admin')

@section('title', 'Manajemen Berita - Admin Desa Mekar Sari')

@section('content')
<div class="min-h-screen bg-gray-50 pt-0">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-primary">Manajemen Berita</h1>
                    <p class="text-gray-600">Kelola berita dan informasi desa</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center gap-3">
                <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
                <span class="text-green-700">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Statistik -->
        <div class="grid md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $stats['total'] }}</h3>
                <p class="text-gray-600 text-sm">Total Berita</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ number_format($stats['total_views']) }}</h3>
                <p class="text-gray-600 text-sm">Total Views</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $stats['published'] }}</h3>
                <p class="text-gray-600 text-sm">Published</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $stats['draft'] }}</h3>
                <p class="text-gray-600 text-sm">Draft</p>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex flex-col sm:flex-row gap-4 mb-6">
            <a href="{{ route('berita.create') }}" class="bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800 transition-colors flex items-center gap-2">
                <i data-lucide="plus" class="w-5 h-5"></i>
                Tambah Berita
            </a>
        </div>

        <!-- Filter Kategori -->
        <div class="flex flex-wrap gap-4 mb-8">
            @foreach($categories as $key => $count)
            <a href="{{ route('berita.index', ['category' => $key]) }}" 
               class="px-6 py-3 rounded-full font-semibold transition-colors {{ request('category', 'all') === $key ? 'bg-primary text-white' : 'bg-white text-primary hover:bg-secondary hover:text-primary border border-gray-200' }}">
                {{ ucfirst($key === 'all' ? 'Semua' : $key) }} ({{ $count }})
            </a>
            @endforeach
        </div>

        <!-- List Berita -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($videos as $berita)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <img src="{{ $berita->thumbnail }}" alt="{{ $berita->title }}" class="w-full h-48 object-cover">
                
                <div class="p-6">
                    <h3 class="text-lg font-bold text-primary mb-2 line-clamp-2">
                        {{ $berita->title }}
                    </h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                        {{ $berita->excerpt }}
                    </p>

                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                        <span><i data-lucide="eye" class="w-4 h-4 inline"></i> {{ number_format($berita->views) }} views</span>
                        <span><i data-lucide="calendar" class="w-4 h-4 inline"></i> {{ $berita->created_at->format('d M Y') }}</span>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('berita.edit', $berita->id) }}" class="flex-1 bg-secondary text-primary py-2 px-4 rounded-lg font-semibold hover:bg-yellow-400 transition-colors flex items-center justify-center gap-2">
                            <i data-lucide="edit" class="w-4 h-4"></i> Edit
                        </a>
                        <form action="{{ route('berita.destroy', $berita->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition-colors">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500">Tidak ada berita ditemukan.</p>
            </div>
            @endforelse
        </div>

        @if($videos->hasPages())
        <div class="mt-8">
            {{ $videos->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
