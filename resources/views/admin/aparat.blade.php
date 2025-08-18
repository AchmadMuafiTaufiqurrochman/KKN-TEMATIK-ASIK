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
                        <input name="name" placeholder="Nama Lengkap" required
                            class="w-full border px-3 py-2 rounded-lg  text-gray-700">
                        <input name="nip" placeholder="NIP" required
                            class="w-full border px-3 py-2 rounded-lg text-gray-700">
                        <select id="position" name="position" required
                            class="w-full border px-3 py-2 rounded-lg text-gray-700">
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

                        <div id="kepalaDesaFields" class="hidden space-y-4">
                            <textarea name="motto" placeholder="Motto"
                                class="w-full border px-6 py-5 rounded-lg text-gray-700 resize-none break-words overflow-hidden" rows="1"
                                oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>

                            <textarea name="visi" placeholder="Visi"
                                class="w-full border px-6 py-5 rounded-lg text-gray-700 resize-none break-words overflow-hidden" rows="1"
                                oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>

                            <textarea name="misi" placeholder="Misi"
                                class="w-full border px-6 py-5 rounded-lg text-gray-700 resize-none break-words overflow-hidden" rows="1"
                                oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>

                            <textarea name="prestasi" placeholder="Prestasi"
                                class="w-full border px-6 py-5 rounded-lg text-gray-700 resize-none break-words overflow-hidden" rows="1"
                                oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                        </div>


                        <select name="gender" required class="w-full border px-3 py-2 rounded-lg text-gray-700">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        <input type="file" name="photo" accept="image/*"
                            class="w-full border px-3 py-2 rounded-lg">
                    </div>

                    <div class="flex gap-4 mt-6">
                        <button type="submit"
                            class="flex-1 bg-primary text-white py-2 rounded-lg hover:bg-blue-800 transition-colors">Simpan</button>
                        <button type="button" onclick="closeModal()"
                            class="flex-1 bg-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-400 transition-colors">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openAddModal() {
            document.getElementById('modalTitle').textContent = 'Tambah Aparat';
            document.getElementById('aparatForm').action = '{{ route('admin.aparat.store') }}';
            document.getElementById('methodField').innerHTML = '';
            document.getElementById('aparatForm').reset();
            document.getElementById('aparatModal').classList.remove('hidden');
        }

      function openEditModal(id) {
    document.getElementById('modalTitle').textContent = 'Edit Aparat';
    let url = "{{ route('admin.aparat.update', ':id') }}".replace(':id', id);
    document.getElementById('aparatForm').action = url;

    document.getElementById('methodField').innerHTML =
        '<input type="hidden" name="_method" value="PUT">';
    document.getElementById('aparatModal').classList.remove('hidden');
}


        function closeModal() {
            document.getElementById('aparatModal').classList.add('hidden');
        }

        document.getElementById('aparatModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        document.getElementById('position').addEventListener('change', function() {
            let extraFields = document.getElementById('kepalaDesaFields');
            if (this.value === 'Kepala Desa') {
                extraFields.classList.remove('hidden');
            } else {
                extraFields.classList.add('hidden');
            }
        });

        // Validasi Form
        document.getElementById('aparatForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent form submission
            
            // Validasi form
            if (validateAparatForm()) {
                this.submit(); // Submit form jika validasi berhasil
            }
        });

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
                const motto = document.querySelector('textarea[name="motto"]').value.trim();
                const visi = document.querySelector('textarea[name="visi"]').value.trim();
                const misi = document.querySelector('textarea[name="misi"]').value.trim();
                const prestasi = document.querySelector('textarea[name="prestasi"]').value.trim();

                if (!motto) {
                    errorMessages.push('• Motto harus diisi untuk Kepala Desa');
                    isValid = false;
                }
                if (!visi) {
                    errorMessages.push('• Visi harus diisi untuk Kepala Desa');
                    isValid = false;
                }
                if (!misi) {
                    errorMessages.push('• Misi harus diisi untuk Kepala Desa');
                    isValid = false;
                }
                if (!prestasi) {
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
@endsection
