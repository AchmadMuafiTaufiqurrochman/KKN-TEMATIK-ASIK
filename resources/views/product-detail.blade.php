@extends('layouts.app')

@section('title', $product->name_product . ' - Detail Produk')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name_product }}" class="w-full h-80 object-cover">
        @else
            <div class="w-full h-80 flex items-center justify-center bg-gray-100 text-gray-400">Tidak ada gambar</div>
        @endif

        <div class="p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $product->name_product }}</h1>
            <p class="text-gray-600 mb-2">Pemilik: <span class="font-semibold">{{ $product->owner }}</span></p>
            <p class="text-gray-600 mb-2">Kategori: <span class="capitalize">{{ str_replace('-', ' ', $product->catagory) }}</span></p>
            <p class="text-gray-700 mb-4">{{ $product->description }}</p>

            <div class="flex space-x-4">
                <a href="https://wa.me/{{ $product->contact }}" target="_blank" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Hubungi via WA</a>
                <a href="{{ route('product') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
