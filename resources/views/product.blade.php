@extends('layouts.app')

@section('title', 'Produk Unggulan Desa Wonokarang')

@section('content')
<div class="container mx-auto px-4 py-12"
     x-data="productTable()"
     x-init="fetchProducts()">

    <h1 class="text-3xl md:text-4xl font-bold text-center text-primary mb-12">
        Produk Unggulan Desa Wonokarang
    </h1>

    {{-- Hero Section --}}
    {{-- Tambahkan ini di <head> layout utama --}}
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<section class="relative py-20 bg-cover bg-center rounded-2xl overflow-hidden shadow-lg"
         style="background-image: url('https://images.pexels.com/photos/2165740/pexels-photo-2165740.jpeg')">
    <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/40 to-black/60"></div>
    <div class="relative container mx-auto px-6 text-white">
        {{-- Judul & Deskripsi --}}
        <div class="text-center mb-16" data-aos="fade-up" data-aos-duration="1000">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 drop-shadow-lg">
                Potensi Desa Wonokarang
            </h2>
            <p class="text-base md:text-lg max-w-3xl mx-auto text-gray-200">
                Desa Wonokarang memiliki beragam potensi unggulan yang menjadi kebanggaan masyarakat,
                mulai dari hasil pertanian, kerajinan, hingga produk olahan khas bernilai tinggi.
            </p>
        </div>

        {{-- Grid Potensi --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
            {{-- Pertanian --}}
            <div class="bg-white/90 backdrop-blur-md shadow-lg rounded-2xl p-8 flex flex-col items-center text-center
                        transform hover:-translate-y-3 hover:shadow-xl transition duration-500"
                 data-aos="fade-right" data-aos-duration="1200">
                <div class="text-6xl mb-4">🌾</div>
                <h3 class="font-bold text-xl mb-3 text-primary">Pertanian</h3>
                <p class="text-gray-700 text-sm leading-relaxed">
                    Hasil bumi melimpah seperti padi, jagung, dan sayuran segar dari ladang warga,
                    menjadi penopang ekonomi desa dan pasokan pangan berkualitas.
                </p>
            </div>

            {{-- Budidaya Bunga --}}
            <div class="bg-white/90 backdrop-blur-md shadow-lg rounded-2xl p-8 flex flex-col items-center text-center
                        transform hover:-translate-y-3 hover:shadow-xl transition duration-500"
                 data-aos="fade-left" data-aos-duration="1200">
                <div class="text-6xl mb-4">🌸</div>
                <h3 class="font-bold text-xl mb-3 text-primary">Budidaya Bunga</h3>
                <p class="text-gray-700 text-sm leading-relaxed">
                    Berbagai jenis bunga hias berkualitas tinggi yang menarik pasar lokal maupun luar daerah,
                    sekaligus mempercantik lingkungan sekitar.
                </p>
            </div>
        </div>
    </div>
</section>




    {{-- Search & Filter --}}
    <div class="mt-16 mb-6 flex flex-col md:flex-row gap-4 items-center justify-between">
        {{-- Search Input --}}
        <div class="w-full md:w-1/2">
            <input type="text" x-model="search" @input.debounce.500ms="fetchProducts()"
                   placeholder="Cari produk..."
                   class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none">
        </div>

        {{-- Filter Kategori --}}
        <div class="w-full md:w-1/4">
            <select x-model="category" @change="fetchProducts()"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none">
                <option value="">Semua Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}">{{ ucfirst(str_replace('-', ' ', $category)) }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- Tabel Produk --}}
    <div class="overflow-x-auto bg-white shadow-md rounded-lg relative">
        {{-- Loader --}}
        <div x-show="loading" class="absolute inset-0 flex items-center justify-center bg-white/70 z-10">
            <div class="w-8 h-8 border-4 border-primary border-t-transparent rounded-full animate-spin"></div>
        </div>

        <table class="w-full border-collapse">
            <thead class="bg-primary text-white">
                <tr>
                    <th class="px-4 py-3 text-left">No</th>
                    <th class="px-4 py-3 text-left">Gambar</th>
                    <th class="px-4 py-3 text-left">Nama Produk</th>
                    <th class="px-4 py-3 text-left">Pemilik</th>
                    <th class="px-4 py-3 text-left">Kategori</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="(product, index) in products.data" :key="product.id">
                    <tr class="border-b even:bg-gray-50 hover:bg-gray-100 transition">
                        <td class="px-4 py-3" x-text="(products.from ?? 1) + index"></td>
                        <td class="px-4 py-3">
                            <template x-if="product.image">
                                <img :src="'/storage/' + product.image"
                                     :alt="product.name_product"
                                     class="w-16 h-16 object-cover rounded-lg shadow-sm">
                            </template>
                            <template x-if="!product.image">
                                <div class="w-16 h-16 flex items-center justify-center bg-gray-100 text-gray-400 text-xs rounded-lg">
                                    No Img
                                </div>
                            </template>
                        </td>
                        <td class="px-4 py-3 font-semibold" x-text="product.name_product"></td>
                        <td class="px-4 py-3" x-text="product.owner"></td>
                        <td class="px-4 py-3 capitalize" x-text="product.catagory.replace('-', ' ')"></td>
                        <td class="px-4 py-3 text-center space-x-2">
                            <a :href="'/product/' + product.id"
                               class="inline-block bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700 text-sm shadow-sm">
                               Detail
                            </a>
                            <a :href="'https://wa.me/' + product.contact" target="_blank"
                               class="inline-block bg-green-600 text-white px-3 py-1 rounded-lg hover:bg-green-700 text-sm shadow-sm">
                               Hubungi
                            </a>
                        </td>
                    </tr>
                </template>

                <tr x-show="products.data.length === 0">
                    <td colspan="6" class="text-center py-6 text-gray-500 text-sm">
                        Belum ada produk yang tersedia
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6 flex justify-center gap-2 flex-wrap">
        <template x-for="link in products.links" :key="link.label">
            <button @click="fetchProducts(link.url)"
                    x-html="link.label"
                    :disabled="!link.url"
                    class="px-4 py-2 rounded-lg border shadow-sm"
                    :class="{'bg-primary text-white border-primary': link.active, 'bg-white text-gray-700 hover:bg-gray-100': !link.active}">
            </button>
        </template>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
{{-- Alpine.js --}}
<script>
function productTable() {
    return {
        search: '{{ request("search") }}',
        catagory: '{{ request("catagory") }}',
        products: { data: [], links: [] },
        loading: false,
        async fetchProducts(url = '{{ route("product") }}') {
            this.loading = true;
            let params = new URLSearchParams({
                search: this.search,
                category: this.category
            });
            if (url.includes('?')) {
                url += '&' + params.toString();
            } else {
                url += '?' + params.toString();
            }
            let res = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
            this.products = await res.json();
            this.loading = false;
        }
    }
}
</script>
@endsection
