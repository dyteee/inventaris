<x-guest-layout maxWidth="max-w-5xl">
    <div 
        x-data="{
            showPassword: false
        }"
        class="bg-white rounded-3xl shadow-xl shadow-blue-500/5 border border-blue-100/90 overflow-hidden grid grid-cols-1 lg:grid-cols-12 transition-all duration-300"
    >
        <!-- LEFT PANEL: Bright Hero Branding & School Showcase (lg: 5 cols) -->
        <div class="lg:col-span-5 bg-gradient-to-br from-blue-50/90 via-sky-50/40 to-indigo-50/30 p-8 sm:p-10 flex flex-col justify-between border-b lg:border-b-0 lg:border-r border-blue-100/80 relative overflow-hidden">
            <!-- Subtle soft light ambient circles -->
            <div class="absolute -top-20 -left-20 w-64 h-64 bg-blue-200/40 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-sky-200/40 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10">
                <!-- School Emblem & Name -->
                <div class="flex items-center gap-3.5 mb-6">
                    <div class="w-14 h-14 rounded-2xl bg-white shadow-md shadow-blue-500/10 p-1 border border-blue-100 flex items-center justify-center shrink-0">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo SMKN 1 Ketapang" class="w-full h-full object-contain rounded-xl">
                    </div>
                    <div>
                        <span class="block font-black text-slate-900 text-lg tracking-tight leading-tight">SMKN 1 KETAPANG</span>
                        <span class="inline-block text-[11px] text-blue-600 font-bold tracking-wider uppercase mt-0.5">SIM SARPRAS INVENTARIS</span>
                    </div>
                </div>

                <!-- Headline -->
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight leading-snug">
                    Sistem Manajemen Sarana & Prasarana
                </h1>
                <p class="text-xs sm:text-sm text-slate-600 mt-2.5 leading-relaxed">
                    Portal terpadu inventarisasi aset, sirkulasi peminjaman sarpras, serta rekapitulasi data akreditasi SMKN 1 Ketapang.
                </p>

                <!-- Key Capabilities List (Bright clean cards) -->
                <div class="mt-7 space-y-3">
                    <div class="flex items-start gap-3 p-3 rounded-2xl bg-white/90 border border-blue-100/80 shadow-2xs">
                        <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 border border-blue-100">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Tracking QR Code & Barcode</h3>
                            <p class="text-[11px] text-slate-500 leading-normal">Pelabelan digital otomatis untuk setiap sarpras ruangan dan laboratorium.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 p-3 rounded-2xl bg-white/90 border border-blue-100/80 shadow-2xs">
                        <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 border border-emerald-100">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Sirkulasi Peminjaman Cepat</h3>
                            <p class="text-[11px] text-slate-500 leading-normal">Pengajuan mandiri bagi guru & siswa secara tertib dan transparan.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 p-3 rounded-2xl bg-white/90 border border-blue-100/80 shadow-2xs">
                        <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 border border-amber-100">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Laporan Resmi Akreditasi</h3>
                            <p class="text-[11px] text-slate-500 leading-normal">Kop surat kedinasan Kalimantan Barat dengan lembar tanda tangan legal.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Status Indicator -->
            <div class="mt-7 pt-4 border-t border-blue-100 flex items-center justify-between text-xs text-slate-500 relative z-10">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-[11px] font-semibold text-slate-600">Sistem Online &bull; Terhubung</span>
                </div>
                <span class="text-[10px] uppercase font-mono font-bold tracking-wider bg-blue-100/60 px-2 py-0.5 rounded-md text-blue-700 border border-blue-200/50">
                    BOS &bull; DAK &bull; Sarpras
                </span>
            </div>
        </div>

        <!-- RIGHT PANEL: Clean Interactive Login Form & Quick-Fill Demo (lg: 7 cols) -->
        <div class="lg:col-span-7 p-8 sm:p-10 flex flex-col justify-between bg-white relative">
            <div>
                <!-- Form Header -->
                <div class="mb-5">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-bold tracking-wide uppercase mb-2 border border-blue-100">
                        <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Autentikasi Pengguna
                    </span>
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight">Masuk ke Portal Sarpras</h2>
                    <p class="text-xs text-slate-500 mt-1">Masukkan email dan kata sandi akun Anda untuk melanjutkan.</p>
                </div>

                <!-- Session / Error Alerts -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                @if (session('error'))
                    <div class="mb-4 p-3 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-xs font-medium flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-rose-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <!-- Main Login Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Alamat Email Pengguna <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative rounded-xl shadow-xs">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <input 
                                id="email" 
                                class="block w-full rounded-xl border-slate-200 pl-10 pr-4 py-2.5 text-xs text-slate-900 placeholder:text-slate-400 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 transition" 
                                type="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                placeholder="nama@sekolah.sch.id"
                                required 
                                autofocus 
                                autocomplete="username" 
                            />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <!-- Password Field with Show/Hide Toggle -->
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                                Kata Sandi (Password) <span class="text-rose-500">*</span>
                            </label>
                            @if (Route::has('password.request'))
                                <a class="text-[11px] text-blue-600 hover:text-blue-700 font-semibold hover:underline" href="{{ route('password.request') }}">
                                    Lupa password?
                                </a>
                            @endif
                        </div>
                        <div class="relative rounded-xl shadow-xs">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input 
                                id="password" 
                                :type="showPassword ? 'text' : 'password'"
                                class="block w-full rounded-xl border-slate-200 pl-10 pr-10 py-2.5 text-xs text-slate-900 placeholder:text-slate-400 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 transition"
                                name="password"
                                placeholder="••••••••"
                                required 
                                autocomplete="current-password" 
                            />
                            <button 
                                type="button" 
                                @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-700 transition focus:outline-none"
                                aria-label="Lihat kata sandi"
                            >
                                <svg x-show="!showPassword" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg x-show="showPassword" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <!-- Remember Me Option -->
                    <div class="flex items-center justify-between text-xs pt-1">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer">
                            <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-blue-600 shadow-xs focus:ring-blue-500 cursor-pointer" name="remember">
                            <span class="ms-2 text-slate-600 font-medium select-none">Ingat sesi saya di komputer ini</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button 
                            type="submit" 
                            class="w-full py-3 px-4 bg-gradient-to-r from-blue-600 via-sky-600 to-indigo-600 hover:from-blue-700 hover:via-sky-700 hover:to-indigo-700 active:scale-[0.98] text-white font-bold text-xs rounded-xl shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/25 transition-all duration-200 flex items-center justify-center gap-2 group cursor-pointer"
                        >
                            <span>Masuk ke Sistem Inventaris</span>
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>

                    <!-- Divider -->
                    <div class="relative my-3 flex items-center justify-center">
                        <div class="border-t border-slate-200 w-full"></div>
                        <div class="bg-white px-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider shrink-0">atau masuk dengan</div>
                        <div class="border-t border-slate-200 w-full"></div>
                    </div>

                    <!-- Google Login Button -->
                    <div>
                        <button 
                            type="button" 
                            class="w-full py-2.5 px-4 bg-white hover:bg-slate-50 border border-slate-200 hover:border-slate-300 rounded-xl text-xs font-semibold text-slate-700 shadow-2xs hover:shadow-xs transition-all duration-150 active:scale-[0.98] flex items-center justify-center gap-2.5 cursor-pointer"
                        >
                            <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17z"/>
                                <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.33 24 12 24z"/>
                                <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/>
                                <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                            </svg>
                            <span>Masuk dengan Akun Google</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Bottom Register Link -->
            <div class="mt-7 pt-4 border-t border-slate-100 text-center">
                <p class="text-xs text-slate-500">
                    Belum memiliki akun peminjam? 
                    <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:text-blue-700 hover:underline">
                        Daftar Akun Baru Sekarang &rarr;
                    </a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
