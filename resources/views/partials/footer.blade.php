<footer id="contact" class="bg-primary text-white">
    <div class="container mx-auto px-4 py-12">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- About Section -->
            <div>
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-12 h-12 bg-secondary rounded-full flex items-center justify-center">
                        <span class="text-primary font-bold text-xl">MS</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold">Desa Mekar Sari</h3>
                        <p class="text-sm opacity-90">Profil Digital</p>
                    </div>
                </div>
                <p class="text-gray-300 mb-4 leading-relaxed">
                    Desa Mekar Sari adalah sentra budidaya bunga dan pertanian modern yang berkomitmen 
                    untuk kesejahteraan masyarakat dan pembangunan berkelanjutan.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-300 hover:text-secondary transition-colors">
                        <i data-lucide="facebook" class="w-5 h-5"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-secondary transition-colors">
                        <i data-lucide="instagram" class="w-5 h-5"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-secondary transition-colors">
                        <i data-lucide="youtube" class="w-5 h-5"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-secondary transition-colors">
                        <i data-lucide="globe" class="w-5 h-5"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-semibold mb-6">Link Cepat</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-secondary transition-colors">Beranda</a></li>
                    <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-secondary transition-colors">Tentang Desa</a></li>
                    <li><a href="{{ route('potential') }}" class="text-gray-300 hover:text-secondary transition-colors">Potensi Desa</a></li>
                    <li><a href="{{ route('video-profile') }}" class="text-gray-300 hover:text-secondary transition-colors">Video Profil</a></li>
                    <li><a href="{{ route('documentation') }}" class="text-gray-300 hover:text-secondary transition-colors">Dokumentasi</a></li>
                    <li><a href="{{ route('map') }}" class="text-gray-300 hover:text-secondary transition-colors">Peta Desa</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h4 class="text-lg font-semibold mb-6">Kontak Desa</h4>
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <i data-lucide="map-pin" class="w-5 h-5 text-secondary mt-0.5"></i>
                        <div>
                            <p class="text-gray-300">Jl. Raya Mekar Sari No. 123</p>
                            <p class="text-gray-300">Kecamatan Semarang Barat</p>
                            <p class="text-gray-300">Kota Semarang, Jawa Tengah</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i data-lucide="phone" class="w-5 h-5 text-secondary"></i>
                        <span class="text-gray-300">+62 24 123 4567</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i data-lucide="mail" class="w-5 h-5 text-secondary"></i>
                        <span class="text-gray-300">info@mekar-sari.desa.id</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i data-lucide="globe" class="w-5 h-5 text-secondary"></i>
                        <span class="text-gray-300">www.mekar-sari.desa.id</span>
                    </div>
                </div>
            </div>

            <!-- Services -->
            <div>
                <h4 class="text-lg font-semibold mb-6">Layanan Desa</h4>
                <ul class="space-y-3">
                    <li class="text-gray-300">Pelayanan Administrasi</li>
                    <li class="text-gray-300">Surat Menyurat</li>
                    <li class="text-gray-300">Pemberdayaan Masyarakat</li>
                    <li class="text-gray-300">Layanan Kesehatan</li>
                    <li class="text-gray-300">Pembinaan UMKM</li>
                    <li class="text-gray-300">Wisata Agro</li>
                </ul>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-white/20 mt-12 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-300 text-sm">
                    © {{ date('Y') }} Desa Mekar Sari. Semua hak dilindungi undang-undang.
                </p>
                <div class="flex items-center space-x-2 mt-4 md:mt-0">
                    <span class="text-gray-300 text-sm">Dibuat dengan</span>
                    <i data-lucide="heart" class="w-4 h-4 text-red-500"></i>
                    <span class="text-gray-300 text-sm">untuk masyarakat desa</span>
                </div>
            </div>
        </div>
    </div>
</footer>