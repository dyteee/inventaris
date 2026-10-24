<x-app-layout>
    <x-slot name="header">
        <nav class="text-xs text-blue-600/70 mb-1 flex items-center gap-1.5 font-medium">
            <a href="{{ route('dashboard') }}" class="hover:text-blue-700 transition">Dashboard</a>
            <span class="text-slate-300">&rsaquo;</span>
            <a href="{{ route('loans.index') }}" class="hover:text-blue-700 transition">Peminjaman</a>
            <span class="text-slate-300">&rsaquo;</span>
            <span class="text-slate-700 font-semibold">Ajukan Peminjaman</span>
        </nav>
        <div class="flex items-center gap-3">
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Form Pengajuan Peminjaman Barang</h1>
            <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                Sirkulasi Sarpras
            </span>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl border border-blue-100/80 shadow-[0_8px_30px_rgba(37,99,235,0.06)] overflow-hidden">
            <!-- Header Banner -->
            <div class="p-6 bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-700 text-white flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center border border-white/20 shadow-xs shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-bold text-white tracking-tight">Formulir Peminjaman Sarpras</h2>
                    <p class="text-xs text-blue-100/80">Lengkapi data barang, jumlah unit yang dibutuhkan, serta tanggal batas pengembalian.</p>
                </div>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('loans.store') }}" class="p-6 sm:p-8 space-y-6">
                @csrf

                @if(Auth::user()->isAdmin())
                    <!-- Borrower Selector for Admin -->
                    <div class="bg-slate-50/70 p-4 rounded-xl border border-slate-100">
                        <label for="user_id" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
                            Peminjam (Guru / Siswa) <span class="text-rose-500">*</span>
                        </label>
                        <select 
                            name="user_id" 
                            id="user_id" 
                            autofocus
                            class="block w-full rounded-xl border-slate-200 bg-white text-xs py-2.5 px-3.5 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition"
                            required
                        >
                            <option value="">-- Pilih Akun Peminjam --</option>
                            @foreach($users as $u)
                                <option value="{{ $u->id }}" {{ old('user_id') == $u->id ? 'selected' : '' }}>
                                    {{ $u->name }} ({{ $u->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                @endif

                <!-- Item Selector -->
                <div>
                    <label for="item_id" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
                        Pilih Barang Inventaris <span class="text-rose-500">*</span>
                    </label>
                    <select 
                        name="item_id" 
                        id="item_id" 
                        {{ !Auth::user()->isAdmin() ? 'autofocus' : '' }}
                        class="block w-full rounded-xl border-slate-200 bg-slate-50/40 text-xs py-2.5 px-3.5 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500/20 transition font-medium"
                        required
                        onchange="onItemSelect(this)"
                    >
                        <option value="">-- Pilih Barang yang Ingin Dipinjam --</option>
                        @foreach($items as $item)
                            <option 
                                value="{{ $item->id }}" 
                                {{ (old('item_id', $selectedItemId) == $item->id) ? 'selected' : '' }}
                                data-stock="{{ $item->stock }}"
                                data-code="{{ $item->code }}"
                                data-location="{{ $item->location ?? 'Gudang Sarpras' }}"
                                data-condition="{{ $item->condition }}"
                            >
                                {{ $item->name }} ({{ $item->code }}) — Stok Tersedia: {{ $item->stock }} unit [{{ $item->location }}]
                            </option>
                        @endforeach
                    </select>
                    @error('item_id')
                        <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror

                    <!-- Selected Item Info Card -->
                    <div id="selected_item_info" class="hidden mt-3 p-3.5 rounded-xl bg-blue-50/60 border border-blue-100 flex flex-wrap items-center justify-between gap-3 text-xs">
                        <div class="flex items-center gap-3">
                            <span class="font-mono font-bold text-blue-700 bg-blue-100/70 px-2 py-0.5 rounded text-[11px]" id="info_code">#CODE</span>
                            <span class="text-slate-600">Penempatan: <strong id="info_location" class="text-slate-800">-</strong></span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-slate-500">Stok Maksimal:</span>
                            <span id="info_stock" class="font-mono font-bold text-emerald-700 bg-emerald-100 px-2 py-0.5 rounded text-[11px]">0 unit</span>
                            <span id="info_condition" class="font-semibold uppercase text-[10px] px-2 py-0.5 rounded bg-slate-200 text-slate-700">BAIK</span>
                        </div>
                    </div>
                </div>

                <!-- Parameters Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    <!-- Quantity -->
                    <div>
                        <label for="quantity" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
                            Jumlah Unit <span class="text-rose-500">*</span>
                        </label>
                        <div class="flex items-center gap-2">
                            <button type="button" onclick="adjustLoanQty(-1)" class="w-10 h-10 rounded-xl border border-slate-200 bg-slate-50 hover:bg-slate-100 flex items-center justify-center text-slate-600 font-bold active:scale-95 transition">-</button>
                            <input 
                                type="number" 
                                name="quantity" 
                                id="quantity" 
                                value="{{ old('quantity', 1) }}" 
                                min="1"
                                class="block w-full rounded-xl border-slate-200 bg-slate-50/40 text-center text-xs py-2.5 px-3 font-mono font-bold text-slate-900 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500/20 transition"
                                required
                            >
                            <button type="button" onclick="adjustLoanQty(1)" class="w-10 h-10 rounded-xl border border-slate-200 bg-slate-50 hover:bg-slate-100 flex items-center justify-center text-slate-600 font-bold active:scale-95 transition">+</button>
                        </div>
                        @error('quantity')
                            <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Loan Date -->
                    <div>
                        <label for="loan_date" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
                            Tanggal Pinjam <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            type="date" 
                            name="loan_date" 
                            id="loan_date" 
                            value="{{ old('loan_date', date('Y-m-d')) }}" 
                            class="block w-full rounded-xl border-slate-200 bg-slate-50/40 text-xs py-2.5 px-3.5 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500/20 transition font-medium"
                            required
                        >
                        @error('loan_date')
                            <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Due Date -->
                    <div>
                        <label for="due_date" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
                            Batas Pengembalian <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            type="date" 
                            name="due_date" 
                            id="due_date" 
                            value="{{ old('due_date', date('Y-m-d', strtotime('+3 days'))) }}" 
                            class="block w-full rounded-xl border-slate-200 bg-slate-50/40 text-xs py-2.5 px-3.5 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500/20 transition font-medium"
                            required
                        >
                        <!-- Quick Presets -->
                        <div class="flex items-center gap-1.5 mt-2">
                            <button type="button" onclick="setDueDatePreset(3)" class="px-2 py-0.5 rounded-lg bg-slate-100 hover:bg-blue-50 text-[10px] text-slate-600 hover:text-blue-600 font-medium transition active:scale-95">+3 Hari</button>
                            <button type="button" onclick="setDueDatePreset(7)" class="px-2 py-0.5 rounded-lg bg-slate-100 hover:bg-blue-50 text-[10px] text-slate-600 hover:text-blue-600 font-medium transition active:scale-95">+7 Hari</button>
                            <button type="button" onclick="setDueDatePreset(14)" class="px-2 py-0.5 rounded-lg bg-slate-100 hover:bg-blue-50 text-[10px] text-slate-600 hover:text-blue-600 font-medium transition active:scale-95">+14 Hari</button>
                        </div>
                        @error('due_date')
                            <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Guidelines Notice -->
                <div class="bg-blue-50/70 border border-blue-200/80 rounded-2xl p-4 text-xs text-blue-900 flex items-start gap-3">
                    <svg class="w-5 h-5 text-blue-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="space-y-0.5">
                        <span class="font-bold text-slate-900 block">Ketentuan Peminjaman Sarpras:</span>
                        <p class="text-blue-800/80 leading-relaxed text-[11px]">
                            Barang harus dijaga kelengkapannya dan dikembalikan sebelum tanggal batas tempo. Apabila terjadi kerusakan atau kehilangan, peminjam wajib berkoordinasi dengan pengelola sarpras.
                        </p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('loans.index') }}" class="px-4 py-2.5 border border-slate-200 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-50 active:scale-95 transition">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white rounded-xl text-xs font-semibold shadow-md shadow-blue-500/25 active:scale-95 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Kirim Pengajuan Peminjaman
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function onItemSelect(selectEl) {
            const opt = selectEl.options[selectEl.selectedIndex];
            const infoBox = document.getElementById('selected_item_info');
            if (opt && opt.value) {
                const stock = opt.getAttribute('data-stock');
                const code = opt.getAttribute('data-code');
                const location = opt.getAttribute('data-location');
                const condition = opt.getAttribute('data-condition');

                document.getElementById('info_code').textContent = code;
                document.getElementById('info_location').textContent = location;
                document.getElementById('info_stock').textContent = stock + ' unit';
                document.getElementById('info_condition').textContent = condition.toUpperCase();
                
                const qtyInput = document.getElementById('quantity');
                qtyInput.max = stock;
                if (parseInt(qtyInput.value, 10) > parseInt(stock, 10)) {
                    qtyInput.value = stock;
                }

                infoBox.classList.remove('hidden');
            } else {
                infoBox.classList.add('hidden');
            }
        }

        function adjustLoanQty(delta) {
            const qtyInput = document.getElementById('quantity');
            let val = parseInt(qtyInput.value || '1', 10) + delta;
            if (val < 1) val = 1;
            const max = parseInt(qtyInput.max || '9999', 10);
            if (val > max) val = max;
            qtyInput.value = val;
        }

        function setDueDatePreset(days) {
            const loanDateVal = document.getElementById('loan_date').value;
            const baseDate = loanDateVal ? new Date(loanDateVal) : new Date();
            baseDate.setDate(baseDate.getDate() + days);
            const yyyy = baseDate.getFullYear();
            const mm = String(baseDate.getMonth() + 1).padStart(2, '0');
            const dd = String(baseDate.getDate()).padStart(2, '0');
            document.getElementById('due_date').value = `${yyyy}-${mm}-${dd}`;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const itemSelect = document.getElementById('item_id');
            if (itemSelect && itemSelect.value) {
                onItemSelect(itemSelect);
            }
        });
    </script>
</x-app-layout>
