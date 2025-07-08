<header class="bg-primary text-white relative z-50">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between py-4">
            <!-- Logo -->
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-secondary rounded-full flex items-center justify-center">
                    <span class="text-primary font-bold text-xl">MS</span>
                </div>
                <div>
                    <h1 class="text-xl font-bold">Desa Mekar Sari</h1>
                    <p class="text-sm opacity-90">Admin Panel</p>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center space-x-8">
                <a href="{{ route('admin.residents.index') }}" class="hover:text-secondary transition-colors duration-200 py-2 border-b-2 {{ request()->routeIs('admin.residents.*') ? 'border-secondary text-secondary' : 'border-transparent hover:border-secondary' }}">
                    Kelola Data Warga
                </a>
                <a href="{{ route('admin.videos.index') }}" class="hover:text-secondary transition-colors duration-200 py-2 border-b-2 {{ request()->routeIs('admin.videos.*') ? 'border-secondary text-secondary' : 'border-transparent hover:border-secondary' }}">
                    Kelola Video
                </a>
                <a href="{{ route('admin.maps.index') }}" class="hover:text-secondary transition-colors duration-200 py-2 border-b-2 {{ request()->routeIs('admin.maps.*') ? 'border-secondary text-secondary' : 'border-transparent hover:border-secondary' }}">
                    Kelola Lokasi Peta
                </a>
            </nav>

            <!-- User Menu -->
            <div class="hidden lg:flex items-center space-x-4">
                @auth
                    <div class="flex items-center space-x-4 border-l border-white/20 pl-4">
                        <a href="#" class="flex items-center space-x-2 hover:text-secondary transition-colors">
                            <i data-lucide="user" class="w-4 h-4"></i>
                            <span>{{ auth()->user()->name }}</span>
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="flex items-center space-x-2 hover:text-secondary transition-colors">
                                <i data-lucide="log-out" class="w-4 h-4"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button class="lg:hidden" id="mobile-menu-button">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="lg:hidden bg-primary border-t border-white/20 hidden">
        <nav class="container mx-auto px-4 py-4">
            <a href="{{ route('admin.residents.index') }}" class="block py-2 transition-colors {{ request()->routeIs('admin.residents.*') ? 'text-secondary' : 'hover:text-secondary' }}">
                Kelola Data Warga
            </a>
            <a href="{{ route('admin.videos.index') }}" class="block py-2 transition-colors {{ request()->routeIs('admin.videos.*') ? 'text-secondary' : 'hover:text-secondary' }}">
                Kelola Video
            </a>
            <a href="{{ route('admin.maps.index') }}" class="block py-2 transition-colors {{ request()->routeIs('admin.maps.*') ? 'text-secondary' : 'hover:text-secondary' }}">
                Kelola Lokasi Peta
            </a>

            @auth
                <div class="pt-4 border-t border-white/20 mt-4">
                    <a href="#" class="block py-2 hover:text-secondary transition-colors">
                        {{ auth()->user()->name }}
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="block py-2 hover:text-secondary transition-colors">
                            Logout
                        </button>
                    </form>
                </div>
            @endauth
        </nav>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    
    mobileMenuButton.addEventListener('click', function() {
        mobileMenu.classList.toggle('hidden');
    });
});
</script>
