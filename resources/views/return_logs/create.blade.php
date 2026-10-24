<x-app-layout>
    <x-slot name="header">
        <nav class="text-xs text-blue-600/70 mb-1 flex items-center gap-1.5 font-medium">
            <a href="{{ route('dashboard') }}" class="hover:text-blue-700 transition">Dashboard</a>
            <span class="text-slate-300">&rsaquo;</span>
            <a href="{{ route('return_logs.index') }}" class="hover:text-blue-700 transition">Pengembalian</a>
            <span class="text-slate-300">&rsaquo;</span>
            <span class="text-slate-700 font-semibold">Catat Pengembalian</span>
        </nav>
        <div class="flex items-center gap-3">
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Verifikasi & Catat Pengembalian</h1>
            <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                Pemeriksaan Fisik
            </span>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-2xl border border-blue-100/80 shadow-[0_8px_30px_rgba(37,99,235,0.06)] overflow-hidden">
            <!-- Header Banner -->
            <div class="p-6 bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-700 text-white flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center border border-white/20 shadow-xs shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-bold text-white tracking-tight">Pemeriksaan & Verifikasi Fisik Aset</h2>
                    <p class="text-xs text-blue-100/90">Pastikan fisik barang lengkap dan tentukan status kelayakan barang yang dikembalikan.</p>
                </div>
            </div>

            @if($loans->isEmpty() && !$selectedLoan)
                <div class="p-12 text-center space-y-4">
                    <div class="w-16 h-16 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mx-auto border border-blue-200">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900">Semua Peminjaman Sudah Dikembalikan</h3>
                        <p class="text-xs text-slate-500 max-w-sm mx-auto mt-1">Saat ini tidak ada barang inventaris sekolah yang berstatus dipinjam atau terlambat.</p>
                    </div>
                    <div class="pt-2">
                        <a href="{{ route('loans.index') }}" class="inline-flex items-center gap-1.5 px-5 py-2.5 bg-blue-600 hover:bg-blue-500 text-white rounded-xl text-xs font-semibold shadow-sm transition active:scale-95">
                            Lihat Arsip Peminjaman
                        </a>
                    </div>
                </div>
            @else
                <form method="POST" action="{{ route('return_logs.store') }}" class="p-6 sm:p-8 space-y-6">
                    @csrf

                    <!-- Loan Selector -->
                    <div>
                        <label for="loan_id" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
                            Pilih Transaksi Peminjaman yang Dikembalikan <span class="text-rose-500">*</span>
                        </label>
                        <select 
                            name="loan_id" 
                            id="loan_id" 
                            autofocus
                            class="block w-full rounded-xl border-slate-200 bg-slate-50/40 text-xs py-2.5 px-3.5 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500/20 transition font-medium"
                            required
                        >
                            <option value="">-- Pilih Transaksi Aktif --</option>
                            @foreach($loans as $loan)
                                <option value="{{ $loan->id }}" {{ (old('loan_id', $selectedLoanId) == $loan->id) ? 'selected' : '' }}>
                                    [#TRX-{{ $loan->id }}] {{ $loan->user->name }} — {{ $loan->item->name }} ({{ $loan->quantity }} unit) &bull; Batas: {{ $loan->due_date->format('d/m/Y') }}
                                </option>
                            @endforeach
                        </select>
                        @error('loan_id')
                            <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Returned At -->
                        <div>
                            <label for="returned_at" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
                                Tanggal Dikembalikan <span class="text-rose-500">*</span>
                            </label>
                            <input 
                                type="date" 
                                name="returned_at" 
                                id="returned_at" 
                                value="{{ old('returned_at', date('Y-m-d')) }}" 
                                class="block w-full rounded-xl border-slate-200 bg-slate-50/40 text-xs py-2.5 px-3.5 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500/20 transition font-medium"
                                required
                            >
                            @error('returned_at')
                                <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Condition on Return Selector -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
                                Kondisi Fisik Saat Kembali <span class="text-rose-500">*</span>
                            </label>
                            <input type="hidden" name="condition_on_return" id="condition_input" value="{{ old('condition_on_return', 'baik') }}">
                            
                            <div class="grid grid-cols-3 gap-2">
                                <button 
                                    type="button" 
                                    onclick="setReturnCond('baik')" 
                                    id="btn-rcond-baik"
                                    class="py-2.5 px-2 rounded-xl border text-center transition-all text-xs font-bold {{ old('condition_on_return', 'baik') === 'baik' ? 'border-blue-500 bg-blue-50 text-blue-700 ring-2 ring-blue-500/20' : 'border-slate-200 text-slate-600 hover:bg-slate-50' }}"
                                >
                                    Baik
                                </button>
                                <button 
                                    type="button" 
                                    onclick="setReturnCond('rusak ringan')" 
                                    id="btn-rcond-rusak-ringan"
                                    class="py-2.5 px-2 rounded-xl border text-center transition-all text-xs font-bold {{ old('condition_on_return') === 'rusak ringan' ? 'border-amber-500 bg-amber-50 text-amber-700 ring-2 ring-amber-500/20' : 'border-slate-200 text-slate-600 hover:bg-slate-50' }}"
                                >
                                    Rusak Ringan
                                </button>
                                <button 
                                    type="button" 
                                    onclick="setReturnCond('rusak berat')" 
                                    id="btn-rcond-rusak-berat"
                                    class="py-2.5 px-2 rounded-xl border text-center transition-all text-xs font-bold {{ old('condition_on_return') === 'rusak berat' ? 'border-rose-500 bg-rose-50 text-rose-700 ring-2 ring-rose-500/20' : 'border-slate-200 text-slate-600 hover:bg-slate-50' }}"
                                >
                                    Rusak Berat
                                </button>
                            </div>
                            @error('condition_on_return')
                                <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Notes -->
                    <div>
                        <label for="notes" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
                            Catatan Pemeriksaan / Kerusakan (Opsional)
                        </label>
                        <textarea 
                            name="notes" 
                            id="notes" 
                            rows="3" 
                            placeholder="Contoh: Barang dikembalikan lengkap beserta kabel adaptor dan tas pelindung, kondisi mulus tanpa lecet."
                            class="block w-full rounded-xl border-slate-200 bg-slate-50/40 text-xs py-2.5 px-3.5 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500/20 transition"
                        >{{ old('notes') }}</textarea>
                        <p class="text-xs text-slate-400 mt-1">Bila ada kelengkapan yang tertinggal atau cacat fisik baru, cantumkan secara jelas di sini.</p>
                        @error('notes')
                            <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Actions -->
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                        <a href="{{ route('return_logs.index') }}" class="px-4 py-2.5 border border-slate-200 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-50 active:scale-95 transition">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white rounded-xl text-xs font-semibold shadow-md shadow-blue-500/25 active:scale-95 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Verifikasi & Simpan Pengembalian
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>

    <script>
        function setReturnCond(cond) {
            document.getElementById('condition_input').value = cond;
            ['baik', 'rusak ringan', 'rusak berat'].forEach(c => {
                const id = 'btn-rcond-' + c.replace(' ', '-');
                const btn = document.getElementById(id);
                if (!btn) return;
                if (c === cond) {
                    if (c === 'baik') btn.className = 'py-2.5 px-2 rounded-xl border text-center transition-all text-xs font-bold border-blue-500 bg-blue-50 text-blue-700 ring-2 ring-blue-500/20';
                    if (c === 'rusak ringan') btn.className = 'py-2.5 px-2 rounded-xl border text-center transition-all text-xs font-bold border-amber-500 bg-amber-50 text-amber-700 ring-2 ring-amber-500/20';
                    if (c === 'rusak berat') btn.className = 'py-2.5 px-2 rounded-xl border text-center transition-all text-xs font-bold border-rose-500 bg-rose-50 text-rose-700 ring-2 ring-rose-500/20';
                } else {
                    btn.className = 'py-2.5 px-2 rounded-xl border text-center transition-all text-xs font-bold border-slate-200 text-slate-600 hover:bg-slate-50';
                }
            });
        }
    </script>
</x-app-layout>
