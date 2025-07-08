@extends('layouts.app')

@section('title', 'Manajemen Warga - Admin Desa Mekar Sari')

@section('content')
<div class="min-h-screen bg-gray-50 pt-20">
    <!-- Admin Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-primary">Manajemen Data Warga</h1>
                    <p class="text-gray-600">Kelola data penduduk Desa Mekar Sari</p>
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

        <!-- Statistics Dashboard -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center">
                        <i data-lucide="users" class="w-6 h-6 text-white"></i>
                    </div>
                    <i data-lucide="pie-chart" class="w-5 h-5 text-gray-400"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ number_format($stats['total']) }}</h3>
                <p class="text-gray-600 text-sm">Total Warga</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center">
                        <i data-lucide="user" class="w-6 h-6 text-white"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ number_format($stats['male']) }}</h3>
                <p class="text-gray-600 text-sm">Laki-laki</p>
                <p class="text-blue-600 text-xs font-medium">{{ number_format(($stats['male']/$stats['total'])*100, 1) }}%</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-pink-600 rounded-lg flex items-center justify-center">
                        <i data-lucide="user" class="w-6 h-6 text-white"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ number_format($stats['female']) }}</h3>
                <p class="text-gray-600 text-sm">Perempuan</p>
                <p class="text-pink-600 text-xs font-medium">{{ number_format(($stats['female']/$stats['total'])*100, 1) }}%</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center">
                        <i data-lucide="users" class="w-6 h-6 text-white"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-1">12</h3>
                <p class="text-gray-600 text-sm">Total RT</p>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid lg:grid-cols-2 gap-8 mb-8">
            <!-- Education Chart -->
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h3 class="text-lg font-bold text-primary mb-6">Distribusi Pendidikan</h3>
                <div class="space-y-4">
                    @foreach($educationStats as $level => $count)
                    @php
                        $percentage = $stats['total'] > 0 ? ($count / $stats['total']) * 100 : 0;
                    @endphp
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-gray-700">{{ $level }}</span>
                            <span class="text-sm text-gray-600">{{ $count }} ({{ number_format($percentage, 1) }}%)</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-primary h-2 rounded-full transition-all duration-300" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Job Distribution -->
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h3 class="text-lg font-bold text-primary mb-6">Distribusi Pekerjaan</h3>
                <div class="space-y-3">
                    @php
                        $jobStats = [
                            ['job' => 'Petani', 'count' => 120, 'color' => 'bg-green-500'],
                            ['job' => 'Pedagang', 'count' => 45, 'color' => 'bg-blue-500'],
                            ['job' => 'Guru', 'count' => 23, 'color' => 'bg-purple-500'],
                            ['job' => 'Ibu Rumah Tangga', 'count' => 89, 'color' => 'bg-pink-500'],
                            ['job' => 'Lainnya', 'count' => 67, 'color' => 'bg-gray-500']
                        ];
                    @endphp
                    @foreach($jobStats as $job)
                    <div class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50">
                        <div class="flex items-center gap-3">
                            <div class="w-4 h-4 {{ $job['color'] }} rounded-full"></div>
                            <span class="text-sm font-medium text-gray-700">{{ $job['job'] }}</span>
                        </div>
                        <span class="text-sm text-gray-600 font-medium">{{ $job['count'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 mb-6">
            <button onclick="openAddModal()" class="bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800 transition-colors flex items-center gap-2">
                <i data-lucide="plus" class="w-5 h-5"></i>
                Tambah Warga
            </button>
            <button class="bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition-colors flex items-center gap-2">
                <i data-lucide="download" class="w-5 h-5"></i>
                Export Excel
            </button>
            <button class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors flex items-center gap-2">
                <i data-lucide="upload" class="w-5 h-5"></i>
                Import Excel
            </button>
        </div>

        <!-- Search and Filter -->
        <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
            <form method="GET" action="{{ route('admin.citizens.index') }}" class="flex flex-col lg:flex-row gap-4">
                <div class="flex-1 relative">
                    <i data-lucide="search" class="absolute left-3 top-3 h-5 w-5 text-gray-400"></i>
                    <input
                        type="text"
                        name="search"
                        placeholder="Cari berdasarkan nama atau NIK..."
                        value="{{ request('search') }}"
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                    />
                </div>
                
                <div class="flex gap-4">
                    <select name="rt" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="">Semua RT</option>
                        <option value="01" {{ request('rt') === '01' ? 'selected' : '' }}>RT 01</option>
                        <option value="02" {{ request('rt') === '02' ? 'selected' : '' }}>RT 02</option>
                        <option value="03" {{ request('rt') === '03' ? 'selected' : '' }}>RT 03</option>
                    </select>
                    
                    <select name="rw" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="">Semua RW</option>
                        <option value="01" {{ request('rw') === '01' ? 'selected' : '' }}>RW 01</option>
                        <option value="02" {{ request('rw') === '02' ? 'selected' : '' }}>RW 02</option>
                        <option value="03" {{ request('rw') === '03' ? 'selected' : '' }}>RW 03</option>
                    </select>
                    
                    <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-blue-800 transition-colors">
                        Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Citizens Table -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="px-6 py-4 text-left">Nama Lengkap</th>
                            <th class="px-6 py-4 text-left">NIK</th>
                            <th class="px-6 py-4 text-left">Jenis Kelamin</th>
                            <th class="px-6 py-4 text-left">Tanggal Lahir</th>
                            <th class="px-6 py-4 text-left">Pekerjaan</th>
                            <th class="px-6 py-4 text-left">Pendidikan</th>
                            <th class="px-6 py-4 text-left">RT/RW</th>
                            <th class="px-6 py-4 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($villagers as $index => $villager)
                        <tr class="{{ $index % 2 === 0 ? 'bg-gray-50' : 'bg-white' }}">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $villager->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $villager->nik }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $villager->gender === 'L' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                    {{ $villager->gender_text }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $villager->birth_date->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $villager->job }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $villager->education }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $villager->rt }}/{{ $villager->rw }}</td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <button onclick="openEditModal({{ $villager->id }})" class="text-blue-600 hover:text-blue-800 transition-colors">
                                        <i data-lucide="edit" class="w-4 h-4"></i>
                                    </button>
                                    <form action="{{ route('admin.citizens.destroy', $villager) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 transition-colors">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-12">
                                <p class="text-gray-500">Tidak ada data warga yang ditemukan</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($villagers->hasPages())
            <div class="px-6 py-4 border-t">
                {{ $villagers->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Add/Edit Modal -->
<div id="villagerModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-md w-full p-6">
            <h3 id="modalTitle" class="text-lg font-bold text-primary mb-4">Tambah Warga Baru</h3>
            
            <form id="villagerForm" method="POST">
                @csrf
                <div id="methodField"></div>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">NIK</label>
                        <input type="text" name="nik" required maxlength="16" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                        <select name="gender" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                        <input type="date" name="birth_date" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan</label>
                        <input type="text" name="job" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pendidikan</label>
                        <select name="education" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            <option value="">Pilih Pendidikan</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA">SMA</option>
                            <option value="D3">D3</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">RT</label>
                            <input type="text" name="rt" required maxlength="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">RW</label>
                            <input type="text" name="rw" required maxlength="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                    </div>
                </div>
                
                <div class="flex gap-4 mt-6">
                    <button type="submit" class="flex-1 bg-primary text-white py-2 rounded-lg hover:bg-blue-800 transition-colors">
                        Simpan
                    </button>
                    <button type="button" onclick="closeModal()" class="flex-1 bg-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-400 transition-colors">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openAddModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Warga Baru';
    document.getElementById('villagerForm').action = '{{ route("admin.citizens.store") }}';
    document.getElementById('methodField').innerHTML = '';
    document.getElementById('villagerForm').reset();
    document.getElementById('villagerModal').classList.remove('hidden');
}

function openEditModal(id) {
    // This would need to be implemented with AJAX to fetch villager data
    // For now, just show the modal
    document.getElementById('modalTitle').textContent = 'Edit Data Warga';
    document.getElementById('villagerForm').action = `/admin/citizens/${id}`;
    document.getElementById('methodField').innerHTML = '@method("PUT")';
    document.getElementById('villagerModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('villagerModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('villagerModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});
</script>
@endsection