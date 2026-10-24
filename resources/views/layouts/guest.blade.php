<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SIM Inventaris Sarpras - SMKN 1 Ketapang') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-800 antialiased bg-gradient-to-br from-slate-50 via-sky-50/50 to-blue-50/40 selection:bg-blue-600 selection:text-white min-h-screen flex flex-col justify-center relative overflow-x-hidden">
        <!-- Soft ambient lighting spots (light mode) -->
        <div class="fixed -top-40 -left-40 w-96 h-96 bg-blue-200/40 rounded-full blur-3xl pointer-events-none -z-10"></div>
        <div class="fixed -bottom-40 -right-40 w-96 h-96 bg-sky-200/40 rounded-full blur-3xl pointer-events-none -z-10"></div>

        <div class="w-full min-h-screen flex flex-col justify-center items-center py-8 sm:py-12 px-4 sm:px-6 lg:px-8 relative z-10">
            @if(empty($maxWidth) || $maxWidth === 'sm:max-w-md')
                <!-- Compact Header for Standard Guest Pages (Register, Forgot Password) -->
                <div class="text-center mb-6">
                    <a href="/" class="inline-flex items-center gap-3.5 group active:scale-95 transition-transform duration-150">
                        <div class="w-14 h-14 rounded-2xl overflow-hidden bg-white shadow-md shadow-blue-500/10 border border-blue-100 flex items-center justify-center shrink-0 p-1 group-hover:scale-105 transition-transform duration-200">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo SMKN 1 Ketapang" class="w-full h-full object-contain rounded-xl">
                        </div>
                        <div class="text-left">
                            <span class="block font-black text-slate-900 text-xl tracking-tight leading-tight group-hover:text-blue-600 transition-colors">SMKN 1 KETAPANG</span>
                            <span class="text-[11px] text-blue-600 font-bold tracking-wider uppercase">SIM Inventaris Sarana & Prasarana</span>
                        </div>
                    </a>
                </div>
            @endif

            <div class="w-full {{ $maxWidth ?? 'sm:max-w-md' }}">
                @if(empty($maxWidth) || $maxWidth === 'sm:max-w-md')
                    <div class="bg-white border border-blue-100/90 shadow-xl shadow-blue-500/5 rounded-3xl p-6 sm:p-8 backdrop-blur-sm">
                        {{ $slot }}
                    </div>
                @else
                    {{ $slot }}
                @endif
            </div>

            <div class="mt-8 text-center text-xs text-slate-400">
                &copy; {{ date('Y') }} SMKN 1 Ketapang &bull; Sistem Manajemen Inventaris Sarana & Prasarana.
            </div>
        </div>

        <script>
            // Mencegah token CSRF kedaluwarsa jika halaman dibuka kembali dari cache browser (bfcache/Back button)
            window.addEventListener('pageshow', function (event) {
                if (event.persisted) {
                    window.location.reload();
                }
            });
        </script>
    </body>
</html>
