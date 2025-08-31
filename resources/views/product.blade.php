@extends('layouts.app')

@section('title', 'Produk Unggulan Desa Wonokarang')

@section('content')
<div class="container mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold text-center text-primary mb-8">Produk Unggulan Desa Wonokarang</h1>

    {{-- Hero Section --}}
    <section class="relative py-20 bg-cover bg-center" style="background-image: url('https://images.pexels.com/photos/2165740/pexels-photo-2165740.jpeg')">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <div class="relative container mx-auto px-4 text-white">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4 drop-shadow-lg">Potensi Desa Wonokarang</h2>
                <p class="text-xl max-w-3xl mx-auto text-gray-200 drop-shadow">
                    Desa Wonokarang memiliki beragam potensi unggulan yang menjadi kebanggaan masyarakat,
                    mulai dari hasil pertanian, kerajinan, hingga produk olahan khas bernilai tinggi.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 max-w-6xl mx-auto">
                <div class="bg-white/90 backdrop-blur-md shadow-lg rounded-xl p-6 text-center hover:-translate-y-2 transition transform duration-300">
                    <div class="text-5xl mb-3">🌾</div>
                    <h3 class="font-bold text-lg mb-2 text-primary">Pertanian</h3>
                    <p class="text-gray-700 text-sm">Hasil bumi seperti padi, dan sayuran segar dari ladang warga.</p>
                </div>
                <div class="bg-white/90 backdrop-blur-md shadow-lg rounded-xl p-6 text-center hover:-translate-y-2 transition transform duration-300">
                    <div class="text-5xl mb-3">🌸</div>
                    <h3 class="font-bold text-lg mb-2 text-primary">Budidaya Bunga</h3>
                    <p class="text-gray-700 text-sm">Bunga hias berkualitas yang menjadi daya tarik pasar lokal maupun luar daerah.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Tabel Produk --}}
    <div class="mt-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Daftar Produk</h2>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full table-auto border-collapse">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="px-4 py-3 text-left">#</th>
                        <th class="px-4 py-3 text-left">Gambar</th>
                        <th class="px-4 py-3 text-left">Nama Produk</th>
                        <th class="px-4 py-3 text-left">Pemilik</th>
                        <th class="px-4 py-3 text-left">Kategori</th>
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $index => $product)
                        @if($product->status == 'active')
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $index+1 }}</td>
                            <td class="px-4 py-3">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name_product }}" class="w-16 h-16 object-cover rounded">
                                @else
                                    <div class="w-16 h-16 flex items-center justify-center bg-gray-100 text-gray-400 text-xs rounded">No Img</div>
                                @endif
                            </td>
                            <td class="px-4 py-3 font-semibold">{{ $product->name_product }}</td>
                            <td class="px-4 py-3">{{ $product->owner }}</td>
                            <td class="px-4 py-3 capitalize">{{ str_replace('-', ' ', $product->catagory) }}</td>
                            <td class="px-4 py-3 space-x-2">
                                <a href="{{ route('detail', $product->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm">Detail</a>
                                <a href="https://wa.me/{{ $product->contact }}" target="_blank" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 text-sm">Hubungi</a>
                            </td>
                        </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">Belum ada produk yang tersedia</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
