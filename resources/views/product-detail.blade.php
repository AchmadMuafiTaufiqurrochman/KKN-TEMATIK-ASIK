@extends('layouts.app')

@section('title', $product->name_product . ' - Desa Wonokarang')

@section('content')
<div class="container mx-auto px-4 py-12">

    {{-- Hero Produk --}}
    <section class="relative bg-gray-100 rounded-2xl shadow-lg overflow-hidden mb-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            {{-- Gambar Produk --}}
            <div class="relative">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                         alt="{{ $product->name_product }}"
                         class="w-full h-96 object-cover rounded-2xl">
                @else
                    <div class="w-full h-96 flex items-center justify-center bg-gray-200 text-gray-400 text-lg">
                        No Image
                    </div>
                @endif
            </div>

            {{-- Info Produk --}}
            <div class="p-6">
                <h1 class="text-3xl md:text-4xl font-bold text-primary mb-4">
                    {{ $product->name_product }}
                </h1>
                <p class="text-gray-600 mb-2">
                    <span class="font-semibold">Pemilik:</span> {{ $product->owner }}
                </p>
                <p class="text-gray-600 mb-2 capitalize">
                    <span class="font-semibold">Kategori:</span> {{ str_replace('-', ' ', $product->catagory) }}
                </p>
                <p class="text-gray-700 leading-relaxed mb-6">
                    {{ $product->description }}
                </p>

                {{-- Tombol Aksi --}}
                <div class="flex flex-wrap gap-3">
                    <a href="https://wa.me/{{ $product->contact }}" target="_blank"
                       class="inline-flex items-center bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700">
                        💬 Hubungi via WhatsApp
                    </a>
                    <a href="{{ url('/products') }}"
                       class="inline-flex items-center bg-gray-200 text-gray-700 px-4 py-2 rounded-lg shadow hover:bg-gray-300">
                        ← Kembali
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Lokasi di Peta --}}
    <section>
        <h2 class="text-2xl font-bold text-primary mb-4">Lokasi Produk</h2>
        <div id="map" class="w-full h-96 rounded-2xl shadow"></div>
    </section>
</div>

{{-- LeafletJS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let lat = {{ $product->latitude ?? -7.4395 }};
    let lng = {{ $product->longitude ?? 112.5797 }};

    let map = L.map('map').setView([lat, lng], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    L.marker([lat, lng]).addTo(map)
        .bindPopup(`<b>{{ $product->name_product }}</b><br>{{ $product->owner }}`)
        .openPopup();
});
</script>
@endsection
