<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}" class="space-y-4">
    @csrf
    @method('patch')

    <!-- Nama Pengguna -->
    <div>
        <label for="name" class="block text-xs font-bold text-slate-700 mb-1">
            Nama Lengkap Pengguna <span class="text-rose-500">*</span>
        </label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <input 
                id="name" 
                name="name" 
                type="text" 
                class="pl-9 block w-full rounded-xl border-slate-200 shadow-xs focus:border-blue-500 focus:ring-blue-500 text-xs py-2.5 px-3 transition" 
                value="{{ old('name', $user->name) }}" 
                required 
                autofocus 
                autocomplete="name" 
                placeholder="Contoh: Penguji 1"
            />
        </div>
        <x-input-error class="mt-1.5" :messages="$errors?->get('name') ?? []" />
    </div>

    <!-- Alamat Email -->
    <div>
        <label for="email" class="block text-xs font-bold text-slate-700 mb-1">
            Alamat Email Pengguna <span class="text-rose-500">*</span>
        </label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <input 
                id="email" 
                name="email" 
                type="email" 
                class="pl-9 block w-full rounded-xl border-slate-200 shadow-xs focus:border-blue-500 focus:ring-blue-500 text-xs py-2.5 px-3 transition" 
                value="{{ old('email', $user->email) }}" 
                required 
                autocomplete="username" 
                placeholder="email@sekolah.sch.id"
            />
        </div>
        <x-input-error class="mt-1.5" :messages="$errors?->get('email') ?? []" />

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-3 p-3 rounded-xl bg-amber-50 border border-amber-200 flex items-start gap-2 text-xs text-amber-800">
                <svg class="w-4 h-4 text-amber-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <div>
                    <p class="font-medium">Alamat email Anda belum terverifikasi.</p>
                    <button form="send-verification" class="mt-1 text-blue-700 underline hover:text-blue-900 font-semibold text-[11px]">
                        Kirim ulang tautan verifikasi ke email ini.
                    </button>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-1 text-emerald-700 font-semibold text-[11px]">
                            Tautan verifikasi baru telah dikirim ke alamat email Anda.
                        </p>
                    @endif
                </div>
            </div>
        @endif
    </div>

    <!-- Tombol Submit -->
    <div class="pt-3 flex items-center justify-between border-t border-slate-100">
        <p class="text-[11px] text-slate-400">Data otomatis tersinkronisasi ke seluruh sistem Sarpras.</p>
        <button 
            type="submit" 
            class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 active:scale-95 text-white text-xs font-semibold rounded-xl shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/25 transition-all duration-150"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span>Simpan Perubahan Profil</span>
        </button>
    </div>
</form>
