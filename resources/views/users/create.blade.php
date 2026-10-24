<x-app-layout>
    <x-slot name="header">
        <nav class="text-xs text-blue-600/70 mb-1 flex items-center gap-1.5 font-medium">
            <a href="{{ route('dashboard') }}" class="hover:text-blue-700 transition">Dashboard</a>
            <span class="text-slate-300">&rsaquo;</span>
            <a href="{{ route('users.index') }}" class="hover:text-blue-700 transition">Pengguna</a>
            <span class="text-slate-300">&rsaquo;</span>
            <span class="text-slate-700 font-semibold">Tambah Pengguna</span>
        </nav>
        <div class="flex items-center gap-3">
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Tambah Akun Pengguna Baru</h1>
            <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                Akun Baru
            </span>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl border border-blue-100/80 shadow-[0_8px_30px_rgba(37,99,235,0.06)] overflow-hidden">
            <!-- Header Banner with Live Initials Avatar -->
            <div class="p-6 bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-700 text-white flex items-center gap-4">
                <div id="avatar-preview" class="w-14 h-14 rounded-2xl bg-white text-blue-700 font-black text-lg flex items-center justify-center shadow-md shadow-blue-900/20 shrink-0">
                    PG
                </div>
                <div>
                    <h2 id="header-user-name" class="text-base font-bold text-white tracking-tight">Registrasi Akun Baru</h2>
                    <p class="text-xs text-blue-100/80">Buat akun untuk guru, staf, atau siswa peminjam sarpras.</p>
                </div>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('users.store') }}" class="p-6 sm:p-8 space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
                        Nama Lengkap <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <input 
                            type="text" 
                            name="name" 
                            id="user_name" 
                            value="{{ old('name') }}" 
                            autofocus
                            placeholder="Contoh: Penguji 4" 
                            class="block w-full rounded-xl border-slate-200 bg-slate-50/40 text-xs py-2.5 px-3.5 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500/20 transition font-medium"
                            required
                            oninput="updateAvatarPreview(this.value)"
                        >
                    </div>
                    @error('name')
                        <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
                        Alamat Email <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            value="{{ old('email') }}" 
                            placeholder="nama@sekolah.sch.id" 
                            class="block w-full rounded-xl border-slate-200 bg-slate-50/40 text-xs py-2.5 px-3.5 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500/20 transition font-medium"
                            required
                        >
                    </div>
                    @error('email')
                        <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role Selector with Interactive Cards -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wider">
                        Hak Akses Sistem (Role) <span class="text-rose-500">*</span>
                    </label>
                    <input type="hidden" name="role" id="role_input" value="{{ old('role', 'user') }}">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <!-- User Card -->
                        <button 
                            type="button" 
                            onclick="setRole('user')" 
                            id="btn-role-user"
                            class="p-4 rounded-xl border text-left transition-all flex items-start gap-3 {{ old('role', 'user') === 'user' ? 'border-blue-500 bg-blue-50/50 ring-2 ring-blue-500/20 shadow-xs' : 'border-slate-200 bg-white hover:bg-slate-50' }}"
                        >
                            <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <span class="text-xs font-bold text-slate-900 block">User (Peminjam)</span>
                                <p class="text-[11px] text-slate-500 mt-0.5 leading-tight">Guru atau siswa yang meminjam barang dan melihat sirkulasi pribadi.</p>
                            </div>
                        </button>

                        <!-- Admin Card -->
                        <button 
                            type="button" 
                            onclick="setRole('admin')" 
                            id="btn-role-admin"
                            class="p-4 rounded-xl border text-left transition-all flex items-start gap-3 {{ old('role') === 'admin' ? 'border-blue-500 bg-blue-50/50 ring-2 ring-blue-500/20 shadow-xs' : 'border-slate-200 bg-white hover:bg-slate-50' }}"
                        >
                            <div class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <div>
                                <span class="text-xs font-bold text-slate-900 block">Administrator</span>
                                <p class="text-[11px] text-slate-500 mt-0.5 leading-tight">Akses penuh mengelola sarpras, kategori, transaksi, dan audit trail.</p>
                            </div>
                        </button>
                    </div>
                    @error('role')
                        <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Section -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
                            Kata Sandi <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            placeholder="Minimal 8 karakter" 
                            class="block w-full rounded-xl border-slate-200 bg-slate-50/40 text-xs py-2.5 px-3.5 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500/20 transition"
                            required
                        >
                        @error('password')
                            <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirmation -->
                    <div>
                        <label for="password_confirmation" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
                            Konfirmasi Sandi <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            id="password_confirmation" 
                            placeholder="Ketik ulang kata sandi" 
                            class="block w-full rounded-xl border-slate-200 bg-slate-50/40 text-xs py-2.5 px-3.5 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500/20 transition"
                            required
                        >
                    </div>
                </div>

                <!-- Actions -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('users.index') }}" class="px-4 py-2.5 border border-slate-200 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-50 active:scale-95 transition">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white rounded-xl text-xs font-semibold shadow-md shadow-blue-500/25 active:scale-95 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Simpan Akun Pengguna
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function updateAvatarPreview(name) {
            const trimmed = name.trim();
            const initials = trimmed.length >= 2 ? trimmed.substring(0, 2).toUpperCase() : (trimmed.substring(0, 1).toUpperCase() || 'PG');
            document.getElementById('avatar-preview').textContent = initials;
            document.getElementById('header-user-name').textContent = trimmed || 'Registrasi Akun Baru';
        }

        function setRole(role) {
            document.getElementById('role_input').value = role;
            const btnUser = document.getElementById('btn-role-user');
            const btnAdmin = document.getElementById('btn-role-admin');

            if (role === 'user') {
                btnUser.className = 'p-4 rounded-xl border text-left transition-all flex items-start gap-3 border-blue-500 bg-blue-50/50 ring-2 ring-blue-500/20 shadow-xs';
                btnAdmin.className = 'p-4 rounded-xl border text-left transition-all flex items-start gap-3 border-slate-200 bg-white hover:bg-slate-50';
            } else {
                btnAdmin.className = 'p-4 rounded-xl border text-left transition-all flex items-start gap-3 border-blue-500 bg-blue-50/50 ring-2 ring-blue-500/20 shadow-xs';
                btnUser.className = 'p-4 rounded-xl border text-left transition-all flex items-start gap-3 border-slate-200 bg-white hover:bg-slate-50';
            }
        }
    </script>
</x-app-layout>
