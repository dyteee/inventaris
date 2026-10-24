<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <nav class="text-xs text-blue-600/80 mb-1 flex items-center gap-1.5 font-medium">
                    <span class="text-slate-400">SIM Sarpras</span>
                    <span class="text-slate-300">&rsaquo;</span>
                    <span class="text-slate-400">Akun Pengguna</span>
                    <span class="text-slate-300">&rsaquo;</span>
                    <span class="text-slate-700 font-semibold">Profil Saya</span>
                </nav>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight flex items-center gap-2.5">
                    <span>Profil Pengguna & Keamanan</span>
                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold {{ $user->isAdmin() ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'bg-emerald-50 text-emerald-800 border border-emerald-200' }}">
                        {{ $user->isAdmin() ? 'Administrator' : 'Peminjam' }}
                    </span>
                </h1>
            </div>

            <div class="flex items-center gap-2 text-xs text-slate-500">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Sesi Terautentikasi Aktif
                </span>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- HERO IDENTITY COVER BANNER -->
        <div class="relative rounded-2xl bg-gradient-to-r from-blue-700 via-indigo-600 to-sky-600 p-6 sm:p-8 text-white shadow-xl shadow-blue-600/10 overflow-hidden">
            <!-- Decorative Ambient Glow Circles -->
            <div class="absolute -top-12 -right-12 w-64 h-64 rounded-full bg-white/10 blur-2xl pointer-events-none"></div>
            <div class="absolute -bottom-12 -left-12 w-64 h-64 rounded-full bg-sky-400/20 blur-2xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col sm:flex-row items-center sm:items-start gap-5">
                <!-- Large Avatar Capsule -->
                <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl bg-white/20 backdrop-blur-md border-2 border-white/40 shadow-inner flex items-center justify-center text-3xl sm:text-4xl font-extrabold text-white shrink-0">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>

                <!-- User Info & Meta -->
                <div class="text-center sm:text-left flex-1 min-w-0">
                    <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2 mb-1">
                        <h2 class="text-xl sm:text-2xl font-extrabold tracking-tight truncate">{{ $user->name }}</h2>
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-white/20 backdrop-blur-md border border-white/30 text-white">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                            {{ $user->isAdmin() ? 'Super Admin' : 'Peminjam Terdaftar' }}
                        </span>
                    </div>

                    <p class="text-xs text-blue-100 flex items-center justify-center sm:justify-start gap-1.5 font-medium">
                        <svg class="w-3.5 h-3.5 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>{{ $user->email }}</span>
                    </p>

                    <!-- Quick Chips -->
                    <div class="mt-4 pt-4 border-t border-white/15 flex flex-wrap items-center justify-center sm:justify-start gap-3 text-[11px] text-blue-100">
                        <span class="inline-flex items-center gap-1.5 bg-white/10 px-2.5 py-1 rounded-lg backdrop-blur-xs">
                            <svg class="w-3.5 h-3.5 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Terdaftar: @indodate($user->created_at)
                        </span>

                        <span class="inline-flex items-center gap-1.5 bg-white/10 px-2.5 py-1 rounded-lg backdrop-blur-xs">
                            <svg class="w-3.5 h-3.5 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            ID Akun: #{{ $user->id }}
                        </span>

                        <span class="inline-flex items-center gap-1.5 bg-emerald-400/20 text-emerald-200 border border-emerald-400/30 px-2.5 py-1 rounded-lg">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                            Status: Aktif & Terlindungi
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- TWO-COLUMN MAIN GRID -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
            
            <!-- LEFT COLUMN: Roles, Badges, & Security Overview -->
            <div class="space-y-6">
                <!-- Role & Permissions Overview Card -->
                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-xs">
                    <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <span>Tingkat Hak Akses Sistem</span>
                    </h3>

                    <div class="p-3.5 rounded-xl {{ $user->isAdmin() ? 'bg-blue-50/60 border border-blue-100' : 'bg-emerald-50/60 border border-emerald-100' }} mb-4">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold {{ $user->isAdmin() ? 'text-blue-900' : 'text-emerald-900' }}">
                                {{ $user->isAdmin() ? 'Akses Penuh (Administrator)' : 'Akses Peminjam (User)' }}
                            </span>
                            <span class="text-[10px] px-2 py-0.5 rounded font-mono font-bold {{ $user->isAdmin() ? 'bg-blue-600 text-white' : 'bg-emerald-600 text-white' }}">
                                {{ strtoupper($user->role) }}
                            </span>
                        </div>
                        <p class="text-[11px] text-slate-600 mt-1 leading-relaxed">
                            {{ $user->isAdmin() 
                                ? 'Memiliki wewenang mengelola seluruh inventaris, menyetujui transaksi, cetak barcode QR, mencetak laporan, serta audit trail.' 
                                : 'Memiliki hak melihat katalog barang, mengajukan peminjaman sarpras, dan memantau riwayat peminjaman mandiri.' }}
                        </p>
                    </div>

                    <!-- Permissions Checklist -->
                    <div class="space-y-2 text-xs">
                        <div class="flex items-center justify-between py-1 border-b border-slate-100">
                            <span class="text-slate-600">Katalog & Data Barang</span>
                            <span class="text-emerald-600 font-semibold flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                {{ $user->isAdmin() ? 'Kelola Penuh' : 'Melihat' }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between py-1 border-b border-slate-100">
                            <span class="text-slate-600">Transaksi Peminjaman</span>
                            <span class="text-emerald-600 font-semibold flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                {{ $user->isAdmin() ? 'Semua & Verifikasi' : 'Mandiri' }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between py-1 border-b border-slate-100">
                            <span class="text-slate-600">Laporan Resmi & Cetak</span>
                            <span class="{{ $user->isAdmin() ? 'text-emerald-600 font-semibold' : 'text-slate-400' }} flex items-center gap-1">
                                @if($user->isAdmin())
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Tersedia
                                @else
                                    &ndash;
                                @endif
                            </span>
                        </div>
                        <div class="flex items-center justify-between py-1">
                            <span class="text-slate-600">Audit Trail Aktivitas</span>
                            <span class="{{ $user->isAdmin() ? 'text-emerald-600 font-semibold' : 'text-slate-400' }} flex items-center gap-1">
                                @if($user->isAdmin())
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Tersedia
                                @else
                                    &ndash;
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity Logs Card -->
                @if(isset($recentLogs) && $recentLogs->count() > 0)
                    <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-xs">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider flex items-center gap-2">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Aktivitas Terakhir Anda</span>
                            </h3>
                            @if($user->isAdmin())
                                <a href="{{ route('activity_logs.index') }}" class="text-[11px] text-blue-600 hover:underline font-semibold">Semua &rarr;</a>
                            @endif
                        </div>

                        <div class="space-y-3">
                            @foreach($recentLogs as $log)
                                <div class="text-xs p-2.5 rounded-xl bg-slate-50 border border-slate-100 flex flex-col gap-1">
                                    <div class="flex items-center justify-between">
                                        <span class="font-bold text-slate-800 uppercase text-[10px] tracking-wide text-blue-700">{{ $log->action }}</span>
                                        <span class="text-[10px] text-slate-400 font-mono">@indodatetime($log->created_at)</span>
                                    </div>
                                    <p class="text-[11px] text-slate-600 leading-snug">{{ $log->description }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Security Tips Box -->
                <div class="bg-gradient-to-br from-blue-50/70 to-indigo-50/40 rounded-2xl border border-blue-100/80 p-5">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-blue-600 text-white flex items-center justify-center shrink-0 shadow-sm shadow-blue-500/20">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-slate-900">Tips Keamanan Akun</h4>
                            <p class="text-[11px] text-slate-600 mt-1 leading-relaxed">
                                Selalu gunakan kombinasi sandi yang kuat (huruf, angka, simbol) dan jangan lupa untuk logout setelah selesai mengelola sistem di komputer bersama.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: Interactive Settings Forms -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Card 1: Update Profile Information -->
                <div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-7 shadow-xs">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold shadow-xs">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900">Informasi Biodata & Kontak</h3>
                            <p class="text-xs text-slate-500">Perbarui nama pengguna terdaftar dan alamat email resmi Anda.</p>
                        </div>
                    </div>

                    @include('profile.partials.update-profile-information-form')
                </div>

                <!-- Card 2: Update Password -->
                <div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-7 shadow-xs">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold shadow-xs">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900">Perbarui Kata Sandi</h3>
                            <p class="text-xs text-slate-500">Pastikan akun Anda menggunakan kata sandi yang aman dan tidak mudah ditebak.</p>
                        </div>
                    </div>

                    @include('profile.partials.update-password-form')
                </div>

                <!-- Card 3: Delete Account (Danger Zone) -->
                <div class="bg-white rounded-2xl border border-rose-100 p-6 sm:p-7 shadow-xs relative overflow-hidden">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-rose-100">
                        <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center font-bold shadow-xs">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-rose-900">Hapus Akun Pengguna</h3>
                            <p class="text-xs text-rose-600">Tindakan ini permanen dan akan menghapus seluruh data kredensial akses Anda.</p>
                        </div>
                    </div>

                    @include('profile.partials.delete-user-form')
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
