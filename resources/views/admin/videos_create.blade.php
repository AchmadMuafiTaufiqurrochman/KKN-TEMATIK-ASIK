@extends('layouts.admin')

@section('title', 'Tambah Berita - Admin Desa Wonokarang')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-primary">Tambah Berita Baru</h1>
            <a href="{{ route('admin.videos.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg text-sm">
                ← Kembali ke Daftar
            </a>
        </div>

        <form action="{{ route('admin.videos.store') }}" method="POST" enctype="multipart/form-data" id="videoForm">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">


                {{-- KONTEN UTAMA (Judul + Deskripsi) --}}
                <div class="md:col-span-2 space-y-4 min-h-[620px]">
                    <div>
                        <input type="text" name="title" placeholder="Judul artikel"
                            class="w-full text-3xl font-bold text-gray-800 px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary"
                            required>
                    </div>

                    <div>
                        <div id="quill-description"
                            class="h-full min-h-[600px]  text-gray-800 bg-white border border-gray-300 rounded">
                        </div>
                        <input type="hidden" name="description" id="description-input">
                    </div>

                </div>

                {{-- SIDEBAR --}}
                <div class="space-y-4">

                    {{-- KATEGORI (Radio) --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                        <div class="space-y-1">
                            @foreach ($categories as $cat)
                                <label class="inline-flex items-center space-x-2  text-gray-800">
                                    <input type="radio" name="category" value="{{ $cat }}"
                                        class="text-primary focus:ring-primary  text-gray-800">
                                    <span>{{ ucfirst($cat) }}</span>
                                </label><br>
                            @endforeach
                        </div>
                    </div>

                    {{-- TIPE BERITA (Radio) --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tipe Berita</label>
                        <div class="space-y-1">
                            <label class="inline-flex items-center space-x-2  text-gray-800">
                                <input type="radio" name="type" value="video" class="text-primary"
                                    onclick="toggleFields('video')">
                                <span>Video</span>
                            </label><br>
                            <label class="inline-flex items-center space-x-2  text-gray-800">
                                <input type="radio" name="type" value="gambar" class="text-primary"
                                    onclick="toggleFields('gambar')">
                                <span>Gambar</span>
                            </label>
                        </div>
                    </div>

                    {{-- TANGGAL --}}
                    <div>
                        <label for="started_at" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal</label>
                        <input type="date" name="started_at" id="started_at" value="{{ old('started_at') }}"
                            class="w-full px-3 py-2 border rounded border-gray-300 focus:ring  text-gray-800 focus:ring-indigo-200">
                    </div>

                    {{-- STATUS --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                        <select name="status"
                            class="w-full px-3 py-2 border rounded border-gray-300  text-gray-800 focus:outline-none focus:ring-primary">
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                    </div>

                    {{-- FIELD VIDEO --}}
                    <div id="videoFields" class="space-y-2 hidden">
                        <label class="block text-sm font-semibold text-gray-700">URL Video (YouTube / Instagram / TikTok /
                            Facebook)</label>
                        <input type="url" name="video_url"
                            class="w-full px-3 py-2 border text-gray-800 rounded border-gray-300">

                        <label class="block text-sm font-semibold text-gray-700">Thumbnail (URL)</label>
                        <input type="url" name="thumbnail"
                            class="w-full px-3 py-2 border text-gray-800 rounded border-gray-300">

                        <label class="block text-sm font-semibold text-gray-700">Durasi</label>
                        <input type="text" name="duration" placeholder="Contoh: 3:21"
                            class="w-full px-3 py-2 border text-gray-800 rounded border-gray-300">
                    </div>


                    {{-- FIELD GAMBAR --}}
                    <div id="gambarFields" class="space-y-2 hidden">
                        <label class="block text-sm font-semibold text-gray-700">Upload Gambar</label>
                        <input type="file" name="thumbnail" accept="image/*"
                            class="w-full px-3 py-2 border rounded  text-gray-800 border-gray-300">
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit"
                    class="bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800 transition-colors">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    {{-- QUILL --}}
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    
    {{-- Custom CSS untuk memastikan alignment ditampilkan dengan benar --}}
    <style>
        .ql-editor p[style*="text-align: center"] {
            text-align: center !important;
        }
        .ql-editor p[style*="text-align: right"] {
            text-align: right !important;
        }
        .ql-editor p[style*="text-align: left"] {
            text-align: left !important;
        }
        .ql-editor p[style*="text-align: justify"] {
            text-align: justify !important;
        }
        
        /* Pastikan Quill mempertahankan alignment */
        .ql-editor .ql-align-center {
            text-align: center;
        }
        .ql-editor .ql-align-right {
            text-align: right;
        }
        .ql-editor .ql-align-left {
            text-align: left;
        }
        .ql-editor .ql-align-justify {
            text-align: justify;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quill = new Quill('#quill-description', {
                theme: 'snow',
                placeholder: 'Tulis isi berita di sini...',
                modules: {
                    toolbar: [
                        [{
                            header: [1, 2, false]
                        }],
                        ['bold', 'italic', 'underline'],
                        [{
                            'align': []
                        }], // <- ini buat rata kiri, tengah, kanan, justify
                        [{
                            list: 'ordered'
                        }, {
                            list: 'bullet'
                        }],
                        ['link', 'image'],
                        ['clean']
                    ]
                }
            });

            const form = document.getElementById('videoForm');
            const hiddenInput = document.getElementById('description-input');

            // Update hidden input setiap kali ada perubahan di Quill
            quill.on('text-change', function() {
                const html = quill.root.innerHTML;
                hiddenInput.value = html;
            });

            // Validasi saat submit form
            form.addEventListener('submit', function(e) {
                const html = quill.root.innerHTML.trim();

                if (!html || html === '<p><br></p>') {
                    e.preventDefault();
                    alert("Deskripsi tidak boleh kosong!");
                    return;
                }

                hiddenInput.value = html;
            });
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
