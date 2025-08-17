@extends('layouts.admin')

@section('title', 'Edit Berita - Admin Desa Wonokarang')

@section('content')
<div class="container mx-auto px-4 py-8">
    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center gap-3">
            <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
            <span class="text-green-700">{{ session('success') }}</span>
        </div>
    @endif

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
                    <div id="quill-description"
                        class="h-full min-h-[600px] text-gray-800 bg-white border border-gray-300 rounded"></div>
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
                <div id="videoFields" class="space-y-2 hidden">
                    <label class="block text-sm font-semibold text-gray-700">URL Video</label>
                    <input type="url" name="video_url" value="{{ old('video_url', $video->video_url) }}"
                        class="w-full px-3 py-2 border text-gray-800 rounded border-gray-300">

                    <label class="block text-sm font-semibold text-gray-700">Upload Thumbnail</label>
                    <input type="file" name="video_thumbnail" id="video-thumbnail" accept="image/*"
                        class="w-full px-3 py-2 border text-gray-800 rounded border-gray-300"
                        onchange="previewThumbnail(this, 'video-preview')">
                    <div id="video-preview" class="mt-2 {{ $video->video_thumbnail ? '' : 'hidden' }}">
                        <img src="{{ $video->video_thumbnail ? asset($video->video_thumbnail) : '' }}"
                            class="w-full max-h-48 object-cover rounded shadow">
                    </div>

                    <label class="block text-sm font-semibold text-gray-700">Durasi</label>
                    <input type="text" name="duration" placeholder="Contoh: 3:21"
                        value="{{ old('duration', $video->duration) }}"
                        class="w-full px-3 py-2 border text-gray-800 rounded border-gray-300">
                </div>

                {{-- FIELD GAMBAR --}}
                <div id="gambarFields" class="space-y-2 hidden">
                    <label class="block text-sm font-semibold text-gray-700">Upload Gambar</label>
                    <input type="file" name="image_thumbnail" id="gambar-thumbnail" accept="image/*"
                        class="w-full px-3 py-2 border rounded text-gray-800 border-gray-300"
                        onchange="previewThumbnail(this, 'gambar-preview')">
                    <div id="gambar-preview" class="mt-2 {{ $video->image_thumbnail ? '' : 'hidden' }}">
                        <img src="{{ $video->image_thumbnail ? asset($video->image_thumbnail) : '' }}"
                            class="w-full max-h-48 object-cover rounded shadow">
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit"
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

<style>
    .ql-editor p[style*="text-align: center"] { text-align: center !important; }
    .ql-editor p[style*="text-align: right"] { text-align: right !important; }
    .ql-editor p[style*="text-align: left"] { text-align: left !important; }
    .ql-editor p[style*="text-align: justify"] { text-align: justify !important; }
</style>

<script>
let quill = new Quill('#quill-description', {
    theme: 'snow',
    placeholder: 'Tulis isi berita di sini...',
    modules: {
        toolbar: [
            [{header: [1, 2, false]}],
            ['bold','italic','underline'],
            [{'align':[]}],
            [{list:'ordered'},{list:'bullet'}],
            ['link','image'],
            ['clean']
        ]
    }
});

const form = document.getElementById('videoForm');
const hiddenInput = document.getElementById('description-input');

quill.on('text-change', function() {
    hiddenInput.value = quill.root.innerHTML;
});

document.addEventListener('DOMContentLoaded', function() {
    const initialHTML = {!! json_encode($video->description) !!};
    if (initialHTML && initialHTML.trim() !== '') {
        quill.root.innerHTML = initialHTML;
        hiddenInput.value = initialHTML;
        quill.history.clear();
        quill.update();
    }

    // Tampilkan field sesuai tipe
    const selectedType = document.querySelector('input[name="type"]:checked')?.value;
    if (selectedType) toggleFields(selectedType);
});

form.addEventListener('submit', function(e) {
    e.preventDefault();
    if (validateForm()) {
        hiddenInput.value = quill.root.innerHTML.trim();
        form.submit();
    }
});

function validateForm() {
    let isValid = true, errors = [];
    const title = document.querySelector('input[name="title"]').value.trim();
    if (!title) { errors.push('• Judul artikel harus diisi'); isValid=false; }
    const quillContent = quill.root.innerHTML.trim();
    if (!quillContent || quillContent === '<p><br></p>') { errors.push('• Deskripsi berita harus diisi'); isValid=false; }
    if (!document.querySelector('input[name="category"]:checked')) { errors.push('• Kategori harus dipilih'); isValid=false; }
    const typeSelected = document.querySelector('input[name="type"]:checked');
    if (!typeSelected) { errors.push('• Tipe berita harus dipilih'); isValid=false; }

    const startedAt = document.querySelector('input[name="started_at"]').value;
    if (!startedAt) { errors.push('• Tanggal harus diisi'); isValid=false; }

    if (typeSelected) {
        const type = typeSelected.value;
        if (type==='video') {
            const videoUrl = document.querySelector('input[name="video_url"]').value.trim();
            const thumbnailFile = document.querySelector('#videoFields input[name="video_thumbnail"]')?.files[0];
            const duration = document.querySelector('input[name="duration"]').value.trim();
            if (!videoUrl) { errors.push('• URL Video harus diisi'); isValid=false; }
            if (thumbnailFile) {
                if (thumbnailFile.size>25*1024*1024) { errors.push('• Ukuran thumbnail maksimal 25MB'); isValid=false; }
                if(!['image/jpeg','image/jpg','image/png'].includes(thumbnailFile.type)) { errors.push('• Format thumbnail harus JPG, JPEG, atau PNG'); isValid=false; }
            }
            if(!duration) { errors.push('• Durasi video harus diisi'); isValid=false; }
        } else if(type==='gambar') {
            const thumbnailFile = document.querySelector('#gambarFields input[name="image_thumbnail"]')?.files[0];
            if (thumbnailFile) {
                if (thumbnailFile.size>25*1024*1024) { errors.push('• Ukuran gambar maksimal 25MB'); isValid=false; }
                if(!['image/jpeg','image/jpg','image/png'].includes(thumbnailFile.type)) { errors.push('• Format gambar harus JPG, JPEG, atau PNG'); isValid=false; }
            }
        }
    }

    if (!isValid) alert('Data belum lengkap! Mohon periksa kembali:\n\n'+errors.join('\n'));
    return isValid;
}

function toggleFields(type){
    const video = document.getElementById('videoFields');
    const gambar = document.getElementById('gambarFields');
    video.classList.add('hidden'); gambar.classList.add('hidden');
    if(type==='video') video.classList.remove('hidden');
    if(type==='gambar') gambar.classList.remove('hidden');
}

function previewThumbnail(input, previewId){
    const previewDiv = document.getElementById(previewId);
    const img = previewDiv.querySelector('img');
    if(input.files && input.files[0]){
        const reader = new FileReader();
        reader.onload = e => { img.src=e.target.result; previewDiv.classList.remove('hidden'); }
        reader.readAsDataURL(input.files[0]);
    } else { img.src=''; previewDiv.classList.add('hidden'); }
}
</script>
@endsection
