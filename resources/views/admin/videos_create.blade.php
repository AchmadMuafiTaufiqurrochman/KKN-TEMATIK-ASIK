@extends('layouts.admin')

@section('title', 'Tambah Berita - Admin Desa Wonokarang')

@section('content')
    <div class="container mx-auto px-4 py-8">
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center gap-3">
                <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
                <span class="text-green-700">{{ session('success') }}</span>
            </div>
        @endif

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-primary">Tambah Berita Baru</h1>
            <a href="{{ route('admin.videos.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg text-sm">
                ← Kembali ke Daftar
            </a>
        </div>

        <form action="{{ route('admin.videos.store') }}" method="POST" enctype="multipart/form-data" id="videoForm">
            @csrf
            
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <h4 class="text-red-800 font-semibold mb-2">Terjadi kesalahan:</h4>
                    <ul class="text-red-700 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">


                {{-- KONTEN UTAMA (Judul + Deskripsi) --}}
                <div class="md:col-span-2 space-y-4 min-h-[620px]">
                    <div>
                        <input type="text" name="title" placeholder="Judul artikel" value="{{ old('title') }}"
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
                                        {{ old('category') === $cat ? 'checked' : '' }}
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
                                <input type="radio" name="type" value="video" 
                                    {{ old('type') === 'video' ? 'checked' : '' }}
                                    class="text-primary" onclick="toggleFields('video')">
                                <span>Video</span>
                            </label><br>
                            <label class="inline-flex items-center space-x-2  text-gray-800">
                                <input type="radio" name="type" value="gambar" 
                                    {{ old('type') === 'gambar' ? 'checked' : '' }}
                                    class="text-primary" onclick="toggleFields('gambar')">
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
                            <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>

                    {{-- FIELD VIDEO --}}
                    <div id="videoFields" class="space-y-2 hidden">
                        <label class="block text-sm font-semibold text-gray-700">URL Video (YouTube / Instagram / TikTok /
                            Facebook)</label>
                        <input type="url" name="video_url" value="{{ old('video_url') }}"
                            class="w-full px-3 py-2 border text-gray-800 rounded border-gray-300">

                        <label class="block text-sm font-semibold text-gray-700">Upload Thumbnail</label>
                        <input type="file" name="video_thumbnail" id="video-thumbnail" accept="image/*"
                            class="w-full px-3 py-2 border text-gray-800 rounded border-gray-300"
                            onchange="previewThumbnail(this, 'video-preview')">
                        <div id="video-preview" class="mt-2 hidden">
                            <img class="w-full max-h-48 object-cover rounded shadow">
                        </div>

                        <label class="block text-sm font-semibold text-gray-700">Durasi</label>
                        <input type="text" name="duration" placeholder="Contoh: 3:21" value="{{ old('duration') }}"
                            class="w-full px-3 py-2 border text-gray-800 rounded border-gray-300">
                    </div>


                    {{-- FIELD GAMBAR --}}
                    <div id="gambarFields" class="space-y-2 hidden">
                        <label class="block text-sm font-semibold text-gray-700">Upload Gambar</label>
                        <input type="file" name="image_thumbnail" id="gambar-thumbnail" accept="image/*"
                            class="w-full px-3 py-2 border rounded text-gray-800 border-gray-300"
                            onchange="previewThumbnail(this, 'gambar-preview')">
                        <div id="gambar-preview" class="mt-2 hidden">
                            <img class="w-full max-h-48 object-cover rounded shadow">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-6 space-x-3">
              
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
        let quill; // Declare quill globally
        
        document.addEventListener('DOMContentLoaded', function() {
            quill = new Quill('#quill-description', {
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

            // Load old content jika ada
            @if(old('description'))
                quill.root.innerHTML = {!! json_encode(old('description')) !!};
            @endif

            // Show appropriate fields based on old input
            @if(old('type'))
                toggleFields('{{ old('type') }}');
            @endif

            document.getElementById('videoForm').addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent form submission
                
                console.log('Form submission started');
                
                // Debug: Check form data
                const formData = new FormData(this);
                console.log('Form data entries:');
                for (let pair of formData.entries()) {
                    console.log(pair[0] + ': ', pair[1]);
                }
                
                // Validasi form
                if (validateForm()) {
                    console.log('Validation passed');
                    
                    // Set description dari Quill
                    const descriptionContent = quill.root.innerHTML;
                    document.getElementById('description-input').value = descriptionContent;
                    console.log('Description set:', descriptionContent.substring(0, 100) + '...');
                    
                    // Submit form
                    console.log('Submitting form...');
                    this.submit();
                } else {
                    console.log('Validation failed');
                }
            });
        });

        function validateForm() {
            let isValid = true;
            let errorMessages = [];

            // Validasi Judul
            const title = document.querySelector('input[name="title"]').value.trim();
            if (!title) {
                errorMessages.push('• Judul artikel harus diisi');
                isValid = false;
            }

            // Validasi Deskripsi
            const quillContent = document.querySelector('.ql-editor').innerHTML.trim();
            if (!quillContent || quillContent === '<p><br></p>') {
                errorMessages.push('• Deskripsi berita harus diisi');
                isValid = false;
            }

            // Validasi Kategori
            const categorySelected = document.querySelector('input[name="category"]:checked');
            if (!categorySelected) {
                errorMessages.push('• Kategori harus dipilih');
                isValid = false;
            }

            // Validasi Tipe Berita
            const typeSelected = document.querySelector('input[name="type"]:checked');
            if (!typeSelected) {
                errorMessages.push('• Tipe berita harus dipilih');
                isValid = false;
            }

            // Validasi Tanggal
            const startedAt = document.querySelector('input[name="started_at"]').value;
            if (!startedAt) {
                errorMessages.push('• Tanggal harus diisi');
                isValid = false;
            }

            // Validasi berdasarkan tipe yang dipilih
            if (typeSelected) {
                const selectedType = typeSelected.value;
                
                if (selectedType === 'video') {
                    const videoUrl = document.querySelector('input[name="video_url"]').value.trim();
                    const thumbnailInput = document.getElementById('video-thumbnail');
                    const thumbnailFile = thumbnailInput ? thumbnailInput.files[0] : null;
                    const duration = document.querySelector('input[name="duration"]').value.trim();
                    
                    console.log('Video validation:', {
                        videoUrl: videoUrl,
                        thumbnailFile: thumbnailFile,
                        duration: duration
                    });
                    
                    if (!videoUrl) {
                        errorMessages.push('• URL Video harus diisi');
                        isValid = false;
                    }
                    if (!thumbnailFile) {
                        errorMessages.push('• Thumbnail harus diupload');
                        isValid = false;
                    } else {
                        // Validasi ukuran file (maksimal 25MB)
                        const maxSize = 25 * 1024 * 1024; // 25MB in bytes
                        if (thumbnailFile.size > maxSize) {
                            errorMessages.push('• Ukuran thumbnail maksimal 25MB');
                            isValid = false;
                        }
                        
                        // Validasi tipe file
                        const allowedTypes = ['image/jpeg', 'image/png'];
                        if (!allowedTypes.includes(thumbnailFile.type)) {
                            errorMessages.push('• Format thumbnail harus JPG, JPEG, atau PNG');
                            isValid = false;
                        }
                    }
                    if (!duration) {
                        errorMessages.push('• Durasi video harus diisi');
                        isValid = false;
                    }
                } else if (selectedType === 'gambar') {
                    const thumbnailInput = document.getElementById('gambar-thumbnail');
                    const thumbnailFile = thumbnailInput ? thumbnailInput.files[0] : null;
                    
                    console.log('Gambar validation:', {
                        thumbnailFile: thumbnailFile
                    });
                    
                    if (!thumbnailFile) {
                        errorMessages.push('• Gambar harus diupload');
                        isValid = false;
                    } else {
                        // Validasi ukuran file (maksimal 25MB)
                        const maxSize = 25 * 1024 * 1024; // 25MB in bytes
                        if (thumbnailFile.size > maxSize) {
                            errorMessages.push('• Ukuran gambar maksimal 25MB');
                            isValid = false;
                        }
                        
                        // Validasi tipe file
                        const allowedTypes = ['image/jpeg', 'image/png'];
                        if (!allowedTypes.includes(thumbnailFile.type)) {
                            errorMessages.push('• Format gambar harus JPG, JPEG, atau PNG');
                            isValid = false;
                        }
                    }
                }
            }

            // Tampilkan alert jika ada error
            if (!isValid) {
                alert('Data belum lengkap! Mohon periksa kembali:\n\n' + errorMessages.join('\n'));
            }

            return isValid;
        }

        function toggleFields(type) {
            const video = document.getElementById('videoFields');
            const gambar = document.getElementById('gambarFields');

            video.classList.add('hidden');
            gambar.classList.add('hidden');

            if (type === 'video') video.classList.remove('hidden');
            if (type === 'gambar') gambar.classList.remove('hidden');
        }

        function previewThumbnail(input, previewId) {
            const preview = document.getElementById(previewId);
            const img = preview.querySelector('img');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    img.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                
                reader.readAsDataURL(input.files[0]);
                
                console.log('File selected:', input.files[0].name, 'Size:', input.files[0].size, 'Type:', input.files[0].type);
            } else {
                preview.classList.add('hidden');
            }
        }

        function testFormData() {
            console.log('=== FORM DATA TEST ===');
            
            try {
                const form = document.getElementById('videoForm');
                const formData = new FormData(form);
                
                console.log('All form entries:');
                for (let pair of formData.entries()) {
                    console.log(pair[0] + ':', pair[1]);
                }
                
                // Check specific file inputs
                const videoThumbnail = document.getElementById('video-thumbnail');
                const gambarThumbnail = document.getElementById('gambar-thumbnail');
                
                console.log('Video thumbnail element:', videoThumbnail);
                console.log('Video thumbnail files:', videoThumbnail ? videoThumbnail.files : 'Not found');
                console.log('Gambar thumbnail element:', gambarThumbnail);
                console.log('Gambar thumbnail files:', gambarThumbnail ? gambarThumbnail.files : 'Not found');
                
                // Check which type is selected
                const typeSelected = document.querySelector('input[name="type"]:checked');
                console.log('Selected type:', typeSelected ? typeSelected.value : 'None');
                
                // Check quill content
                if (typeof quill !== 'undefined') {
                    console.log('Quill content:', quill.root.innerHTML.substring(0, 200) + '...');
                } else {
                    console.log('Quill not available');
                }
                
                alert('✅ Test completed successfully! Check browser console for detailed form data');
                
            } catch (error) {
                console.error('Error in testFormData:', error);
                alert('❌ Error occurred: ' + error.message + '. Check console for details.');
            }
        }

        function submitWithoutValidation() {
            console.log('Direct submission started');
            
            try {
                const form = document.getElementById('videoForm');
                
                // Set description content
                if (typeof quill !== 'undefined') {
                    const descriptionContent = quill.root.innerHTML;
                    document.getElementById('description-input').value = descriptionContent;
                    console.log('Description set for direct submit');
                } else {
                    console.log('Quill not available, skipping description');
                }
                
                // Just submit the form without validation
                form.removeEventListener('submit', arguments.callee);
                console.log('Submitting form directly...');
                form.submit();
                
            } catch (error) {
                console.error('Error in submitWithoutValidation:', error);
                alert('❌ Error occurred: ' + error.message);
            }
        }
    </script>
@endsection
