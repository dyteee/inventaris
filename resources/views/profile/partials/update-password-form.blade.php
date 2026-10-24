<form method="post" action="{{ route('password.update') }}" class="space-y-4">
    @csrf
    @method('put')

    <!-- Kata Sandi Saat Ini -->
    <div>
        <label for="update_password_current_password" class="block text-xs font-bold text-slate-700 mb-1">
            Kata Sandi Saat Ini <span class="text-rose-500">*</span>
        </label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <input 
                id="update_password_current_password" 
                name="current_password" 
                type="password" 
                class="pl-9 block w-full rounded-xl border-slate-200 shadow-xs focus:border-amber-500 focus:ring-amber-500 text-xs py-2.5 px-3 transition" 
                autocomplete="current-password" 
                placeholder="••••••••"
                required
            />
        </div>
        <x-input-error :messages="$errors?->updatePassword?->get('current_password') ?? []" class="mt-1.5" />
    </div>

    <!-- Grid Kata Sandi Baru & Konfirmasi -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <!-- Kata Sandi Baru -->
        <div>
            <label for="update_password_password" class="block text-xs font-bold text-slate-700 mb-1">
                Kata Sandi Baru <span class="text-rose-500">*</span>
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                </div>
                <input 
                    id="update_password_password" 
                    name="password" 
                    type="password" 
                    class="pl-9 block w-full rounded-xl border-slate-200 shadow-xs focus:border-amber-500 focus:ring-amber-500 text-xs py-2.5 px-3 transition" 
                    autocomplete="new-password" 
                    placeholder="Minimal 8 karakter"
                    required
                />
            </div>
            <x-input-error :messages="$errors?->updatePassword?->get('password') ?? []" class="mt-1.5" />
        </div>

        <!-- Konfirmasi Kata Sandi -->
        <div>
            <label for="update_password_password_confirmation" class="block text-xs font-bold text-slate-700 mb-1">
                Ulangi Kata Sandi Baru <span class="text-rose-500">*</span>
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <input 
                    id="update_password_password_confirmation" 
                    name="password_confirmation" 
                    type="password" 
                    class="pl-9 block w-full rounded-xl border-slate-200 shadow-xs focus:border-amber-500 focus:ring-amber-500 text-xs py-2.5 px-3 transition" 
                    autocomplete="new-password" 
                    placeholder="Ulangi kata sandi baru"
                    required
                />
            </div>
            <x-input-error :messages="$errors?->updatePassword?->get('password_confirmation') ?? []" class="mt-1.5" />
        </div>
    </div>

    <!-- Security hint -->
    <div class="p-3 bg-slate-50 border border-slate-100 rounded-xl text-[11px] text-slate-500 flex items-center gap-2">
        <svg class="w-4 h-4 text-amber-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>Gunakan minimal 8 karakter dengan kombinasi huruf, angka, dan tanda baca agar kata sandi kuat.</span>
    </div>

    <!-- Submit button -->
    <div class="pt-3 flex items-center justify-between border-t border-slate-100">
        <p class="text-[11px] text-slate-400">Kata sandi langsung diperbarui seketika.</p>
        <button 
            type="submit" 
            class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 active:scale-95 text-white text-xs font-semibold rounded-xl shadow-md shadow-amber-500/20 hover:shadow-lg hover:shadow-amber-500/25 transition-all duration-150"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
            <span>Perbarui Kata Sandi</span>
        </button>
    </div>
</form>
