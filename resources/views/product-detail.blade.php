@extends('layouts.app')

@section('title', $product->name_product . ' - Desa Wonokarang')


@push('styles')
<style>
    /* Turunkan z-index leaflet supaya tidak menutupi navbar */
    .leaflet-container {
        z-index: 1 !important;
    }

    /* Kalau navbar Anda pakai Tailwind fixed + z-50 */
    nav.navbar-fixed {
        z-index: 50 !important;
    }
</style>
@endpush


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
                    <a href="https://www.google.com/maps?q={{ $product->latitude ?? -7.4395 }},{{ $product->longitude ?? 112.5797 }}"
                       target="_blank"
                       class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700">
                        📍 Lihat di Google Maps
                    </a>
                    <a href="{{ url('/product') }}"
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
{{-- Tambahkan Font Awesome untuk ikon --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let lat = {{ $product->latitude ?? -7.4395 }};
    let lng = {{ $product->longitude ?? 112.5797 }};
    let category = "{{ $product->catagory ?? 'ekonomi' }}";

    // Inisialisasi map
    let map = L.map('map').setView([lat, lng], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Mapping kategori -> warna & ikon
    const categoryConfig = {
        "pelayanan-publik": { color: "bg-blue-600", icon: `<i class='fas fa-bus'></i>` },
        "pendidikan":      { color: "bg-green-600", icon: `<i class='fas fa-book'></i>` },
        "kesehatan":       { color: "bg-red-600", icon: `<i class='fas fa-plus'></i>` },
        "ekonomi":         { color: "bg-yellow-600", icon: `<i class='fas fa-store'></i>` }
    };

    // Ambil setting sesuai kategori, default abu-abu
    let cfg = categoryConfig[category] || { color: "bg-gray-500", icon: `<i class='fas fa-map-marker-alt'></i>` };

    // Custom icon marker (bulat warna + ikon putih)
    let customIcon = L.divIcon({
        className: "custom-marker",
        html: `
            <div class="w-10 h-10 ${cfg.color} rounded-full flex items-center justify-center shadow-lg text-white text-lg">
                ${cfg.icon}
            </div>
        `,
        iconSize: [40, 40],
        iconAnchor: [20, 40],
        popupAnchor: [0, -35]
    });

    // Marker dengan popup lengkap
    L.marker([lat, lng], { icon: customIcon }).addTo(map)
        .bindPopup(`
            <div class="text-left">
                <div class="flex items-center gap-2 mb-2">
                    <div class="w-8 h-8 ${cfg.color} rounded-full flex items-center justify-center text-white">
                        ${cfg.icon}
                    </div>
                    <div>
                        <b>{{ $product->name_product }}</b><br>
                        <span class="text-sm text-gray-500">Produk {{ ucfirst($product->catagory) }}</span>
                    </div>
                </div>
                <p>{{ $product->description }}</p>
                <p class="mt-1"><i class="fas fa-user"></i> {{ $product->owner }}</p>
                <p class="mt-1"><i class="fas fa-phone"></i> <a href="tel:{{ $product->contact }}" class="text-blue-600">{{ $product->contact }}</a></p>
                <span class="inline-block mt-2 px-2 py-1 bg-green-100 text-green-700 rounded text-xs">Aktif</span>
                <div class="mt-2">
                    <a href="{{ url('/product/' . $product->id) }}" class="text-blue-600 hover:underline text-sm">
                        <i class="fas fa-eye"></i> Lihat Detail Produk
                    </a>
                </div>
            </div>
        `)
        .openPopup();
});
</script>
@endsection
