@extends('layouts.admin')

@section('title', 'Manajemen Video - Admin Desa Mekar Sari')

@section('content')
<div class="min-h-screen bg-gray-50 pt-0">
    <!-- Admin Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-primary">Manajemen Video</h1>
                    <p class="text-gray-600">Kelola video dokumentasi dan profil desa</p>
                </div>
                
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center gap-3">
                <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
                <span class="text-green-700">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Statistics -->
        <div class="grid md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center">
                        <i data-lucide="play" class="w-6 h-6 text-white"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $stats['total'] }}</h3>
                <p class="text-gray-600 text-sm">Total Video</p>
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

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 mb-6">
            <button onclick="openAddModal()" class="bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800 transition-colors flex items-center gap-2">
                <i data-lucide="plus" class="w-5 h-5"></i>
                Tambah Video
            </button>
            <button class="bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition-colors flex items-center gap-2">
                <i data-lucide="upload" class="w-5 h-5"></i>
                Upload Batch
            </button>
        </div>

        <!-- Category Filter -->
        <div class="flex flex-wrap gap-4 mb-8">
            @foreach($categories as $key => $count)
            <a href="{{ route('admin.videos.index', ['category' => $key]) }}" 
               class="px-6 py-3 rounded-full font-semibold transition-colors {{ request('category', 'all') === $key ? 'bg-primary text-white' : 'bg-white text-primary hover:bg-secondary hover:text-primary border border-gray-200' }}">
                {{ ucfirst($key === 'all' ? 'Semua' : ($key === 'profil' ? 'Profil Desa' : $key)) }} ({{ $count }})
            </a>
            @endforeach
        </div>

        <!-- Videos Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($videos as $video)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="relative group">
                    <img
                        src="{{ $video->thumbnail }}"
                        alt="{{ $video->title }}"
                        class="w-full h-48 object-cover"
                    />
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                            <i data-lucide="play" class="w-8 h-8 text-white ml-1"></i>
                        </div>
                    </div>
                    <div class="absolute bottom-2 right-2 bg-black/70 text-white px-2 py-1 rounded text-sm">
                        {{ $video->duration }}
                    </div>
                    <div class="absolute top-2 left-2">
                        <span class="px-2 py-1 rounded text-xs font-semibold {{ $video->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-orange-100 text-orange-800' }}">
                            {{ $video->status === 'published' ? 'Published' : 'Draft' }}
                        </span>
                    </div>
                    <div class="absolute top-2 right-2">
                        <span class="px-2 py-1 rounded text-xs font-semibold 
                            @if($video->category === 'kesehatan') bg-red-100 text-red-800
                            @elseif($video->category === 'perempuan') bg-purple-100 text-purple-800
                            @elseif($video->category === 'pertanian') bg-green-100 text-green-800
                            @else bg-blue-100 text-blue-800
                            @endif">
                            {{ ucfirst($video->category) }}
                        </span>
                    </div>
                </div>
                
                <div class="p-6">
                    <h3 class="text-lg font-bold text-primary mb-2 line-clamp-2">
                        {{ $video->title }}
                    </h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                        {{ $video->description }}
                    </p>
                    
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                        <div class="flex items-center gap-1">
                            <i data-lucide="eye" class="w-4 h-4"></i>
                            <span>{{ number_format($video->views) }} views</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <i data-lucide="calendar" class="w-4 h-4"></i>
                            <span>{{ $video->created_at->format('d M Y') }}</span>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button onclick="openEditModal({{ $video->id }})" class="flex-1 bg-secondary text-primary py-2 px-4 rounded-lg font-semibold hover:bg-yellow-400 transition-colors flex items-center justify-center gap-2">
                            <i data-lucide="edit" class="w-4 h-4"></i>
                            Edit
                        </button>
                        <form action="{{ route('admin.videos.destroy', $video) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus video ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition-colors">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500">Tidak ada video dalam kategori ini</p>
            </div>
            @endforelse
        </div>

        @if($videos->hasPages())
        <div class="mt-8">
            {{ $videos->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Add/Edit Modal -->
<div id="videoModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-lg w-full p-6 max-h-[90vh] overflow-y-auto">
            <h3 id="modalTitle" class="text-lg font-bold text-primary mb-4">Tambah Video Baru</h3>
            
            <form id="videoForm" method="POST">
                @csrf
                <div id="methodField"></div>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul Video</label>
                        <input type="text" name="title" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select name="category" required class="w-full px-3 py-2 border  text-gray-800 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            <option value="">Pilih Kategori</option>
                            <option value="profil">Profil Desa</option>
                            <option value="kesehatan">Kesehatan</option>
                            <option value="perempuan">Perempuan</option>
                            <option value="pertanian">Pertanian</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">URL Video (YouTube Embed)</label>
                        <input type="url" name="video_url" required placeholder="https://www.youtube.com/embed/..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">URL Thumbnail</label>
                        <input type="url" name="thumbnail" required placeholder="https://..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description" required rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"></textarea>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Durasi</label>
                            <input type="text" name="duration" required placeholder="5:42" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select name="status" required class="w-full px-3 py-2 border  text-gray-800 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="flex gap-4 mt-6">
                    <button type="submit" class="flex-1 bg-primary text-white py-2 rounded-lg hover:bg-blue-800 transition-colors">
                        Simpan
                    </button>
                    <button type="button" onclick="closeVideoModal()" class="flex-1 bg-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-400 transition-colors">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openAddModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Video Baru';
    document.getElementById('videoForm').action = '{{ route("admin.videos.store") }}';
    document.getElementById('methodField').innerHTML = '';
    document.getElementById('videoForm').reset();
    document.getElementById('videoModal').classList.remove('hidden');
}

function openEditModal(id) {
    document.getElementById('modalTitle').textContent = 'Edit Video';
    document.getElementById('videoForm').action = `/admin/videos/${id}`;
    document.getElementById('methodField').innerHTML = '@method("PUT")';
    document.getElementById('videoModal').classList.remove('hidden');
}

function closeVideoModal() {
    document.getElementById('videoModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('videoModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeVideoModal();
    }
});
</script>
@endsection