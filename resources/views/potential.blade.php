@extends('layouts.app')

@section('title', 'Potensi & Produk Desa - Profil Digital Desa Wonokarang')

@section('content')
    <section class="py-20 bg-white pt-10">
        <div class="container mx-auto px-4">

            {{-- === POTENSI DESA === --}}
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-primary mb-4">Potensi Desa</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Eksplorasi potensi unggulan yang dimiliki Desa Wonokarang
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-12 max-w-6xl mx-auto mb-24">
                @foreach ($potentials as $potential)
                    <div
                        class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                        <div class="relative h-64 overflow-hidden">
                            <img src="{{ $potential->image }}" alt="{{ $potential->title }}"
                                class="w-full h-full object-cover transition-transform duration-300 hover:scale-105" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                            <div class="absolute top-4 left-4 bg-white/20 backdrop-blur-sm rounded-full p-3">
                                @if ($potential->category === 'pertanian')
                                    <i data-lucide="leaf" class="w-12 h-12 text-green-600"></i>
                                @else
                                    <i data-lucide="flower" class="w-12 h-12 text-pink-600"></i>
                                @endif
                            </div>
                        </div>

                        <div class="p-8">
                            <h3 class="text-2xl font-bold text-primary mb-4">{{ $potential->title }}</h3>
                            <p class="text-gray-700 mb-6 leading-relaxed">{{ $potential->description }}</p>

                            {{-- Statistik --}}
                            <div class="grid grid-cols-3 gap-4 p-4 bg-gray-50 rounded-lg mb-6">
                                @if ($potential->category === 'pertanian')
                                    <div class="text-center">
                                        <div class="text-lg font-bold text-primary">150 Ha</div>
                                        <div class="text-sm text-gray-600">Luas Area</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-lg font-bold text-primary">320 Petani</div>
                                        <div class="text-sm text-gray-600">Petani</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-lg font-bold text-primary">850 Ton/Tahun</div>
                                        <div class="text-sm text-gray-600">Produksi</div>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <div class="text-lg font-bold text-primary">75 Ha</div>
                                        <div class="text-sm text-gray-600">Luas Area</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-lg font-bold text-primary">180 Petani</div>
                                        <div class="text-sm text-gray-600">Petani</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-lg font-bold text-primary">2.5 Juta Batang/Tahun</div>
                                        <div class="text-sm text-gray-600">Produksi</div>
                                    </div>
                                @endif
                            </div>

                            <button
                                class="w-full bg-secondary text-primary py-3 rounded-lg font-semibold hover:bg-yellow-400 transition-colors flex items-center justify-center gap-2 group">
                                Lihat Detail
                                <i data-lucide="arrow-right"
                                    class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- === PRODUK DESA === --}}
            <div class="text-center mb-10">
                <h2 class="text-4xl font-bold text-primary mb-4">Katalog Produk Desa</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Jelajahi produk unggulan hasil karya masyarakat Desa Wonokarang.
                </p>
            </div>

            {{-- Filter Kategori --}}
            <div class="flex justify-center flex-wrap gap-4 mb-6">
                <button onclick="filterProductCategory('all', event)"
                    class="product-filter-btn bg-primary text-white px-4 py-2 rounded-full font-semibold">Semua</button>
                <button onclick="filterProductCategory('pertanian', event)"
                    class="product-filter-btn bg-white text-primary border border-gray-300 px-4 py-2 rounded-full font-semibold hover:bg-secondary hover:text-white transition">Pertanian</button>
                <button onclick="filterProductCategory('budidaya-bunga', event)"
                    class="product-filter-btn bg-white text-primary border border-gray-300 px-4 py-2 rounded-full font-semibold hover:bg-secondary hover:text-white transition">Budidaya
                    Bunga</button>
            </div>

            <div class="overflow-x-auto max-w-7xl mx-auto">
                <table class="w-full table-fixed border-collapse rounded-xl shadow-lg bg-white" id="product-table">
                    <thead>
                        <tr class="bg-primary text-white text-left">
                            <th class="px-4 py-3 w-[15%]">Gambar</th>
                            <th class="px-4 py-3 w-[20%]">Nama Produk</th>
                            <th class="px-4 py-3 w-[35%]">Deskripsi</th>
                            <th class="px-4 py-3 w-[15%]">Kategori</th>
                            <th class="px-4 py-3 w-[15%]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($potentials as $potential)
                            @foreach ($potential->products as $product)
                                <tr class="product-row border-b hover:bg-gray-50 transition duration-300"
                                    data-category="{{ $potential->category }}">
                                    <td class="px-4 py-3">
                                        <img src="{{ $product->image }}" alt="{{ $product->name }}"
                                            class="w-16 h-16 object-cover rounded">
                                    </td>
                                    <td class="px-4 py-3 font-semibold text-gray-800">{{ $product->name }}</td>
                                    <td class="px-4 py-3 text-gray-600 break-words">
                                        {{ Str::limit($product->description, 100) }}</td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="inline-block px-3 py-1 rounded-full text-xs font-semibold capitalize
                                @if ($potential->category === 'pertanian') bg-green-100 text-green-800
                                @elseif($potential->category === 'budidaya-bunga')
                                    bg-pink-100 text-pink-700
                                @else
                                    bg-gray-100 text-gray-700 @endif">
                                            {{ $potential->category }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        @if ($product->whatsapp_number)
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $product->whatsapp_number) }}"
                                                target="_blank"
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
                        @endforeach
                    </tbody>
                </table>
            </div>



            <div id="no-product-msg" class="text-center text-gray-500 mt-6 hidden">
                Tidak ada produk dalam kategori ini.
            </div>

        </div>
    </section>

    <style>
        table {
            table-layout: fixed;
        }

        td,
        th {
            overflow-wrap: break-word;
            word-wrap: break-word;
            word-break: break-word;
        }
    </style>


    <script>
        function filterProductCategory(category, event) {
            const rows = document.querySelectorAll('.product-row');
            const buttons = document.querySelectorAll('.product-filter-btn');
            const emptyMsg = document.getElementById('no-product-msg');

            let visible = 0;

            // Reset button styles
            buttons.forEach(btn => {
                btn.classList.remove('bg-primary', 'text-white');
                btn.classList.add('bg-white', 'text-primary');
            });

            // Aktifkan button yang diklik (gunakan closest agar aman)
            event.target.closest('button').classList.add('bg-primary', 'text-white');
            event.target.closest('button').classList.remove('bg-white', 'text-primary');

            // Filter produk
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
