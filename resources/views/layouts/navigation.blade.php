<nav x-data="{ open: false }" class="bg-white/95 backdrop-blur-md border-b border-blue-100/80 sticky top-0 z-30 shadow-[0_2px_12px_rgba(37,99,235,0.03)]">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center space-x-3">
                <!-- Logo & School Branding -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 group active:scale-95 transition-all">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-600 to-sky-400 text-white flex items-center justify-center font-bold text-base shadow-sm shadow-blue-500/25 group-hover:shadow-md group-hover:shadow-blue-500/30 transition-all duration-200">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-bold text-slate-800 text-sm tracking-tight leading-none group-hover:text-blue-600 transition">SIM SARPRAS</span>
                            <span class="text-[10px] text-blue-600/80 font-semibold tracking-wider uppercase mt-0.5">Inventaris Sekolah</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:-my-px sm:ms-6 lg:flex items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>

                    @if(Auth::user()->isAdmin())
                        <x-nav-link :href="route('items.index')" :active="request()->routeIs('items.*')">
                            Data Barang
                        </x-nav-link>

                        <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                            Kategori
                        </x-nav-link>

                        <x-nav-link :href="route('loans.index')" :active="request()->routeIs('loans.*')">
                            Peminjaman
                        </x-nav-link>

                        <x-nav-link :href="route('return_logs.index')" :active="request()->routeIs('return_logs.*')">
                            Pengembalian
                        </x-nav-link>

                        <x-nav-link :href="route('reports.index')" :active="request()->routeIs('reports.*')">
                            Laporan
                        </x-nav-link>

                        <x-nav-link :href="route('activity_logs.index')" :active="request()->routeIs('activity_logs.*')">
                            Audit Trail
                        </x-nav-link>

                        <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                            Pengguna
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('items.index')" :active="request()->routeIs('items.*')">
                            Katalog Barang
                        </x-nav-link>

                        <x-nav-link :href="route('loans.index')" :active="request()->routeIs('loans.*')">
                            Peminjaman Saya
                        </x-nav-link>

                        <x-nav-link :href="route('return_logs.index')" :active="request()->routeIs('return_logs.*')">
                            Riwayat Kembali
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown & User profile -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-3">
                <!-- Role Tag -->
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ Auth::user()->isAdmin() ? 'bg-blue-50 text-blue-700 border border-blue-200/80' : 'bg-emerald-50 text-emerald-800 border border-emerald-200' }}">
                    <span class="w-1.5 h-1.5 rounded-full mr-1.5 {{ Auth::user()->isAdmin() ? 'bg-blue-600' : 'bg-emerald-500' }}"></span>
                    {{ Auth::user()->isAdmin() ? 'Administrator' : 'Peminjam' }}
                </span>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-1.5 border border-slate-200 text-xs font-semibold rounded-lg text-slate-700 bg-white hover:bg-blue-50/50 hover:border-blue-200 focus:outline-none transition-all duration-200 active:scale-95 shadow-xs">
                            <div class="w-6 h-6 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-xs font-bold mr-2 uppercase">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div class="truncate max-w-[130px]">{{ Auth::user()->name }}</div>

                            <svg class="ms-1.5 fill-current h-3.5 w-3.5 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-2.5 text-xs text-slate-500 border-b border-slate-100 bg-slate-50/60">
                            Masuk sebagai <strong class="text-slate-800 block truncate">{{ Auth::user()->email }}</strong>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')" class="text-xs transition-colors hover:bg-blue-50 hover:text-blue-700">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Profil Saya
                            </span>
                        </x-dropdown-link>

                        <!-- Authentication -->
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

            <!-- Hamburger -->
            <div class="-me-2 flex items-center lg:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-slate-500 hover:text-blue-600 hover:bg-blue-50 focus:outline-none transition-all active:scale-95">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden border-t border-blue-100 bg-white">
        <div class="pt-2 pb-3 space-y-1 px-3">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>

            @if(Auth::user()->isAdmin())
                <x-responsive-nav-link :href="route('items.index')" :active="request()->routeIs('items.*')">
                    Data Barang
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                    Kategori
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('loans.index')" :active="request()->routeIs('loans.*')">
                    Peminjaman
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('return_logs.index')" :active="request()->routeIs('return_logs.*')">
                    Pengembalian
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('reports.index')" :active="request()->routeIs('reports.*')">
                    Laporan
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('activity_logs.index')" :active="request()->routeIs('activity_logs.*')">
                    Audit Trail
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                    Pengguna
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('items.index')" :active="request()->routeIs('items.*')">
                    Katalog Barang
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('loans.index')" :active="request()->routeIs('loans.*')">
                    Peminjaman Saya
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('return_logs.index')" :active="request()->routeIs('return_logs.*')">
                    Riwayat Kembali
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-3 border-t border-slate-100 px-4 bg-blue-50/30">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <div class="font-semibold text-sm text-slate-800">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-slate-500">{{ Auth::user()->email }}</div>
                </div>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold {{ Auth::user()->isAdmin() ? 'bg-blue-100 text-blue-800' : 'bg-emerald-100 text-emerald-800' }}">
                    {{ Auth::user()->role }}
                </span>
            </div>

            <div class="space-y-1">
                <a href="{{ route('profile.edit') }}" class="block py-2 text-xs text-slate-700 hover:text-blue-600 font-medium">
                    Profil Saya
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left py-2 text-xs text-rose-600 hover:text-rose-800 font-medium">
                        Keluar (Log Out)
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
