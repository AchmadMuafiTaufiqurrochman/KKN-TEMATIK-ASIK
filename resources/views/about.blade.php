@extends('layouts.app')

@section('title', 'Tentang Desa - Profil Digital Desa Wonokarang')

@section('content')
<section class="py-20 bg-gray-50 pt-10">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-primary mb-4">Tentang Desa Wonokarang</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Desa yang berdiri sejak tahun 1924, kini menjadi salah satu sentra budidaya bunga dan pertanian terbaik di wilayah ini
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-12 items-center mb-16">
                <div>
                    <h3 class="text-2xl font-bold text-primary mb-6">Sejarah dan Perkembangan</h3>
                    <p class="text-gray-700 mb-6 leading-relaxed">
                       Desa Wonokarang yang berada di Kecamatan Balongbendo, Kabupaten Sidoarjo, telah melalui perjalanan panjang sejak awal berdirinya. Pada masa lalu, pemimpin desa dikenal dengan sebutan Kalebhun dan Tenggi, sebelum akhirnya sesuai regulasi terbaru berganti menjadi Kepala Desa. Hingga saat ini, sudah enam Kepala Desa yang pernah memimpin dan turut membawa perubahan bagi kemajuan masyarakat Wonokarang.
                    </p>
                    <p class="text-gray-700 mb-6 leading-relaxed">
                       Dengan luas wilayah ±100,87 hektar, Desa Wonokarang terbagi menjadi tiga dusun, yakni Dusun Karangwungu, Dusun Wonokoyo, dan Dusun Wonokayun. Letaknya yang strategis, sekitar 28 km dari pusat Kabupaten Sidoarjo, menjadikan desa ini berkembang pesat dalam bidang pertanian, UMKM, dan industri rumah tangga. Kehidupan sosial masyarakatnya pun sangat religius, mayoritas beragama Islam, serta tetap menjaga budaya dan tradisi lokal yang diwariskan secara turun-temurun.
                    </p>
                      <p class="text-gray-700 mb-6 leading-relaxed">
                       Sejak adanya program Dana Desa pada tahun 2015, pembangunan infrastruktur di Wonokarang semakin pesat, mulai dari jalan desa, sarana umum, hingga fasilitas kesehatan dan pendidikan. Dengan dukungan gotong royong masyarakat serta kearifan lokal yang masih terjaga, Desa Wonokarang kini terus berkembang menjadi desa yang mandiri, religius, dan berdaya saing, sekaligus tetap mempertahankan jati dirinya sebagai desa yang kaya akan budaya dan nilai kebersamaan.
                    </p>
                    <div class="bg-secondary p-6 rounded-lg">
                        <blockquote class="text-primary font-semibold text-lg italic">
                            "Dengan semangat gotong royong dan inovasi, kami terus berkarya untuk kemajuan desa dan kesejahteraan masyarakat."
                        </blockquote>
                        <cite class="text-primary font-medium mt-2 block">- Kepala Desa Wonokarang</cite>
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
                    <p class="text-gray-600">Kepala Desa Wonokarang</p>
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

<section class="py-20 bg-white pt-10">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-primary mb-4">Video Profil Desa</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Saksikan keindahan dan potensi Desa Wonokarang melalui video profil yang menampilkan kehidupan sehari-hari masyarakat
            </p>
        </div>

        @if($video)
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="relative">
                    <div class="aspect-w-16 aspect-h-9">
                        <iframe
                            src="{{ $video->video_url }}"
                            title="{{ $video->title }}"
                            frameBorder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowFullScreen
                            class="w-full h-96 lg:h-[500px] rounded-t-2xl"
                        ></iframe>
                    </div>
                </div>
                
                <div class="p-8">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-6">
                        <div>
                            <h3 class="text-2xl font-bold text-primary mb-2">
                                {{ $video->title }}
                            </h3>
                            <div class="flex items-center gap-6 text-gray-600">
                                <div class="flex items-center gap-2">
                                    <i data-lucide="calendar" class="w-4 h-4"></i>
                                    <span>Dipublikasikan {{ $video->created_at->format('d F Y') }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                    <span>{{ number_format($video->views) }} views</span>
                                </div>
                            </div>
                        </div>
                        
                        <button class="mt-4 lg:mt-0 bg-secondary text-primary px-6 py-3 rounded-lg font-semibold hover:bg-yellow-400 transition-colors flex items-center gap-2">
                            <i data-lucide="download" class="w-5 h-5"></i>
                            Download Video
                        </button>
                    </div>
                    
                    <div class="prose prose-gray max-w-none">
                        <p class="text-gray-700 leading-relaxed mb-4">
                            {{ $video->description }}
                        </p>
                        
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Dalam video berdurasi {{ $video->duration }} ini, Anda akan melihat bagaimana teknologi modern dipadukan dengan 
                            kearifan lokal untuk menciptakan sistem pertanian yang berkelanjutan. Desa Wonokarang tidak hanya 
                            menjadi tempat tinggal, tetapi juga destinasi wisata agro yang mengedukasi tentang pertanian modern.
                        </p>
                        
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-primary mb-2">Highlight Video:</h4>
                            <ul class="text-gray-700 space-y-1">
                                <li>• Pemandangan udara hamparan sawah dan kebun bunga</li>
                                <li>• Aktivitas petani dengan teknologi modern</li>
                                <li>• Proses budidaya bunga dari bibit hingga panen</li>
                                <li>• Kehidupan sosial dan budaya masyarakat</li>
                                <li>• Fasilitas desa dan infrastruktur pendukung</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="text-center py-12">
            <p class="text-gray-500">Video profil belum tersedia</p>
        </div>
        @endif
    </div>
</section>
@endsection