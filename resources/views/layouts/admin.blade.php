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
    
    @stack('styles')
</head>
<body class="bg-white">
    @include('partials.admin')
    

    
    @if(!request()->is('admin*'))
        @include('partials.footer')
    @endif
    
    <script>
        // Initialize Lucide icons
        lucide.createIcons();
        
        // Session Keep-Alive untuk admin
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
        
        // Handle AJAX errors untuk session expired
        window.addEventListener('beforeunload', function() {
            if (sessionKeepAliveInterval) {
                clearInterval(sessionKeepAliveInterval);
            }
        });
        @endauth
    </script>
    
    @stack('scripts')
</body>
</html>