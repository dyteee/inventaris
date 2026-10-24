<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <nav class="text-xs text-slate-400 mb-1 flex items-center gap-1.5">
                    <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition">Dashboard</a>
                    <span>&rsaquo;</span>
                    <span class="text-slate-700 font-medium">Laporan & Rekapitulasi</span>
                </nav>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">
                    Laporan Sarana & Prasarana Sekolah
                </h1>
                <p class="text-xs text-slate-500 mt-0.5">Rekapitulasi aset barang, kondisi fisik, dan sirkulasi transaksi peminjaman.</p>
            </div>
            <div class="flex items-center gap-2">
                @if($type === 'items')
                    <a href="{{ route('reports.print', ['type' => 'items', 'category_id' => $categoryId, 'condition' => $condition, 'location' => $location]) }}" target="_blank" class="inline-flex items-center gap-2 px-3.5 py-2 bg-blue-600 text-white rounded-lg text-xs font-semibold hover:bg-blue-500 shadow-sm shadow-blue-500/20 transition-all duration-200 active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        Cetak Laporan Resmi
                    </a>
                    <a href="{{ route('reports.export_items', ['category_id' => $categoryId, 'condition' => $condition, 'location' => $location]) }}" class="inline-flex items-center gap-2 px-3.5 py-2 bg-white border border-slate-200 hover:border-emerald-300 text-slate-700 hover:bg-emerald-50/50 rounded-lg text-xs font-semibold transition-all duration-200 active:scale-95 shadow-xs">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Ekspor Excel / CSV
                    </a>
                @else
                    <a href="{{ route('reports.print', ['type' => 'loans', 'status' => $status, 'start_date' => $startDate, 'end_date' => $endDate]) }}" target="_blank" class="inline-flex items-center gap-2 px-3.5 py-2 bg-blue-600 text-white rounded-lg text-xs font-semibold hover:bg-blue-500 shadow-sm shadow-blue-500/20 transition-all duration-200 active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        Cetak Laporan Sirkulasi
                    </a>
                    <a href="{{ route('reports.export_loans', ['status' => $status, 'start_date' => $startDate, 'end_date' => $endDate]) }}" class="inline-flex items-center gap-2 px-3.5 py-2 bg-white border border-slate-200 hover:border-emerald-300 text-slate-700 hover:bg-emerald-50/50 rounded-lg text-xs font-semibold transition-all duration-200 active:scale-95 shadow-xs">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Ekspor Excel / CSV
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Summary Stat Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white p-4 rounded-xl border border-blue-100 shadow-[0_2px_10px_rgba(37,99,235,0.03)] card-hover">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wide">Total Item & Unit</span>
                <div class="flex items-baseline gap-2 mt-1">
                    <span class="text-2xl font-extrabold text-slate-900 font-mono">{{ number_format($totalItemsCount, 0, ',', '.') }}</span>
                    <span class="text-xs text-blue-600 font-medium">Jenis ({{ number_format($totalStockSum, 0, ',', '.') }} Unit Fisik)</span>
                </div>
            </div>

            <div class="bg-white p-4 rounded-xl border border-blue-100 shadow-[0_2px_10px_rgba(37,99,235,0.03)] card-hover">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wide">Kondisi Baik</span>
                <div class="flex items-baseline gap-2 mt-1">
                    <span class="text-2xl font-extrabold text-emerald-600 font-mono">{{ number_format($goodConditionCount, 0, ',', '.') }}</span>
                    <span class="text-xs text-emerald-700 font-medium">Unit Siap Pakai</span>
                </div>
            </div>

            <div class="bg-white p-4 rounded-xl border border-blue-100 shadow-[0_2px_10px_rgba(37,99,235,0.03)] card-hover">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wide">Perlu Perbaikan</span>
                <div class="flex items-baseline gap-2 mt-1">
                    <span class="text-2xl font-extrabold text-amber-600 font-mono">{{ number_format($lightDamageCount, 0, ',', '.') }}</span>
                    <span class="text-xs text-amber-700 font-medium">Rusak Ringan</span>
                </div>
            </div>

            <div class="bg-white p-4 rounded-xl border border-blue-100 shadow-[0_2px_10px_rgba(37,99,235,0.03)] card-hover">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wide">Afkir / Rusak Berat</span>
                <div class="flex items-baseline gap-2 mt-1">
                    <span class="text-2xl font-extrabold text-rose-600 font-mono">{{ number_format($heavyDamageCount, 0, ',', '.') }}</span>
                    <span class="text-xs text-rose-700 font-medium">Unit Rusak Total</span>
                </div>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="border-b border-blue-100">
            <nav class="flex space-x-6 text-sm font-medium">
                <a href="{{ route('reports.index', ['type' => 'items']) }}" class="pb-3 border-b-2 flex items-center gap-2 transition-all duration-200 active:scale-95 {{ $type === 'items' ? 'border-blue-600 text-blue-600 font-bold' : 'border-transparent text-slate-500 hover:text-blue-600' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Rekapitulasi Aset Barang
                </a>
                <a href="{{ route('reports.index', ['type' => 'loans']) }}" class="pb-3 border-b-2 flex items-center gap-2 transition-all duration-200 active:scale-95 {{ $type === 'loans' ? 'border-blue-600 text-blue-600 font-bold' : 'border-transparent text-slate-500 hover:text-blue-600' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Laporan Sirkulasi Peminjaman
                </a>
            </nav>
        </div>

        @if($type === 'items')
            <!-- ITEMS REPORT FILTER & TABLE -->
            <div class="bg-white p-4 rounded-xl border border-blue-100/80 shadow-[0_2px_10px_rgba(37,99,235,0.03)]">
                <form method="GET" action="{{ route('reports.index') }}" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3">
                    <input type="hidden" name="type" value="items">
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Kategori</label>
                        <select name="category_id" class="w-full text-xs rounded-lg border-slate-200 shadow-xs focus:border-blue-500 focus:ring-2 focus:ring-blue-400/20 transition">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $categoryId == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Ruangan / Penempatan</label>
                        <select name="location" class="w-full text-xs rounded-lg border-slate-200 shadow-xs focus:border-blue-500 focus:ring-2 focus:ring-blue-400/20 transition">
                            <option value="">Semua Ruangan</option>
                            @foreach($locations as $loc)
                                <option value="{{ $loc }}" {{ $location == $loc ? 'selected' : '' }}>{{ $loc }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Kondisi Fisik</label>
                        <select name="condition" class="w-full text-xs rounded-lg border-slate-200 shadow-xs focus:border-blue-500 focus:ring-2 focus:ring-blue-400/20 transition">
                            <option value="">Semua Kondisi</option>
                            <option value="baik" {{ $condition === 'baik' ? 'selected' : '' }}>Baik</option>
                            <option value="rusak ringan" {{ $condition === 'rusak ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                            <option value="rusak berat" {{ $condition === 'rusak berat' ? 'selected' : '' }}>Rusak Berat</option>
                        </select>
                    </div>

                    <div class="flex items-end gap-1.5">
                        <button type="submit" class="flex-1 py-2 bg-blue-600 text-white rounded-lg text-xs font-semibold hover:bg-blue-500 shadow-sm shadow-blue-500/20 transition-all active:scale-95 h-[35px]">
                            Terapkan Filter
                        </button>
                        @if($categoryId || $condition || $location)
                            <a href="{{ route('reports.index', ['type' => 'items']) }}" class="px-2.5 py-2 bg-slate-100 hover:bg-blue-50 text-slate-600 hover:text-blue-600 rounded-lg text-xs font-bold transition-all active:scale-95 h-[35px] flex items-center">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-xl border border-slate-200/90 shadow-[0_2px_12px_rgba(37,99,235,0.03)] overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-slate-600">
                        <thead class="bg-slate-50/70 text-[11px] uppercase tracking-wider text-slate-500 border-b border-slate-200">
                            <tr>
                                <th class="py-3 px-3.5 w-12 text-center">No</th>
                                <th class="py-3 px-3.5">Kode Barang</th>
                                <th class="py-3 px-3.5">Nama Sarpras / Aset</th>
                                <th class="py-3 px-3.5">Kategori</th>
                                <th class="py-3 px-3.5">Ruang / Penempatan</th>
                                <th class="py-3 px-3.5 text-center">Stok Unit</th>
                                <th class="py-3 px-3.5 text-center">Kondisi</th>
                                <th class="py-3 px-3.5">Sumber Dana</th>
                                <th class="py-3 px-3.5 text-center">Tahun</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($items as $index => $item)
                                <tr class="row-hover">
                                    <td class="py-3 px-3.5 text-center text-slate-400 font-mono">{{ $index + 1 }}</td>
                                    <td class="py-3 px-3.5 font-mono font-bold text-blue-700">{{ $item->code }}</td>
                                    <td class="py-3 px-3.5 font-medium text-slate-900">
                                        {{ $item->name }}
                                        @if($item->description)
                                            <div class="text-[11px] text-slate-400 font-normal line-clamp-1 mt-0.5">{{ $item->description }}</div>
                                        @endif
                                    </td>
                                    <td class="py-3 px-3.5 text-slate-600">{{ $item->category->name ?? '-' }}</td>
                                    <td class="py-3 px-3.5 text-slate-700">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] bg-blue-50/70 text-blue-700 border border-blue-200/60 font-medium">
                                            {{ $item->location ?? 'Gudang Sarpras' }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-3.5 text-center font-bold text-slate-900 font-mono">{{ $item->stock }}</td>
                                    <td class="py-3 px-3.5 text-center">
                                        @if($item->condition === 'baik')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                Baik
                                            </span>
                                        @elseif($item->condition === 'rusak ringan')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                                Rusak Ringan
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                                Rusak Berat
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-3.5 text-slate-600">{{ $item->source_fund ?? '-' }}</td>
                                    <td class="py-3 px-3.5 text-center font-mono text-slate-600">{{ $item->procurement_year ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="py-8 text-center text-slate-400">
                                        Tidak ada data barang yang sesuai dengan filter.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot class="bg-blue-50/40 border-t border-blue-100 text-xs font-semibold text-slate-800">
                            <tr>
                                <td colspan="5" class="py-3 px-3.5 text-right uppercase tracking-wider text-slate-500">Total Akumulasi Fisik:</td>
                                <td class="py-3 px-3.5 text-center font-bold text-blue-700 font-mono">{{ $items->sum('stock') }} Unit</td>
                                <td colspan="3" class="py-3 px-3.5 text-slate-500 font-normal">({{ $items->count() }} macam item)</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        @else
            <!-- LOANS REPORT FILTER & TABLE -->
            <div class="bg-white p-4 rounded-xl border border-blue-100/80 shadow-[0_2px_10px_rgba(37,99,235,0.03)]">
                <form method="GET" action="{{ route('reports.index') }}" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3">
                    <input type="hidden" name="type" value="loans">
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Status Transaksi</label>
                        <select name="status" class="w-full text-xs rounded-lg border-slate-200 shadow-xs focus:border-blue-500 focus:ring-2 focus:ring-blue-400/20 transition">
                            <option value="">Semua Status</option>
                            <option value="dipinjam" {{ $status === 'dipinjam' ? 'selected' : '' }}>Sedang Dipinjam</option>
                            <option value="dikembalikan" {{ $status === 'dikembalikan' ? 'selected' : '' }}>Sudah Dikembalikan</option>
                            <option value="terlambat" {{ $status === 'terlambat' ? 'selected' : '' }}>Terlambat</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Tanggal Mulai Pinjam</label>
                        <input type="date" name="start_date" value="{{ $startDate }}" class="w-full text-xs rounded-lg border-slate-200 shadow-xs focus:border-blue-500 focus:ring-2 focus:ring-blue-400/20 transition">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Sampai Tanggal</label>
                        <input type="date" name="end_date" value="{{ $endDate }}" class="w-full text-xs rounded-lg border-slate-200 shadow-xs focus:border-blue-500 focus:ring-2 focus:ring-blue-400/20 transition">
                    </div>

                    <div class="flex items-end gap-1.5">
                        <button type="submit" class="flex-1 py-2 bg-blue-600 text-white rounded-lg text-xs font-semibold hover:bg-blue-500 shadow-sm shadow-blue-500/20 transition-all active:scale-95 h-[35px]">
                            Terapkan Filter
                        </button>
                        @if($status || $startDate || $endDate)
                            <a href="{{ route('reports.index', ['type' => 'loans']) }}" class="px-2.5 py-2 bg-slate-100 hover:bg-blue-50 text-slate-600 hover:text-blue-600 rounded-lg text-xs font-bold transition-all active:scale-95 h-[35px] flex items-center">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-xl border border-slate-200/90 shadow-[0_2px_12px_rgba(37,99,235,0.03)] overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-slate-600">
                        <thead class="bg-slate-50/70 text-[11px] uppercase tracking-wider text-slate-500 border-b border-slate-200">
                            <tr>
                                <th class="py-3 px-3.5 w-12 text-center">No</th>
                                <th class="py-3 px-3.5">ID Pinjam</th>
                                <th class="py-3 px-3.5">Peminjam</th>
                                <th class="py-3 px-3.5">Barang Inventaris</th>
                                <th class="py-3 px-3.5 text-center">Jumlah</th>
                                <th class="py-3 px-3.5">Tgl Pinjam</th>
                                <th class="py-3 px-3.5">Batas Kembali</th>
                                <th class="py-3 px-3.5 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($loans as $index => $loan)
                                <tr class="row-hover">
                                    <td class="py-3 px-3.5 text-center text-slate-400 font-mono">{{ $index + 1 }}</td>
                                    <td class="py-3 px-3.5 font-mono text-blue-700">#TRX-{{ $loan->id }}</td>
                                    <td class="py-3 px-3.5 font-semibold text-slate-900">
                                        {{ $loan->user->name ?? '-' }}
                                        <div class="text-[11px] text-slate-400 font-normal">{{ $loan->user->email ?? '' }}</div>
                                    </td>
                                    <td class="py-3 px-3.5">
                                        <div class="font-medium text-slate-900">{{ $loan->item->name ?? '-' }}</div>
                                        <div class="text-[11px] text-slate-400 font-mono">{{ $loan->item->code ?? '-' }}</div>
                                    </td>
                                    <td class="py-3 px-3.5 text-center font-bold text-slate-900 font-mono">{{ $loan->quantity }} Unit</td>
                                    <td class="py-3 px-3.5 text-slate-700">@indodate($loan->loan_date)</td>
                                    <td class="py-3 px-3.5 text-slate-700">@indodate($loan->due_date)</td>
                                    <td class="py-3 px-3.5 text-center">
                                        @if($loan->status === 'dipinjam')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                                Dipinjam
                                            </span>
                                        @elseif($loan->status === 'dikembalikan')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                Dikembalikan
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                                Terlambat
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="py-8 text-center text-slate-400">
                                        Tidak ada riwayat sirkulasi peminjaman yang sesuai dengan filter.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot class="bg-blue-50/40 border-t border-blue-100 text-xs font-semibold text-slate-800">
                            <tr>
                                <td colspan="4" class="py-3 px-3.5 text-right uppercase tracking-wider text-slate-500">Total Transaksi Diproses:</td>
                                <td class="py-3 px-3.5 text-center font-bold text-blue-700 font-mono">{{ $loans->sum('quantity') }} Unit</td>
                                <td colspan="3" class="py-3 px-3.5 text-slate-500 font-normal">({{ $loans->count() }} transaksi)</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
