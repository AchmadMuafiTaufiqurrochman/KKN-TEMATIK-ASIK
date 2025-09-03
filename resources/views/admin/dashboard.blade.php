@extends('layouts.admin')

@section('title', 'Dashboard Admin - Profil Digital Desa Wonokarang')

@section('content')
    <div class="min-h-screen bg-gray-50 pt-0">
        <!-- Admin Header -->
        <div class="bg-white shadow-sm border-b">
            <div class="container mx-auto px-4 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-primary">Dashboard Administrator</h1>
                        <p class="text-gray-600">Selamat datang di panel admin Desa Wonokarang</p>
                    </div>

                </div>
            </div>
        </div>

        <div class="container mx-auto px-4 py-8">
            <!-- Stats Cards -->
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center">
                            <i data-lucide="users" class="w-6 h-6 text-white"></i>
                        </div>
                        <i data-lucide="trending-up" class="w-5 h-5 text-green-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ number_format($stats['total_villagers']) }}</h3>
                    <p class="text-gray-600 text-sm mb-2">Total Aparatur</p>
                    <p class="text-green-600 text-xs font-medium">+12 bulan ini</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center">
                            <i data-lucide="video" class="w-6 h-6 text-white"></i>
                        </div>
                        <i data-lucide="trending-up" class="w-5 h-5 text-green-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $stats['total_videos'] }}</h3>
                    <p class="text-gray-600 text-sm mb-2">Berita</p>
                    <p class="text-green-600 text-xs font-medium">+3 bulan ini</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center">
                            <i data-lucide="building" class="w-6 h-6 text-white"></i>
                        </div>
                        <i data-lucide="trending-up" class="w-5 h-5 text-green-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $stats['total_facilities'] }}</h3>
                    <p class="text-gray-600 text-sm mb-2">Total Fasilitas</p>
                    <p class="text-green-600 text-xs font-medium">+2 bulan ini</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-orange-600 rounded-lg flex items-center justify-center">
                            <i data-lucide="eye" class="w-6 h-6 text-white"></i>
                        </div>
                        <i data-lucide="trending-up" class="w-5 h-5 text-green-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ number_format($stats['total_views']) }}</h3>
                    <p class="text-gray-600 text-sm mb-2">Pengunjung Website</p>
                    <p class="text-green-600 text-xs font-medium">+45% bulan ini</p>
                </div>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Quick Actions -->
                <div class="lg:col-span-1">
                    <div class="bg-white p-6 rounded-xl shadow-lg mb-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Aksi Cepat</h3>
                        <div class="space-y-3">
                            <a href="{{ route('admin.aparat.index') }}"
                                class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100 transition-colors">
                                <i data-lucide="users" class="w-5 h-5 text-gray-800"></i>
                                <span class="font-medium text-gray-800">Kelola Data Aparat</span>
                            </a>
                            <a href="{{ route('admin.videos.index') }}"
                                class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100 transition-colors">
                                <i data-lucide="video" class="w-5 h-5 text-gray-800"></i>
                                <span class="font-medium text-gray-800">Kelola Berita</span>
                            </a>
                            <a href="{{ route('admin.fasilitas.index') }}"
                                class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100 transition-colors">
                                <i data-lucide="building" class="w-5 h-5 text-gray-800"></i>
                                <span class="font-medium text-gray-800">Kelola Fasilitas</span>
                            </a>
                            <a href="{{ route('admin.products.index') }}"
                                class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100 transition-colors">
                                <i data-lucide="package" class="w-5 h-5 text-gray-800"></i>
                                <span class="font-medium text-gray-800">Kelola Produk Desa</span>
                            </a>
                        </div>
                    </div>


                    <!-- Recent Activities -->
                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <h3 class="text-lg font-bold text-primary mb-4">Aktivitas Terbaru</h3>
                        <div class="space-y-4">
                            @foreach ($recentActivities as $activity)
                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                        <i data-lucide="activity" class="w-4 h-4 text-gray-600"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">{{ $activity['action'] }}</p>
                                        <p class="text-xs text-gray-500">{{ $activity['user'] }} • {{ $activity['time'] }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Charts -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Product Distribution -->
                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <h3 class="text-lg font-bold text-primary mb-6">Distribusi Produk</h3>
                        <div class="flex items-center justify-center mb-6">
                            <div class="relative w-48 h-48">
                                <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                                    <circle cx="50" cy="50" r="40" stroke="#E0E0E0" stroke-width="8"
                                        fill="none" />
                                    @if($stats['total_products'] > 0)
                                        <circle cx="50" cy="50" r="40" stroke="#3B82F6" stroke-width="8"
                                            fill="none"
                                            stroke-dasharray="{{ ($stats['pertanian_products'] / $stats['total_products']) * 251.2 }} 251.2"
                                            stroke-linecap="round" />
                                        <circle cx="50" cy="50" r="40" stroke="#EC4899" stroke-width="8"
                                            fill="none"
                                            stroke-dasharray="{{ ($stats['perkebunan_products'] / $stats['total_products']) * 251.2 }} 251.2"
                                            stroke-dashoffset="-{{ ($stats['pertanian_products'] / $stats['total_products']) * 251.2 }}"
                                            stroke-linecap="round" />
                                    @endif
                                </svg>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-primary">
                                            {{ number_format($stats['total_products']) }}</div>
                                        <div class="text-sm text-gray-600">Total</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center">
                                <div class="w-4 h-4 bg-blue-600 rounded-full mx-auto mb-2"></div>
                                <div class="text-lg font-bold text-gray-900">{{ number_format($stats['pertanian_products']) }}
                                </div>
                                <div class="text-sm text-gray-600">Pertanian</div>
                                <div class="text-xs text-gray-500">
                                    {{ $stats['total_products'] > 0 ? number_format(($stats['pertanian_products'] / $stats['total_products']) * 100, 1) : 0 }}%
                                </div>
                            </div>
                            <div class="text-center">
                                <div class="w-4 h-4 bg-pink-600 rounded-full mx-auto mb-2"></div>
                                <div class="text-lg font-bold text-gray-900">
                                    {{ number_format($stats['perkebunan_products']) }}</div>
                                <div class="text-sm text-gray-600">Perkebunan</div>
                                <div class="text-xs text-gray-500">
                                    {{ $stats['total_products'] > 0 ? number_format(($stats['perkebunan_products'] / $stats['total_products']) * 100, 1) : 0 }}%
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Video Statistics -->
                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <h3 class="text-lg font-bold text-primary mb-6">Statistik Berita</h3>
                        <div class="grid grid-cols-2 gap-6">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-green-600 mb-2">{{ $stats['published_videos'] }}</div>
                                <div class="text-gray-600">Berita Published</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-orange-600 mb-2">{{ $stats['draft_videos'] }}</div>
                                <div class="text-gray-600">Berita Draft</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
