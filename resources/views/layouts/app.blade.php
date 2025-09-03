<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Profil Digital Desa Wonokarang')</title>
    <link rel="icon" href="{{ asset('img/logo_sidoarjo.png') }}" type="image/png">
    <meta name="description" content="Desa Wonokarang - Sentra Budidaya Bunga dan Pertanian Modern dengan Teknologi Terdepan">
    <meta name="keywords" content="desa wonokarang, pertanian, budidaya bunga, profil desa, wisata agro">
    <script src="//unpkg.com/alpinejs" defer></script>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#002B5B',
                        secondary: '#F2C94C',
                    }
                }
            }
        }
    </script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    
    <!-- Leaflet for Maps -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    {{-- CSS Global untuk mempertahankan formatting dari Quill Editor --}}
    <style>
        /* Mempertahankan text alignment dari Quill editor di semua halaman */
        .prose p[style*="text-align: center"],
        .text-gray-600 p[style*="text-align: center"] {
            text-align: center !important;
        }
        .prose p[style*="text-align: right"],
        .text-gray-600 p[style*="text-align: right"] {
            text-align: right !important;
        }
        .prose p[style*="text-align: left"],
        .text-gray-600 p[style*="text-align: left"] {
            text-align: left !important;
        }
        .prose p[style*="text-align: justify"],
        .text-gray-600 p[style*="text-align: justify"] {
            text-align: justify !important;
        }
        
        /* Untuk class-based alignment dari Quill */
        .prose .ql-align-center,
        .text-gray-600 .ql-align-center {
            text-align: center !important;
        }
        .prose .ql-align-right,
        .text-gray-600 .ql-align-right {
            text-align: right !important;
        }
        .prose .ql-align-left,
        .text-gray-600 .ql-align-left {
            text-align: left !important;
        }
        .prose .ql-align-justify,
        .text-gray-600 .ql-align-justify {
            text-align: justify !important;
        }

        /* Mempertahankan semua formatting lain dari Quill */
        .prose strong,
        .text-gray-600 strong {
            font-weight: bold !important;
        }
        .prose em,
        .text-gray-600 em {
            font-style: italic !important;
        }
        .prose u,
        .text-gray-600 u {
            text-decoration: underline !important;
        }
        .prose ol,
        .text-gray-600 ol {
            list-style-type: decimal !important;
            padding-left: 1.5rem !important;
        }
        .prose ul,
        .text-gray-600 ul {
            list-style-type: disc !important;
            padding-left: 1.5rem !important;
        }
        .prose a,
        .text-gray-600 a {
            color: #3b82f6 !important;
            text-decoration: underline !important;
        }
    </style>

    
    @stack('styles')
</head>
<body class="bg-white">
    @if (request()->routeIs('home'))
    @include('partials.header1')
@else
    @include('partials.header')
@endif

    
    <main>
        @yield('content')
    </main>
    
    @if(!request()->is('admin*'))
        @include('partials.footer')
    @endif
    
    <script>
        // Initialize Lucide icons
        lucide.createIcons();
        
        // Session Keep-Alive untuk user yang sudah login
        @auth
        let sessionKeepAliveInterval;
        let warningShown = false;
        
        // Function untuk refresh session
        function refreshSession() {
            fetch('{{ route("session.keepalive") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                                   document.querySelector('input[name="_token"]')?.value || ''
                },
                credentials: 'same-origin'
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Session refresh failed');
                }
                console.log('Session refreshed successfully');
                warningShown = false;
            }).catch(error => {
                console.error('Session refresh error:', error);
                if (!warningShown) {
                    warningShown = true;
                    if (confirm('Sesi Anda akan segera berakhir. Klik OK untuk memperpanjang sesi atau Cancel untuk logout.')) {
                        location.reload();
                    } else {
                        window.location.href = '{{ route("login") }}';
                    }
                }
            });
        }
        
        // Refresh session setiap 30 menit
        sessionKeepAliveInterval = setInterval(refreshSession, 30 * 60 * 1000);
        
        // Refresh session saat user aktif kembali (focus window)
        window.addEventListener('focus', function() {
            refreshSession();
        });
        
        // Refresh session saat user berinteraksi dengan halaman
        ['click', 'keypress', 'scroll', 'mousemove'].forEach(function(event) {
            let timeout;
            document.addEventListener(event, function() {
                clearTimeout(timeout);
                timeout = setTimeout(refreshSession, 5 * 60 * 1000); // 5 menit setelah aktivitas
            }, { passive: true });
        });
        @endauth
    </script>
    
    @stack('scripts')
    
</body>
</html>