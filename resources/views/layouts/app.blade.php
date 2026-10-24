<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'SIM Inventaris Sarpras - SMKN 1 Ketapang' }}</title>
        <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#f8fafd] text-slate-800 min-h-screen selection:bg-blue-600 selection:text-white" x-data="{ sidebarOpen: false }">
        
        <!-- Mobile Sidebar Backdrop -->
        <div 
            x-show="sidebarOpen" 
            x-transition:enter="transition-opacity ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="sidebarOpen = false" 
            class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-40 lg:hidden"
            x-cloak
        ></div>

        <!-- Sidebar Navigation -->
        @include('layouts.sidebar')

        <!-- Main Content Area -->
        <div class="lg:pl-64 flex flex-col min-h-screen transition-all duration-300">
            
            <!-- Sticky Top Header Bar -->
            <header class="bg-white/90 backdrop-blur-md border-b border-slate-200/80 sticky top-0 z-30 shadow-[0_1px_4px_rgba(0,0,0,0.02)]">
                <div class="px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                    
                    <!-- Left: Mobile Toggle & Page Context -->
                    <div class="flex items-center gap-3">
                        <button 
                            type="button" 
                            @click="sidebarOpen = true" 
                            class="lg:hidden p-2 rounded-xl text-slate-600 hover:text-blue-600 hover:bg-blue-50/80 border border-slate-200/80 focus:outline-none transition-all active:scale-95 shadow-xs"
                            aria-label="Buka Menu Navigasi"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                        <div class="flex items-center gap-2.5">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo SMKN 1 Ketapang" class="w-6 h-6 object-contain rounded-md shrink-0 lg:hidden">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-blue-50/80 text-blue-700 text-xs font-semibold border border-blue-100">
                                <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                                SMKN 1 Ketapang
                            </span>
                            <span class="text-xs text-slate-400 hidden sm:inline">&rsaquo;</span>
                            <span class="text-xs font-medium text-slate-500 hidden sm:inline">SIM Inventaris Sarana & Prasarana</span>
                        </div>
                    </div>

                    <!-- Right: Quick Info & User Profile -->
                    <div class="flex items-center gap-2 sm:gap-3">
                        <!-- Date Badge -->
                        <div class="hidden sm:flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-100 text-slate-600 text-xs font-medium border border-slate-200/60">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>@indodate(now())</span>
                        </div>

                        @php
                            $user = Auth::user();
                            $isAdmin = $user && $user->isAdmin();
                        @endphp

                        <!-- Role Badge -->
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold {{ $isAdmin ? 'bg-blue-50 text-blue-700 border border-blue-200/80' : 'bg-emerald-50 text-emerald-800 border border-emerald-200' }}">
                            <span class="w-1.5 h-1.5 rounded-full mr-1.5 {{ $isAdmin ? 'bg-blue-600' : 'bg-emerald-500' }}"></span>
                            <span class="hidden sm:inline">{{ $isAdmin ? 'Administrator' : 'Peminjam' }}</span>
                            <span class="sm:hidden">{{ $isAdmin ? 'Admin' : 'User' }}</span>
                        </span>

                        <!-- User Profile Dropdown -->
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center gap-2 px-2.5 py-1.5 border border-slate-200 text-xs font-semibold rounded-xl text-slate-700 bg-white hover:bg-slate-50 hover:border-slate-300 focus:outline-none transition-all duration-150 active:scale-95 shadow-xs">
                                    <div class="w-6 h-6 rounded-lg {{ $isAdmin ? 'bg-blue-600' : 'bg-emerald-600' }} text-white flex items-center justify-center text-[11px] font-bold">
                                        {{ strtoupper(substr($user?->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <span class="hidden md:inline-block max-w-[120px] truncate">{{ $user?->name ?? 'Pengguna' }}</span>
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="px-4 py-2 text-xs text-slate-500 border-b border-slate-100 bg-slate-50/70">
                                    <span class="block text-[10px] uppercase font-bold text-slate-400">Akun Terdaftar</span>
                                    <strong class="text-slate-800 block truncate mt-0.5">{{ $user?->email ?? '-' }}</strong>
                                </div>

                                <x-dropdown-link :href="route('profile.edit')" class="text-xs transition-colors hover:bg-blue-50 hover:text-blue-700">
                                    <span class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Profil Saya
                                    </span>
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();" class="text-rose-600 hover:text-rose-700 hover:bg-rose-50 text-xs transition-colors">
                                        <span class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            Keluar (Log Out)
                                        </span>
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </header>

            <!-- Page Specific Header (Title & Action Buttons) -->
            @isset($header)
                <div class="bg-white border-b border-slate-200/70 shadow-[0_1px_3px_rgba(0,0,0,0.02)]">
                    <div class="px-4 sm:px-6 lg:px-8 py-5">
                        {{ $header }}
                    </div>
                </div>
            @endisset

            <!-- Flash Alert Notifications -->
            <div class="px-4 sm:px-6 lg:px-8 pt-4 w-full">
                @if(session('success'))
                    <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl flex items-center justify-between text-xs font-medium shadow-xs" role="alert">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button type="button" onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-950 p-1 rounded hover:bg-emerald-100/60 active:scale-95 transition" aria-label="Tutup">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 rounded-xl flex items-center justify-between text-xs font-medium shadow-xs" role="alert">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-rose-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <span>{{ session('error') }}</span>
                        </div>
                        <button type="button" onclick="this.parentElement.remove()" class="text-rose-700 hover:text-rose-950 p-1 rounded hover:bg-rose-100/60 active:scale-95 transition" aria-label="Tutup">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endif

                @if(isset($errors) && $errors->any())
                    <div class="mb-4 bg-amber-50 border border-amber-200 text-amber-900 px-4 py-3 rounded-xl text-xs shadow-xs" role="alert">
                        <div class="font-semibold mb-1 flex items-center gap-2">
                            <svg class="w-4 h-4 text-amber-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            Periksa kembali formulir input Anda:
                        </div>
                        <ul class="list-disc list-inside ml-5 text-[11px] text-amber-800 space-y-0.5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <!-- Page Main Content Slot with smooth page entrance animation -->
            <main class="flex-1 px-4 sm:px-6 lg:px-8 py-6 animate-page-entrance">
                {{ $slot }}
            </main>

            <!-- Bottom Content Footer -->
            <footer class="bg-white border-t border-slate-200/80 mt-auto py-4 text-xs text-slate-500">
                <div class="px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-3">
                    <div class="flex items-center gap-2">
                        <span class="font-semibold text-slate-700">SIM Sarana & Prasarana Sekolah</span>
                        <span class="text-slate-300">&bull;</span>
                        <span class="text-slate-500">Tahun Ajaran {{ date('Y') }}/{{ date('Y')+1 }}</span>
                    </div>
                    <div class="text-slate-400 flex items-center gap-3 text-[11px]">
                        <span class="flex items-center gap-1.5 text-blue-600 font-medium">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Sistem Online
                        </span>
                        <span>&bull;</span>
                        <span>Standar Akreditasi Sarpras</span>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Smooth Interactive Pop-up Modals -->
        <x-animated-success-popup />
        <x-custom-confirm-modal />

        @stack('scripts')
    </body>
</html>
