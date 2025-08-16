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
                            <p class="text-gray-600">Kelola berita dokumentasi dan profil desa (diurutkan berdasarkan tanggal acara)</p>
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
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
                    <div class="bg-white p-4 rounded-xl shadow-lg">
                        <div class="flex items-center justify-between mb-2">
                            <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center">
                                <i data-lucide="newspaper" class="w-5 h-5 text-white"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $stats['total'] }}</h3>
                        <p class="text-gray-600 text-xs">Total Berita</p>
                    </div>

                    <div class="bg-white p-4 rounded-xl shadow-lg">
                        <div class="flex items-center justify-between mb-2">
                            <div class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center">
                                <i data-lucide="play" class="w-5 h-5 text-white"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $stats['video_count'] ?? 0 }}</h3>
                        <p class="text-gray-600 text-xs">Video</p>
                    </div>

                    <div class="bg-white p-4 rounded-xl shadow-lg">
                        <div class="flex items-center justify-between mb-2">
                            <div class="w-10 h-10 bg-pink-600 rounded-lg flex items-center justify-center">
                                <i data-lucide="image" class="w-5 h-5 text-white"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $stats['image_count'] ?? 0 }}</h3>
                        <p class="text-gray-600 text-xs">Gambar</p>
                    </div>

                    <div class="bg-white p-4 rounded-xl shadow-lg">
                        <div class="flex items-center justify-between mb-2">
                            <div class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center">
                                <i data-lucide="eye" class="w-5 h-5 text-white"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-1">{{ number_format($stats['total_views']) }}</h3>
                        <p class="text-gray-600 text-xs">Total Views</p>
                    </div>

                    <div class="bg-white p-4 rounded-xl shadow-lg">
                        <div class="flex items-center justify-between mb-2">
                            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                <i data-lucide="upload" class="w-5 h-5 text-white"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $stats['published'] }}</h3>
                        <p class="text-gray-600 text-xs">Published</p>
                    </div>

                    <div class="bg-white p-4 rounded-xl shadow-lg">
                        <div class="flex items-center justify-between mb-2">
                            <div class="w-10 h-10 bg-orange-600 rounded-lg flex items-center justify-center">
                                <i data-lucide="edit" class="w-5 h-5 text-white"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $stats['draft'] }}</h3>
                        <p class="text-gray-600 text-xs">Draft</p>
                    </div>
                </div>

                <!-- Action Section -->
                <div class="flex flex-col gap-4 mb-6">
                    <!-- Tambah Video Button -->
                    <a href="{{ route('admin.videos.create') }}"
                        class="bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800 transition-colors flex items-center gap-2 justify-center w-full sm:w-auto">
                        <i data-lucide="plus" class="w-5 h-5"></i>
                        Tambah Berita
                    </a>
                    
                    <!-- Search Form -->
                    <form method="GET" action="{{ route('admin.videos.index') }}" class="flex flex-col sm:flex-row gap-3">
                        <div class="flex-1">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berita..."
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-sm">
                        </div>
                        <div class="flex gap-2">
                            <select name="category" class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary text-sm flex-1 sm:flex-none">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $key => $count)
                                    @if($key !== 'all')
                                        <option value="{{ $key }}" {{ request('category') === $key ? 'selected' : '' }}>
                                            {{ ucfirst($key === 'profil' ? 'Profil Desa' : $key) }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <button type="submit" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-blue-800 transition-colors flex items-center gap-2">
                                <i data-lucide="search" class="w-4 h-4"></i>
                                <span class="hidden sm:inline">Cari</span>
                            </button>
                        </div>
                    </form>
                </div>


                <!-- Category Filter -->
                <div class="flex flex-wrap gap-2 sm:gap-4 mb-8">
                    @foreach ($categories as $key => $count)
                        <a href="{{ route('admin.videos.index', ['category' => $key]) }}"
                            class="px-3 sm:px-6 py-2 sm:py-3 rounded-full text-sm sm:text-base font-semibold transition-colors {{ request('category', 'all') === $key ? 'bg-primary text-white' : 'bg-white text-primary hover:bg-secondary hover:text-primary border border-gray-200' }}">
                            {{ ucfirst($key === 'all' ? 'Semua' : ($key === 'profil' ? 'Profil Desa' : $key)) }}
                            ({{ $count }})
                        </a>
                    @endforeach
                </div>

                <!-- Videos Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
                    @forelse($videos as $video)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            <div class="relative group">
                               <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="{{ $video->title }}" class="w-full h-48 object-cover" />
                                <div
                                    class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    @if ($video->type === 'video')
                                        <i data-lucide="play" class="w-8 h-8 text-white ml-1"></i>
                                    @else
                                        <i data-lucide="image" class="w-8 h-8 text-white"></i>
                                    @endif
                                </div>

                                <!-- Status Published/Draft - kiri atas -->
                                <div class="absolute top-2 left-2">
                                    @if ($video->status === 'published')
                                        <span class="inline-block px-2 py-1 text-xs bg-green-100 text-green-800 rounded font-semibold">
                                            <i data-lucide="check-circle" class="w-3 h-3 inline mr-1"></i>
                                            <span class="hidden sm:inline">Published</span>
                                            <span class="sm:hidden">Pub</span>
                                        </span>
                                    @else
                                        <span class="inline-block px-2 py-1 text-xs bg-orange-100 text-orange-800 rounded font-semibold">
                                            <i data-lucide="edit" class="w-3 h-3 inline mr-1"></i>
                                            <span class="hidden sm:inline">Draft</span>
                                            <span class="sm:hidden">Drf</span>
                                        </span>
                                    @endif
                                </div>

                                <!-- Category - kanan atas -->
                                <div class="absolute top-2 right-2">
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
                                    <span class="px-2 py-1 rounded text-xs font-semibold {{ $categoryColors[$video->category] ?? 'bg-gray-100 text-gray-800' }}">
                                        <span class="hidden sm:inline">{{ $video->category_text }}</span>
                                        <span class="sm:hidden">{{ substr($video->category_text, 0, 3) }}</span>
                                    </span>
                                </div>

                                <!-- Duration untuk video - kanan bawah -->
                                @if ($video->type === 'video' && $video->duration)
                                    <div class="absolute bottom-2 right-2 bg-black/70 text-white px-2 py-1 rounded text-sm">
                                        {{ $video->duration }}
                                    </div>
                                @endif

                                <!-- Status Finished/Will Start - kiri bawah -->
                                @if(isset($video->is_finished))
                                    <div class="absolute bottom-2 left-2">
                                        @if ($video->is_finished)
                                            <span class="inline-block px-2 py-1 text-xs bg-green-100 text-green-800 rounded">
                                                <i data-lucide="check" class="w-3 h-3 inline mr-1"></i>
                                                <span class="hidden sm:inline">Selesai</span>
                                            </span>
                                        @else
                                            <span class="inline-block px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded">
                                                <i data-lucide="clock" class="w-3 h-3 inline mr-1"></i>
                                                <span class="hidden sm:inline">Akan Dimulai</span>
                                            </span>
                                        @endif
                                    </div>
                                @endif
                            </div>

            <div class="p-4 sm:p-6">
                <h3 class="text-lg font-bold text-primary mb-2 line-clamp-2">
                    {{ $video->title }}
                </h3>
                <div class="text-gray-600 text-sm mb-4 line-clamp-2">
                    {!! $video->description !!}
                </div>

                <!-- Status info dalam card -->
                <div class="flex items-center justify-between text-xs text-gray-500 mb-2">
                    <div class="flex items-center gap-2">
                        <span class="flex items-center gap-1">
                            @if ($video->status === 'published')
                                <i data-lucide="globe" class="w-3 h-3 text-green-600"></i>
                                <span class="text-green-600 font-medium">Dipublikasi</span>
                            @else
                                <i data-lucide="file-text" class="w-3 h-3 text-orange-600"></i>
                                <span class="text-orange-600 font-medium">Draft</span>
                            @endif
                        </span>
                        <span class="text-gray-400">•</span>
                        <span class="capitalize">{{ $video->type }}</span>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between text-sm text-gray-500 mb-4 gap-2">
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

                <div class="flex flex-col sm:flex-row gap-2">
                    <a href="{{ route('admin.videos.edit', $video->id) }}"
                        class="flex-1 bg-secondary text-primary py-2 px-4 rounded-lg font-semibold hover:bg-yellow-400 transition-colors flex items-center justify-center gap-2">
                        <i data-lucide="edit" class="w-4 h-4"></i>
                        Edit
                    </a>

                    <form action="{{ route('admin.videos.destroy', $video) }}" method="POST"
                        class="flex-1 sm:flex-none" onsubmit="return confirm('Yakin ingin menghapus video ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition-colors flex items-center justify-center gap-2">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                            <span class="sm:hidden">Hapus</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-12">
            <i data-lucide="video-off" class="w-16 h-16 text-gray-400 mx-auto mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">Tidak ada berita</h3>
            <p class="text-gray-500 mb-6">
                @if(request('search') || request('category'))
                    Tidak ada berita yang sesuai dengan pencarian atau filter Anda.
                @else
                    Belum ada berita yang ditambahkan.
                @endif
            </p>
            @if(request('search') || request('category'))
                <a href="{{ route('admin.videos.index') }}" 
                    class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-800 transition-colors">
                    <i data-lucide="x" class="w-4 h-4"></i>
                    Hapus Filter
                </a>
            @else
                <a href="{{ route('admin.videos.create') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-blue-800 transition-colors">
                    <i data-lucide="plus" class="w-5 h-5"></i>
                    Tambah Berita Pertama
                </a>
            @endif
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
