<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <nav class="text-xs text-blue-600/70 mb-1 flex items-center gap-1.5 font-medium">
                    <a href="{{ route('dashboard') }}" class="hover:text-blue-700 transition">Dashboard</a>
                    <span class="text-slate-300">&rsaquo;</span>
                    <a href="{{ route('items.index') }}" class="hover:text-blue-700 transition">Data Sarpras</a>
                    <span class="text-slate-300">&rsaquo;</span>
                    <span class="text-slate-700 font-semibold">{{ $item->name }}</span>
                </nav>
                <div class="flex items-center gap-3">
                    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Detail Sarana & Prasarana</h1>
                    <span class="font-mono text-xs font-semibold px-2.5 py-0.5 bg-blue-50 text-blue-700 border border-blue-200 rounded-full">
                        {{ $item->code }}
                    </span>
                </div>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('items.edit', $item) }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-blue-600 hover:bg-blue-500 text-white rounded-xl text-xs font-semibold shadow-sm shadow-blue-500/25 active:scale-95 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Data
                    </a>
                @elseif($item->stock > 0 && $item->condition !== 'rusak berat')
                    <a href="{{ route('loans.create', ['item_id' => $item->id]) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white rounded-xl text-xs font-semibold shadow-sm shadow-blue-500/25 active:scale-95 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Ajukan Peminjaman
                    </a>
                @endif
                <a href="{{ route('items.index') }}" class="px-3.5 py-2 bg-slate-100 text-slate-700 hover:text-slate-900 rounded-xl text-xs font-semibold hover:bg-slate-200 active:scale-95 transition-all">
                    &larr; Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        <!-- Item Info Card (1 Col) -->
        <div class="bg-white rounded-2xl border border-blue-100/80 shadow-[0_4px_20px_rgba(37,99,235,0.04)] overflow-hidden lg:col-span-1">
            <!-- Header Banner -->
            <div class="p-6 bg-gradient-to-br from-slate-900 via-slate-800 to-blue-950 text-white relative">
                <div class="flex items-center justify-between mb-3">
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-white/15 backdrop-blur-xs text-white border border-white/20">
                        {{ $item->category->name }}
                    </span>
                    <span class="font-mono text-xs text-blue-200">#ASET-{{ $item->id }}</span>
                </div>

                <h2 class="text-xl font-bold text-white tracking-tight leading-snug mb-1">{{ $item->name }}</h2>
                <p class="font-mono text-xs font-bold text-blue-300 tracking-wider">{{ $item->code }}</p>
            </div>

            <!-- Content -->
            <div class="p-6 space-y-5">
                <!-- QR Box -->
                <div class="bg-gradient-to-br from-blue-50/60 to-indigo-50/40 border border-blue-100 rounded-2xl p-4 flex items-center gap-4">
                    <div class="p-2 bg-white rounded-xl shadow-xs border border-blue-100 shrink-0">
                        <canvas id="qr-preview" class="w-20 h-20"></canvas>
                    </div>
                    <div class="space-y-1">
                        <span class="font-bold text-xs text-slate-800 block">QR Barcode Verifikasi</span>
                        <p class="text-[11px] text-slate-500 leading-tight">Pindai kode QR fisik untuk memverifikasi keaslian dan status inventaris.</p>
                    </div>
                </div>

                <!-- Stock & Condition Highlights -->
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-100">
                        <span class="text-[10px] text-slate-400 block font-medium uppercase tracking-wider">Unit Tersedia</span>
                        <div class="flex items-baseline gap-1 mt-0.5">
                            <span class="text-xl font-black font-mono {{ $item->stock > 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                                @indoint($item->stock)
                            </span>
                            <span class="text-xs text-slate-500 font-medium">unit</span>
                        </div>
                    </div>

                    <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-100">
                        <span class="text-[10px] text-slate-400 block font-medium uppercase tracking-wider">Kondisi Fisik</span>
                        <div class="mt-1">
                            @if($item->condition === 'baik')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Baik (Layak)
                                </span>
                            @elseif($item->condition === 'rusak ringan')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    Rusak Ringan
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                    Rusak Berat
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Specifications List -->
                <div class="space-y-3 border-t border-slate-100 pt-4 text-xs">
                    <div class="flex justify-between items-center py-1.5 border-b border-slate-50">
                        <span class="text-slate-500 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Ruangan / Penempatan:
                        </span>
                        <span class="font-semibold text-slate-800 bg-slate-100 px-2.5 py-1 rounded-lg">{{ $item->location ?? 'Gudang Sarpras' }}</span>
                    </div>

                    <div class="flex justify-between items-center py-1.5 border-b border-slate-50">
                        <span class="text-slate-500 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Sumber Pendanaan:
                        </span>
                        <span class="font-semibold text-slate-800">{{ $item->source_fund ?? '-' }}</span>
                    </div>

                    <div class="flex justify-between items-center py-1.5 border-b border-slate-50">
                        <span class="text-slate-500 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Tahun Perolehan:
                        </span>
                        <span class="font-mono font-semibold text-slate-800">{{ $item->procurement_year ?? '-' }}</span>
                    </div>

                    <div class="flex justify-between items-center py-1.5">
                        <span class="text-slate-500 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Tanggal Registrasi:
                        </span>
                        <span class="text-slate-700 font-medium">@indodate($item->created_at)</span>
                    </div>

                    @if($item->description)
                        <div class="pt-3 border-t border-slate-100">
                            <span class="text-slate-500 block mb-1.5 font-semibold">Spesifikasi / Catatan:</span>
                            <div class="text-slate-700 bg-slate-50/80 p-3 rounded-xl border border-slate-200 text-xs leading-relaxed">
                                {{ $item->description }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Loan History Table (2 Cols) -->
        <div class="bg-white rounded-2xl border border-blue-100/80 shadow-[0_4px_20px_rgba(37,99,235,0.04)] overflow-hidden lg:col-span-2">
            <div class="p-5 border-b border-slate-100 flex items-center justify-between bg-gradient-to-r from-slate-50/60 to-transparent">
                <div>
                    <h3 class="text-sm font-bold text-slate-900">Riwayat Sirkulasi Peminjaman</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Catatan penggunaan dan sirkulasi aset barang ini oleh guru/siswa.</p>
                </div>
                <span class="text-xs font-mono font-bold text-blue-700 bg-blue-50 px-3 py-1 rounded-full border border-blue-200">
                    Total {{ $item->loans->count() }} Transaksi
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-slate-50/80 text-[11px] uppercase tracking-wider text-slate-500 border-b border-slate-100 font-bold">
                        <tr>
                            <th class="py-3.5 px-5">Peminjam</th>
                            <th class="py-3.5 px-4 text-center">Jumlah</th>
                            <th class="py-3.5 px-4">Tgl Pinjam</th>
                            <th class="py-3.5 px-4">Batas Tempo</th>
                            <th class="py-3.5 px-5 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($item->loans as $loan)
                            <tr class="hover:bg-blue-50/30 transition-colors">
                                <td class="py-4 px-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 font-bold text-xs flex items-center justify-center shrink-0">
                                            {{ strtoupper(substr($loan->user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <a href="{{ route('loans.show', $loan) }}" class="font-bold text-slate-900 hover:text-blue-600 transition block">
                                                {{ $loan->user->name }}
                                            </a>
                                            <div class="text-[10px] text-slate-400 font-mono">#TRX-{{ $loan->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-center font-bold font-mono text-slate-800">
                                    @indoint($loan->quantity) unit
                                </td>
                                <td class="py-4 px-4 text-slate-700 font-medium">@indodate($loan->loan_date)</td>
                                <td class="py-4 px-4 font-medium {{ $loan->status === 'terlambat' ? 'text-rose-600 font-bold' : 'text-slate-700' }}">
                                    @indodate($loan->due_date)
                                </td>
                                <td class="py-4 px-5 text-center">
                                    @if($loan->status === 'dipinjam')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            Dipinjam
                                        </span>
                                    @elseif($loan->status === 'dikembalikan')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <svg class="w-3 h-3 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                            Dikembalikan
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                            Terlambat
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center text-slate-400">
                                    <svg class="w-10 h-10 mx-auto text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Belum ada transaksi peminjaman untuk barang ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.QRCode) {
                const canvas = document.getElementById('qr-preview');
                if (canvas) {
                    window.QRCode.toCanvas(canvas, "{{ $item->code }}", {
                        width: 80,
                        margin: 1,
                        color: {
                            dark: '#0f172a',
                            light: '#ffffff'
                        }
                    });
                }
            }
        });
    </script>
</x-app-layout>
