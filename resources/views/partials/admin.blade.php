<header class="bg-primary text-white relative z-50">
    <div class="flex min-h-screen">
        <!-- Mobile Overlay -->
        <div id="mobile-overlay" class="lg:hidden fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>
        
        <!-- Sidebar Mobile -->
        <aside id="mobile-sidebar" class="lg:hidden fixed top-0 left-0 h-screen w-64 bg-primary text-white flex flex-col justify-between z-50 transform -translate-x-full transition-transform duration-300">
            <!-- Logo -->
            <div class="px-6 py-6 border-b border-white/10">
                <a href="#" class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-secondary rounded-full flex items-center justify-center">
                        <span class="text-primary font-bold text-xl">MS</span>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold leading-tight">Desa Wonokarang</h1>
                        <p class="text-sm opacity-90 -mt-1">Admin Panel</p>
                    </div>
                </a>
            </div>

            <!-- Navigation Mobile -->
            <nav class="flex-1 mt-4 px-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                    class="block px-4 py-2 rounded-md transition-colors duration-200
        {{ request()->routeIs('admin.dashboard') ? 'bg-secondary text-primary font-semibold' : 'hover:bg-white/10 text-white' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin.videos.index') }}"
                    class="block px-4 py-2 rounded-md transition {{ request()->routeIs('admin.videos.*') ? 'bg-secondary text-primary font-semibold' : 'hover:bg-white/10' }}">
                    Kelola Berita
                </a>
                <a href="{{ route('admin.locations.index') }}"
                    class="block px-4 py-2 rounded-md transition {{ request()->routeIs('admin.locations.*') ? 'bg-secondary text-primary font-semibold' : 'hover:bg-white/10' }}">
                    Kelola Lokasi Peta
                </a>
                <a href="{{ route('admin.aparat.index') }}"
                    class="block px-4 py-2 rounded-md transition {{ request()->routeIs('admin.aparat.*') ? 'bg-secondary text-primary font-semibold' : 'hover:bg-white/10' }}">
                    Kelola Aparatur
                </a>
                <a href="{{ route('admin.products.index') }}"
                    class="block px-4 py-2 rounded-md transition {{ request()->routeIs('admin.products.*') ? 'bg-secondary text-primary font-semibold' : 'hover:bg-white/10' }}">
                    Kelola Produk Desa
                </a>
            </nav>

            <!-- User Info Mobile -->
            <div class="px-6 py-4 border-t border-white/10">
                @auth
                    <div class="text-sm mb-3 flex items-center space-x-2">
                        <i data-lucide="user" class="w-4 h-4"></i>
                        <span>{{ auth()->user()->name }}</span>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center space-x-2 text-sm hover:text-secondary transition">
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                @endauth
            </div>
        </aside>

        <!-- Sidebar Desktop -->
        <aside class="hidden lg:flex w-64 bg-primary text-white flex-col justify-between fixed top-0 left-0 h-screen z-50">
            <!-- Logo -->
            <div class="px-6 py-6 border-b border-white/10">
                <a href="#" class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-secondary rounded-full flex items-center justify-center">
                        <span class="text-primary font-bold text-xl">MS</span>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold leading-tight">Desa Wonokarang</h1>
                        <p class="text-sm opacity-90 -mt-1">Admin Panel</p>
                    </div>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 mt-4 px-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                    class="block px-4 py-2 rounded-md transition-colors duration-200
        {{ request()->routeIs('admin.dashboard') ? 'bg-secondary text-primary font-semibold' : 'hover:bg-white/10 text-white' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin.videos.index') }}"
                    class="block px-4 py-2 rounded-md transition {{ request()->routeIs('admin.videos.*') ? 'bg-secondary text-primary font-semibold' : 'hover:bg-white/10' }}">
                    Kelola Berita
                </a>
                <a href="{{ route('admin.locations.index') }}"
                    class="block px-4 py-2 rounded-md transition {{ request()->routeIs('admin.locations.*') ? 'bg-secondary text-primary font-semibold' : 'hover:bg-white/10' }}">
                    Kelola Lokasi Peta
                </a>
                <a href="{{ route('admin.aparat.index') }}"
                    class="block px-4 py-2 rounded-md transition {{ request()->routeIs('admin.aparat.*') ? 'bg-secondary text-primary font-semibold' : 'hover:bg-white/10' }}">
                    Kelola Aparatur
                </a>
                {{-- <a href="{{ route('admin.citizens.index') }}"
                    class="block px-4 py-2 rounded-md transition {{ request()->routeIs('admin.citizens.*') ? 'bg-secondary text-primary font-semibold' : 'hover:bg-white/10' }}">
                    Kelola Data Warga
                </a> --}}
                <a href="{{ route('admin.products.index') }}"
                    class="block px-4 py-2 rounded-md transition {{ request()->routeIs('admin.products.*') ? 'bg-secondary text-primary font-semibold' : 'hover:bg-white/10' }}">
                    Kelola Produk Desa
                </a>
            </nav>

            <!-- User Info -->
            <div class="px-6 py-4 border-t border-white/10">
                @auth
                    <div class="text-sm mb-3 flex items-center space-x-2">
                        <i data-lucide="user" class="w-4 h-4"></i>
                        <span>{{ auth()->user()->name }}</span>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center space-x-2 text-sm hover:text-secondary transition">
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                @endauth
            </div>
        </aside>

        <!-- Content -->
        <div class="flex-1 lg:ml-64 bg-gray-100 min-h-screen">
            <!-- Navbar Mobile -->
            <div class="lg:hidden bg-primary text-white flex items-center justify-between px-4 py-4 border-b border-white/10">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-secondary rounded-full flex items-center justify-center">
                        <span class="text-primary font-bold text-lg">MS</span>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold">Desa Wonokarang</h1>
                        <p class="text-xs opacity-90">Admin Panel</p>
                    </div>
                </div>
                <button id="mobile-menu-button" class="p-2 hover:bg-white/10 rounded-md transition-colors">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
            </div>

            <!-- Main Content -->
            <main class="p-4 lg:p-6">
                @yield('content')
            </main>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileSidebar = document.getElementById('mobile-sidebar');
        const mobileOverlay = document.getElementById('mobile-overlay');

        function toggleMobileMenu() {
            mobileSidebar.classList.toggle('-translate-x-full');
            mobileOverlay.classList.toggle('hidden');
        }

        function closeMobileMenu() {
            mobileSidebar.classList.add('-translate-x-full');
            mobileOverlay.classList.add('hidden');
        }

        // Toggle mobile menu
        mobileMenuButton.addEventListener('click', toggleMobileMenu);

        // Close mobile menu when clicking overlay
        mobileOverlay.addEventListener('click', closeMobileMenu);

        // Close mobile menu when clicking navigation links (for better UX)
        const mobileNavLinks = mobileSidebar.querySelectorAll('nav a');
        mobileNavLinks.forEach(link => {
            link.addEventListener('click', closeMobileMenu);
        });

        // Handle screen resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) { // lg breakpoint
                closeMobileMenu();
            }
        });
    });
</script>
