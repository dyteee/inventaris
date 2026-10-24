@if($user->id === 1)
    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-700 flex items-start gap-3">
        <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center shrink-0 font-bold">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
        </div>
        <div>
            <h4 class="font-bold text-slate-900">Akun Dilindungi oleh Sistem</h4>
            <p class="text-[11px] text-slate-600 mt-1 leading-relaxed">
                Akun <strong>{{ $user->name }}</strong> (#{{ $user->id }}) merupakan akun Administrator Utama pengelola inventaris sekolah dan dilindungi secara permanen dari penghapusan demi menjaga integritas data sistem.
            </p>
        </div>
    </div>
@else
    <div class="space-y-4">
        <p class="text-xs text-slate-600 leading-relaxed">
            Setelah akun Anda dihapus, seluruh data sesi, riwayat otorisasi, dan hak akses sistem Anda akan dihapus secara permanen. Pastikan Anda telah mempertimbangkan keputusan ini.
        </p>

        <div>
            <button 
                type="button" 
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-rose-50 hover:bg-rose-100 border border-rose-200 text-rose-700 active:scale-95 text-xs font-semibold rounded-xl transition-all duration-150"
            >
                <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                <span>Konfirmasi Penghapusan Akun Saya</span>
            </button>
        </div>

        <x-modal name="confirm-user-deletion" :show="isset($errors->userDeletion) && $errors->userDeletion->isNotEmpty()" focusable>
            <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                @csrf
                @method('delete')

                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-slate-900">
                            Apakah Anda yakin ingin menghapus akun?
                        </h2>
                        <p class="text-xs text-slate-500 mt-0.5">
                            Tindakan ini tidak dapat dibatalkan. Masukkan kata sandi Anda untuk mengonfirmasi.
                        </p>
                    </div>
                </div>

                <div class="mt-4">
                    <label for="password" class="block text-xs font-bold text-slate-700 mb-1">
                        Kata Sandi Akun Anda <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        id="password" 
                        name="password" 
                        type="password" 
                        class="block w-full rounded-xl border-slate-200 shadow-xs focus:border-rose-500 focus:ring-rose-500 text-xs py-2.5 px-3 transition" 
                        placeholder="Masukkan kata sandi saat ini"
                        required
                    />
                    <x-input-error :messages="$errors?->userDeletion?->get('password') ?? []" class="mt-1.5" />
                </div>

                <div class="mt-6 flex items-center justify-end gap-3 pt-3 border-t border-slate-100">
                    <button 
                        type="button" 
                        x-on:click="$dispatch('close')" 
                        class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold active:scale-95 transition"
                    >
                        Batalkan
                    </button>

                    <button 
                        type="submit" 
                        class="px-4 py-2 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold shadow-md shadow-rose-500/20 active:scale-95 transition"
                    >
                        Ya, Hapus Akun Ini
                    </button>
                </div>
            </form>
        </x-modal>
    </div>
@endif
