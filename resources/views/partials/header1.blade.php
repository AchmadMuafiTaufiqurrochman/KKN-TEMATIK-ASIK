<header id="main-header" class="bg-transparent text-white fixed top-0 left-0 w-full z-50 transition-all duration-300 ease-in-out">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between py-4 transition-all duration-300">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-3">
               <div class="w-12 h-12 rounded-full flex items-center justify-center overflow-hidden">
                    <img src="{{ asset('img/logo_sidoarjo.png') }}" alt="Logo Sidoarjo"
                        class="w-full h-full object-contain">
                </div>
                <div>
                    <h1 class="text-xl font-bold">Desa Wonokarang</h1>
                    <p class="text-sm opacity-90">Profil Digital</p>
                </div>
            </a>

            <!-- Desktop Navigation -->
             <nav class="hidden lg:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="hover:text-secondary transition-colors duration-200 py-2 border-b-2 {{ request()->routeIs('home') ? 'border-secondary text-secondary' : 'border-transparent hover:border-secondary' }}">
                    Beranda
                </a>
                <a href="{{ route('about') }}" class="hover:text-secondary transition-colors duration-200 py-2 border-b-2 {{ request()->routeIs('about') ? 'border-secondary text-secondary' : 'border-transparent hover:border-secondary' }}">
                    Tentang Desa
                </a>
                <a href="{{ route('aparat') }}" class="hover:text-secondary transition-colors duration-200 py-2 border-b-2 {{ request()->routeIs('aparat') ? 'border-secondary text-secondary' : 'border-transparent hover:border-secondary' }}">
                    Aparatur Desa
                </a>
                <a href="{{ route('potential') }}" class="hover:text-secondary transition-colors duration-200 py-2 border-b-2 {{ request()->routeIs('potential') ? 'border-secondary text-secondary' : 'border-transparent hover:border-secondary' }}">
                    Produk Desa
                </a>
                <a href="{{ route('documentation') }}" class="hover:text-secondary transition-colors duration-200 py-2 border-b-2 {{ request()->routeIs('documentation') ? 'border-secondary text-secondary' : 'border-transparent hover:border-secondary' }}">
                    Berita
                </a>
                <a href="{{ route('map') }}" class="hover:text-secondary transition-colors duration-200 py-2 border-b-2 {{ request()->routeIs('map') ? 'border-secondary text-secondary' : 'border-transparent hover:border-secondary' }}">
                    Peta
                </a>
              
                
            </nav>

            <!-- User Menu & Social Media -->
            <div class="hidden lg:flex items-center space-x-4">
               <div class="flex items-center space-x-2">
                    <i data-lucide="facebook" class="w-5 h-5 hover:text-secondary cursor-pointer transition-colors"></i>
                    <i data-lucide="instagram" class="w-5 h-5 hover:text-secondary cursor-pointer transition-colors"></i>
                    <i data-lucide="youtube" class="w-5 h-5 hover:text-secondary cursor-pointer transition-colors"></i>
                </div>
                
                @auth
                    <div class="flex items-center space-x-4 border-l border-white/20 pl-4">
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 hover:text-secondary transition-colors">
                                <i data-lucide="user" class="w-4 h-4"></i>
                                <span>{{ auth()->user()->name }}</span>
                            </a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="flex items-center space-x-2 hover:text-secondary transition-colors">
                                <i data-lucide="log-out" class="w-4 h-4"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                @else
                    <div class="border-l border-white/20 pl-4">
                        <a href="{{ route('login') }}" class="bg-secondary text-primary px-4 py-2 rounded-lg font-semibold hover:bg-yellow-400 transition-colors">
                            Login
                        </a>
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
            <a href="{{ route('home') }}" class="block py-2 transition-colors {{ request()->routeIs('home') ? 'text-secondary' : 'hover:text-secondary' }}">
                Beranda
            </a>
            <a href="{{ route('about') }}" class="block py-2 transition-colors {{ request()->routeIs('about') ? 'text-secondary' : 'hover:text-secondary' }}">
                Tentang Desa
            </a>
            <a href="{{ route('aparat') }}" class="block py-2 transition-colors {{ request()->routeIs('aparat') ? 'text-secondary' : 'hover:text-secondary' }}">
                Aparatur Desa
            </a>
            <a href="{{ route('potential') }}" class="block py-2 transition-colors {{ request()->routeIs('potential') ? 'text-secondary' : 'hover:text-secondary' }}">
                Produk Desa
            </a>
            <a href="{{ route('documentation') }}" class="block py-2 transition-colors {{ request()->routeIs('documentation') ? 'text-secondary' : 'hover:text-secondary' }}">
                Berita
            </a>
            <a href="{{ route('map') }}" class="block py-2 transition-colors {{ request()->routeIs('map') ? 'text-secondary' : 'hover:text-secondary' }}">
                Peta
            </a>

            
            @auth
                <div class="pt-4 border-t border-white/20 mt-4">
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="block py-2 hover:text-secondary transition-colors">
                            Dashboard Admin
                        </a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="block py-2 hover:text-secondary transition-colors">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <div class="pt-4 border-t border-white/20 mt-4">
                    <a href="{{ route('login') }}" class="block py-2 hover:text-secondary transition-colors">
                        Login
                    </a>
                </div>
            @endauth
            
            <div class="flex items-center space-x-4 pt-4 border-t border-white/20 mt-4">
                <i data-lucide="facebook" class="w-5 h-5 hover:text-secondary cursor-pointer transition-colors"></i>
                <i data-lucide="instagram" class="w-5 h-5 hover:text-secondary cursor-pointer transition-colors"></i>
                <i data-lucide="youtube" class="w-5 h-5 hover:text-secondary cursor-pointer transition-colors"></i>
            </div>
        </nav>
    </div>
</header>

<style>
    .nav-link {
        @apply hover:text-secondary transition-colors duration-200 py-2 border-b-2 border-transparent hover:border-secondary;
    }
    .social-icon {
        @apply hover:text-secondary transition-colors cursor-pointer;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const header = document.getElementById('main-header');

        mobileMenuButton.addEventListener('click', function () {
            mobileMenu.classList.toggle('hidden');
        });

        window.addEventListener('scroll', function () {
            if (window.scrollY > 50) {
                header.classList.remove('bg-transparent', 'text-white');
                header.classList.add('bg-primary', 'backdrop-blur-md', 'shadow-md', 'text-white');
            } else {
                header.classList.remove('bg-primary', 'backdrop-blur-md', 'shadow-md', 'text-white');
                header.classList.add('bg-transparent', 'text-white');
            }
        });
    });
</script>
