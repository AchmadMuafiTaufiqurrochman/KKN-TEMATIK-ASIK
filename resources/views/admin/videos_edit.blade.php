@extends('layouts.admin')

@section('title', 'Edit Berita - Admin Desa Wonokarang')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-primary">Edit Berita</h1>
        <a href="{{ route('admin.videos.index') }}"
            class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg text-sm">
            ← Kembali ke Daftar
        </a>
    </div>

    <form action="{{ route('admin.videos.update', $video->id) }}" method="POST" enctype="multipart/form-data" id="videoForm">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">

            {{-- KONTEN UTAMA --}}
            <div class="md:col-span-2 space-y-4 min-h-[620px]">
                <div>
                    <input type="text" name="title" placeholder="Judul artikel"
                        value="{{ old('title', $video->title) }}"
                        class="w-full text-3xl font-bold text-gray-800 px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary"
                        required>
                </div>

                <div>
                    <div id="quill-description" class="h-full min-h-[600px] text-gray-800 bg-white border border-gray-300 rounded">
                        {!! $video->description !!}
                    </div>
                    <input type="hidden" name="description" id="description-input">
                </div>
            </div>

            {{-- SIDEBAR --}}
            <div class="space-y-4">
                {{-- KATEGORI --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                    <div class="space-y-1">
                        @foreach ($categories as $cat)
                            <label class="inline-flex items-center space-x-2 text-gray-800">
                                <input type="radio" name="category" value="{{ $cat }}"
                                    {{ $video->category === $cat ? 'checked' : '' }}
                                    class="text-primary focus:ring-primary text-gray-800">
                                <span>{{ ucfirst($cat) }}</span>
                            </label><br>
                        @endforeach
                    </div>
                </div>

                {{-- TIPE BERITA --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tipe Berita</label>
                    <div class="space-y-1">
                        <label class="inline-flex items-center space-x-2 text-gray-800">
                            <input type="radio" name="type" value="video"
                                {{ $video->type === 'video' ? 'checked' : '' }}
                                class="text-primary" onclick="toggleFields('video')">
                            <span>Video</span>
                        </label><br>
                        <label class="inline-flex items-center space-x-2 text-gray-800">
                            <input type="radio" name="type" value="gambar"
                                {{ $video->type === 'gambar' ? 'checked' : '' }}
                                class="text-primary" onclick="toggleFields('gambar')">
                            <span>Gambar</span>
                        </label>
                    </div>
                </div>

                {{-- TANGGAL --}}
                <div>
                    <label for="started_at" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal</label>
                    <input type="date" name="started_at" id="started_at"
                        value="{{ old('started_at', \Carbon\Carbon::parse($video->started_at)->format('Y-m-d')) }}"
                        class="w-full px-3 py-2 border rounded border-gray-300 text-gray-800 focus:ring-indigo-200">
                </div>

                {{-- STATUS --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                    <select name="status"
                        class="w-full px-3 py-2 border rounded border-gray-300 text-gray-800 focus:outline-none focus:ring-primary">
                        <option value="draft" {{ $video->status === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ $video->status === 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>

                {{-- FIELD VIDEO --}}
                <div id="videoFields" class="space-y-2 {{ $video->type !== 'video' ? 'hidden' : '' }}">
                    <label class="block text-sm font-semibold text-gray-700">URL Video (Embed YouTube)</label>
                    <input type="url" name="video_url" value="{{ old('video_url', $video->video_url) }}"
                        class="w-full px-3 py-2 border text-gray-800 rounded border-gray-300">

                    <label class="block text-sm font-semibold text-gray-700">Thumbnail (URL)</label>
                    <input type="url" name="thumbnail" value="{{ old('thumbnail', $video->thumbnail) }}"
                        class="w-full px-3 py-2 border text-gray-800 rounded border-gray-300">

                    <label class="block text-sm font-semibold text-gray-700">Durasi</label>
                    <input type="text" name="duration" value="{{ old('duration', $video->duration) }}"
                        class="w-full px-3 py-2 border text-gray-800 rounded border-gray-300">
                </div>

                {{-- FIELD GAMBAR --}}
                <div id="gambarFields" class="space-y-2 {{ $video->type !== 'gambar' ? 'hidden' : '' }}">
                    <label class="block text-sm font-semibold text-gray-700">Upload Gambar Baru (Opsional)</label>
                    <input type="file" name="thumbnail" accept="image/*"
                        class="w-full px-3 py-2 border rounded text-gray-800 border-gray-300">
                    @if ($video->thumbnail)
                        <p class="text-sm text-gray-600 mt-1">Thumbnail sekarang:</p>
                        <img src="{{ asset($video->thumbnail) }}" class="w-full max-h-48 rounded shadow">
                    @endif
                </div>
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit"
                class="bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800 transition-colors">
                Perbarui
            </button>
        </div>
    </form>
</div>

{{-- QUILL --}}
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const quill = new Quill('#quill-description', {
            theme: 'snow',
            placeholder: 'Tulis isi berita di sini...'
        });

        // Set value ke input hidden saat submit
        document.getElementById('videoForm').addEventListener('submit', function () {
            document.getElementById('description-input').value = quill.root.innerHTML;
        });

        // Toggle field saat load awal
        toggleFields('{{ $video->type }}');
    });

    function toggleFields(type) {
        const video = document.getElementById('videoFields');
        const gambar = document.getElementById('gambarFields');

        video.classList.add('hidden');
        gambar.classList.add('hidden');

        if (type === 'video') video.classList.remove('hidden');
        if (type === 'gambar') gambar.classList.remove('hidden');
    }
</script>
@endsection
