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

        {{-- GRID CARD PRODUK --}}
        @if ($products->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8" id="product-grid">
            @foreach ($products as $product)
                <div class="product-card bg-white border rounded-lg shadow hover:shadow-lg transition overflow-hidden flex flex-col" data-category="{{ $product->category }}">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="h-48 w-full object-cover">
                    @else
                        <div class="h-48 w-full flex items-center justify-center bg-gray-100 text-gray-400 italic">
                            Tidak ada gambar
                        </div>
                    @endif
                    <div class="p-4 flex flex-col flex-1">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $product->title }}</h3>
                        <span class="text-sm text-blue-700 bg-blue-100 px-2 py-1 rounded mt-1 inline-block">
                            {{ ucfirst(str_replace('-', ' ', $product->category)) }}
                        </span>
                        <p class="text-gray-600 text-sm mt-2 line-clamp-3">
                            {{ $product->description }}
                        </p>
                        <div class="mt-auto pt-4">
                            @if ($product->contact)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $product->contact) }}"
                                   target="_blank"
                                   class="block text-center bg-green-500 text-white py-2 rounded hover:bg-green-600 transition">
                                    Hubungi Penjual
                                </a>
                            @else
                                <span class="block text-center text-gray-400 text-sm italic">Tidak tersedia</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @else
            <div class="text-center text-gray-500 py-12">
                Belum ada produk dalam kategori ini.
            </div>
        @endif

    </div>
</section>

<script>
function filterProductCategory(category, event) {
    const cards = document.querySelectorAll('.product-card');
    const buttons = document.querySelectorAll('.product-filter-btn');
    let visible = 0;

    // Update tombol aktif
    buttons.forEach(btn => {
        btn.classList.remove('bg-primary', 'text-white');
        btn.classList.add('bg-white', 'text-primary');
    });
    event.target.closest('button').classList.add('bg-primary', 'text-white');
    event.target.closest('button').classList.remove('bg-white', 'text-primary');

    // Filter produk
    cards.forEach(card => {
        const cardCategory = card.dataset.category;
        if (category === 'all' || cardCategory === category) {
            card.style.display = '';
            visible++;
        } else {
            card.style.display = 'none';
        }
    });

    // Pesan kosong
    let emptyMsg = document.getElementById('no-product-msg');
    if (!emptyMsg) {
        emptyMsg = document.createElement('div');
        emptyMsg.id = 'no-product-msg';
        emptyMsg.className = 'text-center text-gray-500 mt-6 hidden';
        emptyMsg.innerText = 'Tidak ada produk dalam kategori ini.';
        document.getElementById('product-grid')?.after(emptyMsg);
    }
    emptyMsg.classList.toggle('hidden', visible !== 0);
}
</script>
@endsection
