<header class="bg-primary text-white relative z-50">
    <!-- Additional Styles -->
    <style>
        /* Mobile menu button styles */
        #mobile-menu-button {
            -webkit-tap-highlight-color: transparent;
            user-select: none;
            touch-action: manipulation;
        }

        #mobile-menu-button:active {
            background: rgba(255, 255, 255, 0.2) !important;
        }
        
        /* Simple hover effects for navigation items */
        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
        }
    </style>
    
    <div class="flex min-h-screen">
        <!-- Mobile Overlay -->
        <div id="mobile-overlay" class="lg:hidden fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>
        
        <!-- Sidebar Mobile -->
        <aside id="mobile-sidebar" class="lg:hidden fixed top-0 left-0 h-screen w-64 bg-primary text-white flex flex-col justify-between z-50 transform -translate-x-full transition-transform duration-300">
            <!-- Logo -->
            <div class="px-6 py-6 border-b border-white/10">
                <a href="#" class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-secondary rounded-lg flex items-center justify-center">
                        <i data-lucide="map-pin" class="w-6 h-6 text-primary"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold leading-tight">Desa Wonokarang</h1>
                        <p class="text-sm opacity-90 -mt-1 text-gray-300">Admin Panel</p>
                    </div>
                </a>
            </div>

            <!-- Navigation Mobile -->
            <nav class="flex-1 mt-4 px-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors duration-200 group {{ request()->routeIs('admin.dashboard') ? 'bg-secondary text-primary font-semibold' : 'hover:bg-white/10 text-white' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-primary' : 'text-secondary' }}"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.videos.index') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors duration-200 group {{ request()->routeIs('admin.videos.*') ? 'bg-secondary text-primary font-semibold' : 'hover:bg-white/10 text-white' }}">
                    <i data-lucide="newspaper" class="w-5 h-5 {{ request()->routeIs('admin.videos.*') ? 'text-primary' : 'text-secondary' }}"></i>
                    <span>Kelola Berita</span>
                </a>
                <a href="{{ route('admin.locations.index') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors duration-200 group {{ request()->routeIs('admin.locations.*') ? 'bg-secondary text-primary font-semibold' : 'hover:bg-white/10 text-white' }}">
                    <i data-lucide="map" class="w-5 h-5 {{ request()->routeIs('admin.locations.*') ? 'text-primary' : 'text-secondary' }}"></i>
                    <span>Kelola Fasilitas Desa</span>
                </a>
                <a href="{{ route('admin.aparat.index') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors duration-200 group {{ request()->routeIs('admin.aparat.*') ? 'bg-secondary text-primary font-semibold' : 'hover:bg-white/10 text-white' }}">
                    <i data-lucide="users" class="w-5 h-5 {{ request()->routeIs('admin.aparat.*') ? 'text-primary' : 'text-secondary' }}"></i>
                    <span>Kelola Aparatur</span>
                </a>
                <a href="{{ route('admin.products.index') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors duration-200 group {{ request()->routeIs('admin.products.*') ? 'bg-secondary text-primary font-semibold' : 'hover:bg-white/10 text-white' }}">
                    <i data-lucide="shopping-bag" class="w-5 h-5 {{ request()->routeIs('admin.products.*') ? 'text-primary' : 'text-secondary' }}"></i>
                    <span>Kelola Produk Desa</span>
                </a>
            </nav>

            <!-- User Info Mobile -->
            <div class="px-4 py-4 border-t border-white/10">
                @auth
                    <div class="bg-white/5 rounded-lg p-3 mb-3">
                        <div class="flex items-center space-x-3 mb-2">
                            <div class="w-8 h-8 bg-secondary rounded-full flex items-center justify-center">
                                <i data-lucide="user" class="w-4 h-4 text-primary"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-white">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-300 opacity-80">Administrator</p>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center space-x-2 text-sm px-4 py-2 bg-red-500/20 hover:bg-red-500/30 text-red-300 hover:text-red-200 rounded-lg transition-colors duration-200">
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
                    <div class="w-12 h-12 bg-secondary rounded-lg flex items-center justify-center">
                        <i data-lucide="map-pin" class="w-6 h-6 text-primary"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold leading-tight">Desa Wonokarang</h1>
                        <p class="text-sm opacity-90 -mt-1 text-gray-300">Admin Panel</p>
                    </div>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 mt-4 px-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors duration-200 group {{ request()->routeIs('admin.dashboard') ? 'bg-secondary text-primary font-semibold' : 'hover:bg-white/10 text-white' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-primary' : 'text-secondary' }}"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.videos.index') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors duration-200 group {{ request()->routeIs('admin.videos.*') ? 'bg-secondary text-primary font-semibold' : 'hover:bg-white/10 text-white' }}">
                    <i data-lucide="newspaper" class="w-5 h-5 {{ request()->routeIs('admin.videos.*') ? 'text-primary' : 'text-secondary' }}"></i>
                    <span>Kelola Berita</span>
                </a>
                <a href="{{ route('admin.locations.index') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors duration-200 group {{ request()->routeIs('admin.locations.*') ? 'bg-secondary text-primary font-semibold' : 'hover:bg-white/10 text-white' }}">
                    <i data-lucide="map" class="w-5 h-5 {{ request()->routeIs('admin.locations.*') ? 'text-primary' : 'text-secondary' }}"></i>
                    <span>Kelola Fasilitas Desa</span>
                </a>
                <a href="{{ route('admin.aparat.index') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors duration-200 group {{ request()->routeIs('admin.aparat.*') ? 'bg-secondary text-primary font-semibold' : 'hover:bg-white/10 text-white' }}">
                    <i data-lucide="users" class="w-5 h-5 {{ request()->routeIs('admin.aparat.*') ? 'text-primary' : 'text-secondary' }}"></i>
                    <span>Kelola Aparatur</span>
                </a>
                {{-- <a href="{{ route('admin.citizens.index') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors duration-200 group {{ request()->routeIs('admin.citizens.*') ? 'bg-secondary text-primary font-semibold' : 'hover:bg-white/10 text-white' }}">
                    <i data-lucide="users-2" class="w-5 h-5 {{ request()->routeIs('admin.citizens.*') ? 'text-primary' : 'text-secondary' }}"></i>
                    <span>Kelola Data Warga</span>
                </a> --}}
                <a href="{{ route('admin.products.index') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors duration-200 group {{ request()->routeIs('admin.products.*') ? 'bg-secondary text-primary font-semibold' : 'hover:bg-white/10 text-white' }}">
                    <i data-lucide="shopping-bag" class="w-5 h-5 {{ request()->routeIs('admin.products.*') ? 'text-primary' : 'text-secondary' }}"></i>
                    <span>Kelola Produk Desa</span>
                </a>
            </nav>

            <!-- User Info -->
            <div class="px-4 py-4 border-t border-white/10">
                @auth
                    <div class="bg-white/5 rounded-lg p-3 mb-3">
                        <div class="flex items-center space-x-3 mb-2">
                            <div class="w-8 h-8 bg-secondary rounded-full flex items-center justify-center">
                                <i data-lucide="user" class="w-4 h-4 text-primary"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-white">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-300 opacity-80">Administrator</p>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center space-x-2 text-sm px-4 py-2 bg-red-500/20 hover:bg-red-500/30 text-red-300 hover:text-red-200 rounded-lg transition-colors duration-200">
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
            <div class="lg:hidden bg-primary text-white flex items-center justify-between px-4 py-4 border-b border-gray-300 shadow-sm relative z-40">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-secondary rounded-lg flex items-center justify-center">
                        <i data-lucide="map-pin" class="w-5 h-5 text-primary"></i>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold">Desa Wonokarang</h1>
                        <p class="text-xs opacity-80">Admin Panel</p>
                    </div>
                </div>
                <button id="mobile-menu-button" 
                        class="p-3 hover:bg-white/10 rounded-lg transition-colors duration-200 relative z-50 min-w-[44px] min-h-[44px] flex items-center justify-center"
                        type="button"
                        aria-label="Toggle mobile menu">
                    <i data-lucide="menu" class="w-6 h-6 pointer-events-none"></i>
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

        // Debug: Check if elements exist
        console.log('Mobile menu button:', mobileMenuButton);
        console.log('Mobile sidebar:', mobileSidebar);
        console.log('Mobile overlay:', mobileOverlay);

        if (!mobileMenuButton || !mobileSidebar || !mobileOverlay) {
            console.error('Mobile menu elements not found');
            return;
        }

        function toggleMobileMenu() {
            const isHidden = mobileSidebar.classList.contains('-translate-x-full');
            
            if (isHidden) {
                // Opening sidebar
                mobileSidebar.classList.remove('-translate-x-full');
                mobileOverlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden'; // Prevent body scroll
            } else {
                // Closing sidebar
                mobileSidebar.classList.add('-translate-x-full');
                mobileOverlay.classList.add('hidden');
                document.body.style.overflow = ''; // Restore body scroll
            }
        }

        function closeMobileMenu() {
            mobileSidebar.classList.add('-translate-x-full');
            mobileOverlay.classList.add('hidden');
            document.body.style.overflow = ''; // Restore body scroll
        }

        // Toggle mobile menu
        mobileMenuButton.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('Mobile menu button clicked');
            toggleMobileMenu();
        });

        // Also add touchstart event for better mobile support
        mobileMenuButton.addEventListener('touchstart', function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('Mobile menu button touched');
        });

        // Close mobile menu when clicking overlay
        mobileOverlay.addEventListener('click', closeMobileMenu);

        // Close mobile menu when clicking navigation links (for better UX)
        const mobileNavLinks = mobileSidebar.querySelectorAll('nav a');
        mobileNavLinks.forEach(link => {
            link.addEventListener('click', function() {
                setTimeout(closeMobileMenu, 100); // Small delay for better UX
            });
        });

        // Handle screen resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) { // lg breakpoint
                closeMobileMenu();
            }
        });

        // Initialize Lucide icons
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>
