@extends('layouts.admin')

@section('title', 'Manajemen Aparat Desa - Admin Desa Wonokarang')

@section('content')
    <div class="min-h-screen bg-gray-50 pt-0">
        <!-- Header -->
        <div class="bg-white shadow-sm border-b">
            <div class="container mx-auto px-4 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-primary">Manajemen Data Aparat</h1>
                        <p class="text-gray-600">Kelola data perangkat Desa Wonokarang</p>
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

            <!-- Statistik -->
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center">
                            <i data-lucide="users" class="w-6 h-6 text-white"></i>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ number_format($stats['total']) }}</h3>
                    <p class="text-gray-600 text-sm">Total Aparat</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center">
                            <i data-lucide="user" class="w-6 h-6 text-white"></i>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ number_format($stats['male']) }}</h3>
                    <p class="text-gray-600 text-sm">Laki-laki</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-pink-600 rounded-lg flex items-center justify-center">
                            <i data-lucide="user" class="w-6 h-6 text-white"></i>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ number_format($stats['female']) }}</h3>
                    <p class="text-gray-600 text-sm">Perempuan</p>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex flex-col sm:flex-row gap-4 mb-6">
                <button onclick="openAddModal()"
                    class="bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800 transition-colors flex items-center gap-2">
                    <i data-lucide="plus" class="w-5 h-5"></i>
                    Tambah Aparat
                </button>
            </div>

            <!-- Tabel Aparat -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="px-6 py-4 text-left">Foto</th>
                            <th class="px-6 py-4 text-left">Nama</th>
                            <th class="px-6 py-4 text-left">NIP</th>
                            <th class="px-6 py-4 text-left">Jabatan</th>
                            <th class="px-6 py-4 text-left">Jenis Kelamin</th>
                            <th class="px-6 py-4 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($aparat as $index => $ap)
                            <tr class="{{ $index % 2 === 0 ? 'bg-gray-50' : 'bg-white' }}">
                                <td class="px-6 py-4">
                                    @if ($ap->photo)
                                        <img src="{{ asset('storage/' . $ap->photo) }}" alt="{{ $ap->name }}"
                                            class="h-12 w-12 object-cover rounded-full">
                                    @else
                                        <span class="text-gray-400 italic">Tidak ada foto</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $ap->name }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $ap->nip }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $ap->position }}</td>
                                <td class="px-6 py-4 text-gray-600">
                                    <span
                                        class="px-2 py-1 rounded-full text-xs font-semibold {{ $ap->gender === 'L' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                        {{ $ap->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <button onclick="openEditModal({{ $ap->id }})"
                                            class="text-blue-600 hover:text-blue-800 transition-colors">
                                            <i data-lucide="edit" class="w-4 h-4"></i>
                                        </button>
                                        <form action="{{ route('admin.aparat.destroy', $ap) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-800 transition-colors">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-12">
                                    <p class="text-gray-500">Tidak ada data aparat ditemukan</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
        <div id="aparatModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white p-6 rounded-lg w-[90%] max-w-[700px] max-h-[90vh] overflow-y-auto">
                    <h3 id="modalTitle" class="text-lg font-bold text-primary mb-4">Tambah Aparat</h3>

                    <form id="aparatForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div id="methodField"></div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="name" placeholder="Masukkan nama lengkap" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">NIP</label>
                                <input type="text" name="nip" placeholder="Masukkan NIP" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                                <select id="position" name="position" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-primary">
                                    <option value="">Pilih Jabatan</option>
                                    <option value="Kepala Desa">Kepala Desa</option>
                                    <option value="Sekretaris Desa">Sekretaris Desa</option>
                                    <option value="Kaur Tata Usaha dan UMKM">Kaur Tata Usaha dan UMKM</option>
                                    <option value="Kaur Keuangan">Kaur Keuangan</option>
                                    <option value="Kaur Perencanaan">Kaur Perencanaan</option>
                                    <option value="Kasi Pemerintahan">Kasi Pemerintahan</option>
                                    <option value="Kasi Kesejahteraan">Kasi Kesejahteraan</option>
                                    <option value="Kasi Pelayanan">Kasi Pelayanan</option>
                                    <option value="Kepala Dusun">Kepala Dusun</option>
                                </select>
                            </div>

                            {{-- Khusus Kepala Desa --}}
                            <div id="kepalaDesaFields" class="hidden space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Motto</label>
                                    <div id="quill-motto" class="h-32 text-gray-800 bg-white border border-gray-300 rounded-lg"></div>
                                    <input type="hidden" name="motto" id="motto-input">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Visi</label>
                                    <div id="quill-visi" class="h-32 text-gray-800 bg-white border border-gray-300 rounded-lg"></div>
                                    <input type="hidden" name="visi" id="visi-input">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Misi</label>
                                    <div id="quill-misi" class="h-32 text-gray-800 bg-white border border-gray-300 rounded-lg"></div>
                                    <input type="hidden" name="misi" id="misi-input">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Prestasi</label>
                                    <div id="quill-prestasi" class="h-32 text-gray-800 bg-white border border-gray-300 rounded-lg"></div>
                                    <input type="hidden" name="prestasi" id="prestasi-input">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                                <select name="gender" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-primary">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
                                <input type="file" name="photo" accept="image/*"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>
                        </div>

                        <div class="flex gap-4 mt-6">
                            <button type="submit"
                                class="flex-1 bg-primary text-white py-2 rounded-lg hover:bg-blue-800 transition-colors">
                                Perbarui
                            </button>
                            <button type="button" onclick="closeModal()"
                                class="flex-1 bg-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-400 transition-colors">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    <script>
        function openAddModal() {
            console.log('Opening add modal');
            
            document.getElementById('modalTitle').textContent = 'Tambah Aparat';
            document.getElementById('aparatForm').action = '{{ route('admin.aparat.store') }}';
            document.getElementById('methodField').innerHTML = '';
            document.getElementById('aparatForm').reset();

            // Reset dan sembunyikan field Kepala Desa
            document.getElementById('kepalaDesaFields').classList.add('hidden');
            
            // Reset Quill editors dengan pengecekan
            setTimeout(function() {
                if (quillMottoEditor) {
                    quillMottoEditor.setContents([]);
                    console.log('Motto editor reset');
                }
                if (quillVisiEditor) {
                    quillVisiEditor.setContents([]);
                    console.log('Visi editor reset');
                }
                if (quillMisiEditor) {
                    quillMisiEditor.setContents([]);
                    console.log('Misi editor reset');
                }
                if (quillPrestasiEditor) {
                    quillPrestasiEditor.setContents([]);
                    console.log('Prestasi editor reset');
                }
            }, 100);

            document.getElementById('aparatModal').classList.remove('hidden');
            console.log('Add modal opened');
        }

      function openEditModal(id) {
    console.log('Opening edit modal for ID:', id);
    
    document.getElementById('modalTitle').textContent = 'Edit Aparat';
    let url = "{{ route('admin.aparat.update', ':id') }}".replace(':id', id);
    document.getElementById('aparatForm').action = url;

    document.getElementById('methodField').innerHTML =
        '<input type="hidden" name="_method" value="PUT">';

    // Fetch data untuk edit
    fetch(`/admin/aparat/${id}/edit`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Data received:', data);
            
            // Populate form fields dengan data awal
            document.querySelector('input[name="name"]').value = data.name || '';
            document.querySelector('input[name="nip"]').value = data.nip || '';
            document.querySelector('select[name="position"]').value = data.position || '';
            document.querySelector('select[name="gender"]').value = data.gender || '';

            // Populate field tambahan Kepala Desa jika ada
            if (data.position === 'Kepala Desa') {
                document.getElementById('kepalaDesaFields').classList.remove('hidden');

                // Set value untuk Quill editors dengan delay untuk memastikan editors sudah siap
                setTimeout(function() {
                    if (quillMottoEditor) {
                        quillMottoEditor.root.innerHTML = data.motto || '';
                        console.log('Motto set:', data.motto);
                    }
                    if (quillVisiEditor) {
                        quillVisiEditor.root.innerHTML = data.visi || '';
                        console.log('Visi set:', data.visi);
                    }
                    if (quillMisiEditor) {
                        quillMisiEditor.root.innerHTML = data.misi || '';
                        console.log('Misi set:', data.misi);
                    }
                    if (quillPrestasiEditor) {
                        quillPrestasiEditor.root.innerHTML = data.prestasi || '';
                        console.log('Prestasi set:', data.prestasi);
                    }
                }, 200);
            } else {
                document.getElementById('kepalaDesaFields').classList.add('hidden');
            }

            // Buka modal setelah data terisi
            document.getElementById('aparatModal').classList.remove('hidden');
            console.log('Edit modal opened');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengambil data: ' + error.message);
        });
}


        function closeModal() {
            console.log('Closing modal');
            
            document.getElementById('aparatModal').classList.add('hidden');
            // Reset form dan sembunyikan field Kepala Desa saat menutup modal
            document.getElementById('aparatForm').reset();
            document.getElementById('kepalaDesaFields').classList.add('hidden');
            
            // Reset Quill editors dengan pengecekan
            setTimeout(function() {
                if (quillMottoEditor) {
                    quillMottoEditor.setContents([]);
                    console.log('Motto editor reset on close');
                }
                if (quillVisiEditor) {
                    quillVisiEditor.setContents([]);
                    console.log('Visi editor reset on close');
                }
                if (quillMisiEditor) {
                    quillMisiEditor.setContents([]);
                    console.log('Misi editor reset on close');
                }
                if (quillPrestasiEditor) {
                    quillPrestasiEditor.setContents([]);
                    console.log('Prestasi editor reset on close');
                }
            }, 100);
            
            console.log('Modal closed');
        }

        function validateAparatForm() {
            let isValid = true;
            let errorMessages = [];

            // Validasi Nama
            const name = document.querySelector('input[name="name"]').value.trim();
            if (!name) {
                errorMessages.push('• Nama lengkap harus diisi');
                isValid = false;
            }

            // Validasi NIP
            const nip = document.querySelector('input[name="nip"]').value.trim();
            if (!nip) {
                errorMessages.push('• NIP harus diisi');
                isValid = false;
            }

            // Validasi Jabatan
            const position = document.querySelector('select[name="position"]').value;
            if (!position) {
                errorMessages.push('• Jabatan harus dipilih');
                isValid = false;
            }

            // Validasi Jenis Kelamin
            const gender = document.querySelector('select[name="gender"]').value;
            if (!gender) {
                errorMessages.push('• Jenis kelamin harus dipilih');
                isValid = false;
            }

            // Validasi khusus untuk Kepala Desa
            if (position === 'Kepala Desa') {
                // Pastikan Quill editors sudah diinisialisasi
                if (!quillMottoEditor || !quillVisiEditor || !quillMisiEditor || !quillPrestasiEditor) {
                    errorMessages.push('• Editor belum siap, silakan coba lagi');
                    isValid = false;
                    return isValid;
                }

                const mottoContent = quillMottoEditor.root.innerHTML.trim();
                const visiContent = quillVisiEditor.root.innerHTML.trim();
                const misiContent = quillMisiEditor.root.innerHTML.trim();
                const prestasiContent = quillPrestasiEditor.root.innerHTML.trim();

                if (!mottoContent || mottoContent === '<p><br></p>' || mottoContent === '<p></p>') {
                    errorMessages.push('• Motto harus diisi untuk Kepala Desa');
                    isValid = false;
                }
                if (!visiContent || visiContent === '<p><br></p>' || visiContent === '<p></p>') {
                    errorMessages.push('• Visi harus diisi untuk Kepala Desa');
                    isValid = false;
                }
                if (!misiContent || misiContent === '<p><br></p>' || misiContent === '<p></p>') {
                    errorMessages.push('• Misi harus diisi untuk Kepala Desa');
                    isValid = false;
                }
                if (!prestasiContent || prestasiContent === '<p><br></p>' || prestasiContent === '<p></p>') {
                    errorMessages.push('• Prestasi harus diisi untuk Kepala Desa');
                    isValid = false;
                }
            }

            // Validasi foto (jika ada)
            const photoFile = document.querySelector('input[name="photo"]').files[0];
            if (photoFile) {
                // Validasi ukuran file (maksimal 25MB)
                const maxSize = 25 * 1024 * 1024; // 25MB in bytes
                if (photoFile.size > maxSize) {
                    errorMessages.push('• Ukuran foto maksimal 25MB');
                    isValid = false;
                }

                // Validasi tipe file
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                if (!allowedTypes.includes(photoFile.type)) {
                    errorMessages.push('• Format foto harus JPG, JPEG, atau PNG');
                    isValid = false;
                }
            }

            // Tampilkan alert jika ada error
            if (!isValid) {
                alert('Data belum lengkap! Mohon periksa kembali:\n\n' + errorMessages.join('\n'));
            }

            return isValid;
        }
    </script>

    {{-- QUILL CSS dan JS --}}
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

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
        let quillMottoEditor, quillVisiEditor, quillMisiEditor, quillPrestasiEditor;

        // Initialize Quill editors
        function initializeQuillEditors() {
            // Pastikan elemen DOM sudah ada
            if (!document.getElementById('quill-motto')) {
                console.log('Quill elements not found, retrying...');
                setTimeout(initializeQuillEditors, 100);
                return;
            }

            const toolbarOptions = [
                [{ 'header': [1, 2, false] }],
                ['bold', 'italic', 'underline'],
                [{ 'align': [] }],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                ['link'],
                ['clean']
            ];

            try {
                quillMottoEditor = new Quill('#quill-motto', {
                    theme: 'snow',
                    placeholder: 'Tuliskan motto kepala desa...',
                    modules: { toolbar: toolbarOptions }
                });

                quillVisiEditor = new Quill('#quill-visi', {
                    theme: 'snow',
                    placeholder: 'Tuliskan visi kepala desa...',
                    modules: { toolbar: toolbarOptions }
                });

                quillMisiEditor = new Quill('#quill-misi', {
                    theme: 'snow',
                    placeholder: 'Tuliskan misi kepala desa...',
                    modules: { toolbar: toolbarOptions }
                });

                quillPrestasiEditor = new Quill('#quill-prestasi', {
                    theme: 'snow',
                    placeholder: 'Tuliskan prestasi kepala desa...',
                    modules: { toolbar: toolbarOptions }
                });

                console.log('Quill editors initialized successfully');
            } catch (error) {
                console.error('Error initializing Quill editors:', error);
            }
        }

        // Initialize editors when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing...');
            
            // Initialize Quill editors
            initializeQuillEditors();
            
            // Event listeners untuk modal
            const modal = document.getElementById('aparatModal');
            if (modal) {
                modal.addEventListener('click', function(e) {
                    if (e.target === this) closeModal();
                });
            }

            // Event listener untuk perubahan jabatan
            const positionSelect = document.getElementById('position');
            if (positionSelect) {
                positionSelect.addEventListener('change', function() {
                    const extraFields = document.getElementById('kepalaDesaFields');
                    if (this.value === 'Kepala Desa') {
                        extraFields.classList.remove('hidden');
                    } else {
                        extraFields.classList.add('hidden');
                        // Reset Quill editors saat menyembunyikan field
                        if (quillMottoEditor) quillMottoEditor.setContents([]);
                        if (quillVisiEditor) quillVisiEditor.setContents([]);
                        if (quillMisiEditor) quillMisiEditor.setContents([]);
                        if (quillPrestasiEditor) quillPrestasiEditor.setContents([]);
                    }
                });
            }

            // Event listener untuk submit form
            const form = document.getElementById('aparatForm');
            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault(); // Prevent form submission

                    console.log('Form submission started');

                    // Set nilai dari Quill editors ke hidden inputs
                    const selectedPosition = document.querySelector('select[name="position"]').value;
                    if (selectedPosition === 'Kepala Desa') {
                        if (quillMottoEditor && quillVisiEditor && quillMisiEditor && quillPrestasiEditor) {
                            document.getElementById('motto-input').value = quillMottoEditor.root.innerHTML;
                            document.getElementById('visi-input').value = quillVisiEditor.root.innerHTML;
                            document.getElementById('misi-input').value = quillMisiEditor.root.innerHTML;
                            document.getElementById('prestasi-input').value = quillPrestasiEditor.root.innerHTML;
                            
                            console.log('Quill data set to hidden inputs');
                        }
                    }

                    // Validasi form
                    if (validateAparatForm()) {
                        console.log('Validation passed, submitting form');
                        this.submit(); // Submit form jika validasi berhasil
                    } else {
                        console.log('Validation failed');
                    }
                });
            }
            
            console.log('Event listeners attached');
        });
    </script>
@endsection
