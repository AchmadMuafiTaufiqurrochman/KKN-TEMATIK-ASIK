@extends('layouts.app')

@section('title', 'Video Profil - Profil Digital Desa Mekar Sari')

@section('content')
<section class="py-20 bg-white pt-10">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-primary mb-4">Video Profil Desa</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Saksikan keindahan dan potensi Desa Mekar Sari melalui video profil yang menampilkan kehidupan sehari-hari masyarakat
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
                            kearifan lokal untuk menciptakan sistem pertanian yang berkelanjutan. Desa Mekar Sari tidak hanya 
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