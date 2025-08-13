    @extends('layouts.admin')

    @section('title', 'Manajemen Video - Admin Desa Wonokarang')

    @section('content')

    @php
        function getEmbedCode($url)
        {
            $iframeClass = 'w-full h-auto max-h-[80vh] object-contain rounded-lg';

            // YouTube
            if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
                preg_match('/(youtu\.be\/|v=)([^&]+)/', $url, $matches);
                $videoId = $matches[2] ?? '';
                return "<iframe class='{$iframeClass}' src='https://www.youtube.com/embed/{$videoId}' frameborder='0' allowfullscreen></iframe>";
            }
            // Instagram
            elseif (strpos($url, 'instagram.com') !== false) {
                return '
            <div class="flex justify-center">
                <blockquote class="instagram-media" data-instgrm-permalink="' .
                    $url .
                    '" data-instgrm-version="14"></blockquote>
            </div>
            <script async src="//www.instagram.com/embed.js"></script>
        ';
            }
            // TikTok
            elseif (strpos($url, 'tiktok.com') !== false) {
                return "<iframe class='{$iframeClass}' src='{$url}embed' frameborder='0' allowfullscreen></iframe>";
            }
            // Facebook
            elseif (strpos($url, 'facebook.com') !== false) {
                return "<iframe class='{$iframeClass}' src='{$url}embed' frameborder='0' allowfullscreen></iframe>";
            }

            return '<p>Video tidak dapat ditampilkan. Platform tidak dikenali.</p>';
        }
    @endphp
    
        <div class="min-h-screen bg-gray-50 pt-0">
            <!-- Admin Header -->
            <div class="bg-white shadow-sm border-b">
                <div class="container mx-auto px-4 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-primary">Manajemen Berita</h1>
                            <p class="text-gray-600">Kelola berita dokumentasi dan profil desa</p>
                        </div>

                    </div>
                </div>
            </div>

            <div class="container mx-auto px-4 py-8">
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center gap-3">
                        <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
                        <span class="text-green-700">{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Statistics -->
                <div class="grid md:grid-cols-5 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center">
                                <i data-lucide="newspaper" class="w-6 h-6 text-white"></i>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $stats['total'] }}</h3>
                        <p class="text-gray-600 text-sm">Total Berita</p>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center">
                                <i data-lucide="play" class="w-6 h-6 text-white"></i>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $stats['video_count'] ?? 0 }}</h3>
                        <p class="text-gray-600 text-sm">Video</p>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-pink-600 rounded-lg flex items-center justify-center">
                                <i data-lucide="image" class="w-6 h-6 text-white"></i>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $stats['image_count'] ?? 0 }}</h3>
                        <p class="text-gray-600 text-sm">Gambar</p>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center">
                                <i data-lucide="eye" class="w-6 h-6 text-white"></i>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ number_format($stats['total_views']) }}</h3>
                        <p class="text-gray-600 text-sm">Total Views</p>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center">
                                <i data-lucide="upload" class="w-6 h-6 text-white"></i>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $stats['published'] }}</h3>
                        <p class="text-gray-600 text-sm">Published</p>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-orange-600 rounded-lg flex items-center justify-center">
                                <i data-lucide="edit" class="w-6 h-6 text-white"></i>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $stats['draft'] }}</h3>
                        <p class="text-gray-600 text-sm">Draft</p>
                    </div>
                </div>

                <!-- Action Section -->
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-6">
                    <!-- Tambah Video -->
                    <a href="{{ route('admin.videos.create') }}"
                        class="bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800 transition-colors flex items-center gap-2">
                        <i data-lucide="plus" class="w-5 h-5"></i>
                        Tambah Berita
                    </a>
                    <!-- Search Form -->
                    <form method="GET" action="{{ route('admin.videos.index') }}" class="flex w-full sm:w-auto">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari video..."
                            class="px-4 py-2 border text-gray-600 border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-primary w-full sm:w-64">
                        <button type="submit"
                            class="px-4 py-2 bg-primary text-gray-600 rounded-r-lg hover:bg-blue-800 transition-colors flex items-center">
                            <i data-lucide="search" class="w-4 h-4"></i>
                        </button>
                    </form>
                </div>


                <!-- Category Filter -->
                <div class="flex flex-wrap gap-4 mb-8">
                    @foreach ($categories as $key => $count)
                        <a href="{{ route('admin.videos.index', ['category' => $key]) }}"
                            class="px-6 py-3 rounded-full font-semibold transition-colors {{ request('category', 'all') === $key ? 'bg-primary text-white' : 'bg-white text-primary hover:bg-secondary hover:text-primary border border-gray-200' }}">
                            {{ ucfirst($key === 'all' ? 'Semua' : ($key === 'profil' ? 'Profil Desa' : $key)) }}
                            ({{ $count }})
                        </a>
                    @endforeach
                </div>

                <!-- Videos Grid -->
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($videos as $video)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                            <div class="relative group">
                                <img src="{{ asset($video->thumbnail) }}" alt="{{ $video->title }}"
                                 class="w-full h-48 object-cover" />

                                <div
                                    class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <div
                                        class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                        @if ($video->type === 'video')
                                            <i data-lucide="play" class="w-8 h-8 text-white ml-1"></i>
                                        @else
                                            <i data-lucide="image" class="w-8 h-8 text-white"></i>
                                        @endif

                                    </div>
                                </div>
                                <!-- Status: kanan atas -->
                                <div class="absolute top-2 right-2">
                                    @if ($video->is_finished)
                                        <span
                                            class="inline-block px-2 py-1 text-xs bg-green-100 text-green-800 rounded">Selesai</span>
                                    @else
                                        <span
                                            class="inline-block px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded">Akan
                                            Dimulai</span>
                                    @endif
                                </div>
                                @if ($video->content_type === 'video')
                                    <div class="absolute bottom-2 right-2 bg-black/70 text-white px-2 py-1 rounded text-sm">
                                        {{ $video->duration }}
                                    </div>
                                    <div class="absolute top-2 left-2">
                                        <span
                                            class="px-2 py-1 rounded text-xs font-semibold {{ $video->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-orange-100 text-orange-800' }}">
                                            {{ $video->status === 'published' ? 'Published' : 'Draft' }}
                                        </span>
                                    </div>
                                    <div class="absolute top-2 right-2 ">
                                        @php
                                            $categoryColors = [
                                                'profil' => 'bg-blue-100 text-blue-800',
                                                'kesehatan' => 'bg-red-100 text-red-800',
                                                'ekonomi' => 'bg-purple-100 text-purple-800',
                                                'pertanian' => 'bg-green-100 text-green-800',
                                                'pemerintahan' => 'bg-yellow-100 text-yellow-800',
                                                'pembangunan' => 'bg-indigo-100 text-indigo-800',
                                                'kegiatan' => 'bg-pink-100 text-pink-800',
                                                'pengumuman' => 'bg-teal-100 text-teal-800',
                                                'berita' => 'bg-cyan-100 text-cyan-800',
                                                'umkm' => 'bg-lime-100 text-lime-800',
                                                'karangtaruna' => 'bg-orange-100 text-orange-800',
                                                'budidayabunga' => 'bg-pink-100 text-pink-800',
                                            ];
                                        @endphp

                                        <span
                                            class="px-2 py-1 rounded text-xs font-semibold {{ $categoryColors[$video->category] ?? 'bg-gray-100 text-gray-800' }}">
                                            {{ $video->category_text }}
                                        </span>

                                    </div>
                                @endif
                            </div>

                            <div class="p-6">
                                <h3 class="text-lg font-bold text-primary mb-2 line-clamp-2">
                                    {{ $video->title }}
                                </h3>
                                <div class="text-gray-600 text-sm mb-4 line-clamp-2">
                                    {!! $video->description !!}
                                </div>


                                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                    <div class="flex items-center gap-1">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                        <span>{{ number_format($video->views) }} views</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <i data-lucide="calendar" class="w-4 h-4"></i>
                                        <span>
                                            {{ $video->started_at ? \Carbon\Carbon::parse($video->started_at)->translatedFormat('d M Y') : 'Belum ada tanggal' }}
                                        </span>

                                    </div>
                                </div>

                                <div class="flex gap-2">
                                    <a href="{{ route('admin.videos.edit', $video->id) }}"
                                        class="flex-1 bg-secondary text-primary py-2 px-4 rounded-lg font-semibold hover:bg-yellow-400 transition-colors flex items-center justify-center gap-2">
                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                        Edit
                                    </a>


                                    <form action="{{ route('admin.videos.destroy', $video) }}" method="POST"
                                        class="inline" onsubmit="return confirm('Yakin ingin menghapus video ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition-colors">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <p class="text-gray-500">Tidak ada berita dalam kategori ini</p>
                        </div>
                    @endforelse
                </div>

                @if ($videos->hasPages())
                    <div class="mt-8">
                        {{ $videos->links() }}
                    </div>
                @endif
            </div>
        </div>


        <!-- QuillJS CDN -->
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <style>
            .quill-black-text .ql-editor {
                color: #222 !important;
                background: #fff;
            }
        </style>
        <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

        <script>
            let quill;
            document.addEventListener('DOMContentLoaded', function() {
                quill = new Quill('#quill-description', {
                    theme: 'snow',
                    placeholder: 'Tulis deskripsi...'
                });

                // Submit value Quill ke input hidden
                document.getElementById('videoForm').addEventListener('submit', function(e) {
                    document.getElementById('description-input').value = quill.root.innerHTML;
                });

                document.getElementById('typeSelect').addEventListener('change', function() {
                    const selected = this.value;
                    const videoFields = document.getElementById('videoFields');
                    const gambarFields = document.getElementById('gambarFields');
                    if (selected === 'video') {
                        videoFields.classList.remove('hidden');
                        gambarFields.classList.add('hidden');
                    } else if (selected === 'gambar') {
                        gambarFields.classList.remove('hidden');
                        videoFields.classList.add('hidden');
                    } else {
                        videoFields.classList.add('hidden');
                        gambarFields.classList.add('hidden');
                    }
                });

                // Close modal when clicking outside
                document.getElementById('videoModal').addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeVideoModal();
                    }
                });
            });

            function openAddModal() {
                document.getElementById('modalTitle').textContent = 'Tambah Berita Baru';
                document.getElementById('videoForm').action = '{{ route('admin.videos.store') }}';
                document.getElementById('methodField').innerHTML = '';
                document.getElementById('videoForm').reset();
                document.getElementById('videoModal').classList.remove('hidden');
                document.getElementById('videoFields').classList.add('hidden');
                document.getElementById('gambarFields').classList.add('hidden');
                if (window.quill) quill.setContents([]);
            }

            function openEditModal(id) {
                document.getElementById('modalTitle').textContent = 'Edit Video';
                document.getElementById('videoForm').action = `/admin/videos/${id}`;
                document.getElementById('methodField').innerHTML = '@method('PUT')';
                document.getElementById('videoModal').classList.remove('hidden');
            }

            function closeVideoModal() {
                document.getElementById('videoModal').classList.add('hidden');
            }
        </script>
    @endsection
