@extends('layouts.app')

@section('title', 'Potensi & Produk Desa - Profil Digital Desa Wonokarang')

@section('content')
<section class="py-20 bg-white pt-10">
    <div class="container mx-auto px-4">

        {{-- === POTENSI DESA === --}}
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
                        <p class="text-gray-700 text-sm">Hasil bumi seperti padi, jagung, dan sayuran segar dari ladang warga.</p>
                    </div>
                    <div class="bg-white/90 backdrop-blur-md shadow-lg rounded-xl p-6 text-center hover:-translate-y-2 transition transform duration-300">
                        <div class="text-5xl mb-3">🌸</div>
                        <h3 class="font-bold text-lg mb-2 text-primary">Budidaya Bunga</h3>
                        <p class="text-gray-700 text-sm">Bunga hias berkualitas yang menjadi daya tarik pasar lokal maupun luar daerah.</p>
                    </div>
                    <div class="bg-white/90 backdrop-blur-md shadow-lg rounded-xl p-6 text-center hover:-translate-y-2 transition transform duration-300">
                        <div class="text-5xl mb-3">🛍️</div>
                        <h3 class="font-bold text-lg mb-2 text-primary">UMKM & Kerajinan</h3>
                        <p class="text-gray-700 text-sm">Kerajinan tangan unik hasil kreativitas masyarakat setempat.</p>
                    </div>
                    <div class="bg-white/90 backdrop-blur-md shadow-lg rounded-xl p-6 text-center hover:-translate-y-2 transition transform duration-300">
                        <div class="text-5xl mb-3">🍯</div>
                        <h3 class="font-bold text-lg mb-2 text-primary">Produk Olahan</h3>
                        <p class="text-gray-700 text-sm">Makanan dan minuman khas yang diolah dari bahan-bahan lokal berkualitas.</p>
                    </div>
                </div>


            </div>
        </section>

        <br>
        {{-- === PRODUK DESA === --}}
        <div class="text-center mb-10">
            <h2 class="text-4xl font-bold text-primary mb-4">Katalog Produk Desa</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Jelajahi produk unggulan hasil karya masyarakat Desa Wonokarang.
            </p>
        </div>

        {{-- Filter Kategori --}}
       <div class="flex justify-center flex-wrap gap-4 mb-6">
    <button onclick="filterProductCategory('all', event)" class="product-filter-btn bg-primary text-white px-4 py-2 rounded-full font-semibold">Semua</button>

    @foreach ($categories as $category)
        <button onclick="filterProductCategory('{{ $category }}', event)" class="product-filter-btn bg-white text-primary border border-gray-300 px-4 py-2 rounded-full font-semibold hover:bg-secondary hover:text-white transition">
            {{ ucfirst(str_replace('-', ' ', $category)) }}
        </button>
    @endforeach
</div>

        {{-- TABEL RESPONSIF --}}
            <div class="overflow-x-auto max-w-7xl mx-auto rounded-lg">
            <table class="min-w-full w-full border-collapse text-sm bg-white shadow-xl rounded-xl table-fixed" id="product-table">
                <thead>
                    <tr class="bg-primary text-white text-left">
                        <th class="w-24 px-4 py-3">Gambar</th>
                        <th class="w-1/4 px-4 py-3">Nama Produk</th>
                        <th class="w-2/5 px-4 py-3">Deskripsi</th>
                        <th class="w-1/6 px-4 py-3">Kategori</th>
                        <th class="w-32 px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="product-row border-b hover:bg-gray-50 transition duration-300" data-category="{{ $product->category }}">
                            <td class="px-4 py-3 align-top">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="w-16 h-16 object-cover rounded">
                            </td>
                            <td class="px-4 py-3 font-semibold text-gray-800 align-top break-words">
                                {{ $product->title }}
                            </td>
                            <td class="px-4 py-3 text-gray-600 align-top break-words">
                                {{ Str::limit($product->description, 100) }}
                            </td>
                            <td class="px-4 py-3 align-top">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold capitalize
                                    @if ($product->category === 'pertanian') bg-green-100 text-green-800
                                    @elseif($product->category === 'budidaya-bunga') bg-pink-100 text-pink-700
                                    @else bg-gray-100 text-gray-700 @endif">
                                    {{ $product->category }}
                                </span>
                            </td>
                            <td class="px-4 py-3 align-top">
                                @if ($product->contact)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $product->contact) }}" target="_blank"
                                        class="inline-flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium text-green-700 bg-green-100 hover:bg-green-200 transition duration-200">
                                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                                        Hubungi
                                    </a>
                                @else
                                    <span class="text-gray-400 text-sm italic">Tidak tersedia</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <div id="no-product-msg" class="text-center text-gray-500 mt-6 hidden">
            Tidak ada produk dalam kategori ini.
        </div>

    </div>
</section>

<script>
    function filterProductCategory(category, event) {
        const rows = document.querySelectorAll('.product-row');
        const buttons = document.querySelectorAll('.product-filter-btn');
        const emptyMsg = document.getElementById('no-product-msg');

        let visible = 0;

        buttons.forEach(btn => {
            btn.classList.remove('bg-primary', 'text-white');
            btn.classList.add('bg-white', 'text-primary');
        });

        event.target.closest('button').classList.add('bg-primary', 'text-white');
        event.target.closest('button').classList.remove('bg-white', 'text-primary');

        rows.forEach(row => {
            const rowCategory = row.dataset.category;
            if (category === 'all' || rowCategory === category) {
                row.style.display = '';
                visible++;
            } else {
                row.style.display = 'none';
            }
        });

        emptyMsg.classList.toggle('hidden', visible !== 0);
    }
</script>
@endsection
