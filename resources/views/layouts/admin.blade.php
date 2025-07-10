<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Profil Digital Desa Mekar Sari')</title>
    <meta name="description" content="Desa Mekar Sari - Sentra Budidaya Bunga dan Pertanian Modern dengan Teknologi Terdepan">
    <meta name="keywords" content="desa mekar sari, pertanian, budidaya bunga, profil desa, wisata agro">
    
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
    </script>
    
    @stack('scripts')
</body>
</html>