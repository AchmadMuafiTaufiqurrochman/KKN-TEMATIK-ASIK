@extends('layouts.app')

@section('title', 'Tentang Desa - Profil Digital Desa Mekar Sari')

@section('content')
<section class="py-20 bg-gray-50 pt-32">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-primary mb-4">Tentang Desa Mekar Sari</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Desa yang berdiri sejak tahun 1945, kini menjadi salah satu sentra budidaya bunga dan pertanian terbaik di wilayah ini
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-12 items-center mb-16">
                <div>
                    <h3 class="text-2xl font-bold text-primary mb-6">Sejarah dan Perkembangan</h3>
                    <p class="text-gray-700 mb-6 leading-relaxed">
                        Desa Mekar Sari didirikan pada tahun 1945 oleh para transmigran yang ingin membangun kehidupan baru. 
                        Dengan tanah yang subur dan iklim yang mendukung, desa ini berkembang menjadi pusat pertanian dan budidaya bunga.
                    </p>
                    <p class="text-gray-700 mb-6 leading-relaxed">
                        Seiring berjalannya waktu, masyarakat desa mulai mengembangkan teknik budidaya modern dan sustainable farming 
                        yang ramah lingkungan. Kini, Desa Mekar Sari dikenal sebagai salah satu desa wisata agro terbaik.
                    </p>
                    
                    <div class="bg-secondary p-6 rounded-lg">
                        <blockquote class="text-primary font-semibold text-lg italic">
                            "Dengan semangat gotong royong dan inovasi, kami terus berkarya untuk kemajuan desa dan kesejahteraan masyarakat."
                        </blockquote>
                        <cite class="text-primary font-medium mt-2 block">- Kepala Desa Mekar Sari</cite>
                    </div>
                </div>

                <div class="flex flex-col items-center">
                    <div class="w-64 h-64 rounded-full overflow-hidden mb-6 border-4 border-secondary">
                        <img 
                            src="https://images.pexels.com/photos/1300402/pexels-photo-1300402.jpeg?auto=compress&cs=tinysrgb&w=500" 
                            alt="Kepala Desa"
                            class="w-full h-full object-cover"
                        />
                    </div>
                    <h4 class="text-xl font-bold text-primary mb-2">Bapak Sutrisno</h4>
                    <p class="text-gray-600">Kepala Desa Mekar Sari</p>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                    <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="target" class="w-8 h-8 text-white"></i>
                    </div>
                    <h4 class="text-xl font-bold text-primary mb-4">Misi Desa</h4>
                    <p class="text-gray-600">
                        Mengembangkan potensi pertanian dan budidaya bunga dengan teknologi modern 
                        untuk meningkatkan kesejahteraan masyarakat
                    </p>
                </div>

                <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                    <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="eye" class="w-8 h-8 text-white"></i>
                    </div>
                    <h4 class="text-xl font-bold text-primary mb-4">Visi Desa</h4>
                    <p class="text-gray-600">
                        Menjadi desa mandiri, sejahtera, dan berkelanjutan melalui pengembangan 
                        sektor pertanian dan pariwisata agro
                    </p>
                </div>

                <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                    <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="award" class="w-8 h-8 text-white"></i>
                    </div>
                    <h4 class="text-xl font-bold text-primary mb-4">Prestasi</h4>
                    <p class="text-gray-600">
                        Meraih berbagai penghargaan tingkat kabupaten dan provinsi untuk 
                        inovasi pertanian dan pemberdayaan masyarakat
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection