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

        <form action="{{ route('admin.videos.update', $video->id) }}" method="POST" enctype="multipart/form-data"
            id="videoForm" onsubmit="console.log('Form Submitted')">
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
                        {{-- Quill Editor Container (kosong, jangan langsung isi pakai Blade) --}}
                        <div id="quill-description"
                            class="h-full min-h-[600px] text-gray-800 bg-white border border-gray-300 rounded">
                        </div>

                        {{-- Hidden Input untuk kirim ke server --}}
                        <input type="hidden" name="description" id="description-input" value="">
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
                                    {{ $video->type === 'video' ? 'checked' : '' }} class="text-primary"
                                    onclick="toggleFields('video')">
                                <span>Video</span>
                            </label><br>
                            <label class="inline-flex items-center space-x-2 text-gray-800">
                                <input type="radio" name="type" value="gambar"
                                    {{ $video->type === 'gambar' ? 'checked' : '' }} class="text-primary"
                                    onclick="toggleFields('gambar')">
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
                            <option value="published" {{ $video->status === 'published' ? 'selected' : '' }}>Published
                            </option>
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
                <button type="button" onclick="document.getElementById('videoForm').submit()"
                    class="relative z-50 bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800 transition-colors">
                    Perbarui
                </button>
            </div>
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 px-4 py-2 rounded mt-4">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

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
        // Fungsi untuk toggle fields berdasarkan tipe
        function toggleFields(type) {
            const videoFields = document.getElementById('videoFields');
            const gambarFields = document.getElementById('gambarFields');
            
            if (type === 'video') {
                videoFields.classList.remove('hidden');
                gambarFields.classList.add('hidden');
            } else if (type === 'gambar') {
                videoFields.classList.add('hidden');
                gambarFields.classList.remove('hidden');
            }
        }

        let quill = new Quill('#quill-description', {
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

        form.addEventListener('submit', function(e) {
            const html = quill.root.innerHTML.trim();

            if (!html || html === '<p><br></p>') {
                e.preventDefault();
                alert("Deskripsi tidak boleh kosong!");
                return;
            }

            hiddenInput.value = html;
        });

        // Set isi awal ke Quill
        document.addEventListener('DOMContentLoaded', function() {
            const initialHTML = {!! json_encode($video->description) !!};
            
            // Pastikan ada content sebelum dimuat
            if (initialHTML && initialHTML.trim() !== '') {
                try {
                    // Langsung set innerHTML ke root element
                    quill.root.innerHTML = initialHTML;
                    
                    // Update hidden input
                    hiddenInput.value = initialHTML;
                    
                    // Trigger Quill untuk mengenali perubahan dan mempertahankan formatting
                    quill.history.clear();
                    
                    // Refresh editor untuk memastikan formatting diterapkan
                    setTimeout(() => {
                        const currentContent = quill.root.innerHTML;
                        if (currentContent !== initialHTML) {
                            quill.root.innerHTML = initialHTML;
                        }
                        
                        // Pastikan Quill mengenali content sebagai valid
                        quill.update();
                        
                        console.log('Content loaded:', initialHTML);
                        console.log('Current content:', quill.root.innerHTML);
                    }, 200);
                    
                } catch (error) {
                    console.error('Error loading content:', error);
                    // Fallback method
                    quill.clipboard.dangerouslyPasteHTML(initialHTML);
                    hiddenInput.value = initialHTML;
                }
            }
        });
    </script>


@endsection
