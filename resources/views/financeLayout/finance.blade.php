<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @class(['dark' => ($appearance ?? 'system') == 'dark'])>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - HMIF</title>
    <meta name="description" content="Sistem informasi keuangan HMIF - Transparansi keuangan organisasi">
    <link rel="icon" type="image/png" href="{{ asset('img/logos/hmif.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/logos/hmif.png') }}">
    @vite(['resources/css/app.css', "resources/js/app.tsx"])
</head>
<body class="bg-gray-100 min-h-screen">
    @include('financeLayout.Navbar')
    
    <main class="min-h-[calc(100vh-4rem)]">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto px-4 py-6">
            <div class="text-center">
                <p class="text-sm text-gray-600">
                    &copy; {{ date('Y') }} HMIF - Himpunan Mahasiswa Informatika
                </p>
                <p class="text-xs text-gray-500 mt-1">
                    Transparansi Keuangan untuk Kemajuan Organisasi
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
