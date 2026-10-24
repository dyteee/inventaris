<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <nav class="text-xs text-blue-600/70 mb-1 flex items-center gap-1.5 font-medium">
                    <a href="{{ route('dashboard') }}" class="hover:text-blue-700 transition">Dashboard</a>
                    <span class="text-slate-300">&rsaquo;</span>
                    <a href="{{ route('return_logs.index') }}" class="hover:text-blue-700 transition">Pengembalian</a>
                    <span class="text-slate-300">&rsaquo;</span>
                    <span class="text-slate-700 font-semibold">Log #{{ $returnLog->id }}</span>
                </nav>
                <div class="flex items-center gap-3">
                    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Detail Verifikasi Pengembalian</h1>
                    <span class="font-mono text-xs font-semibold px-2.5 py-0.5 bg-blue-50 text-blue-700 border border-blue-200 rounded-full">
                        #LOG-{{ $returnLog->id }}
                    </span>
                </div>
            </div>
            <a href="{{ route('return_logs.index') }}" class="inline-flex items-center gap-1 px-3.5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-semibold transition active:scale-95">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto bg-white rounded-2xl border border-blue-100/80 shadow-[0_8px_30px_rgba(37,99,235,0.06)] overflow-hidden">
        <!-- Verification Banner -->
        <div class="p-6 bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-700 text-white flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center border border-white/20 shadow-xs">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-bold text-white tracking-tight">Aset Resmi Telah Dikembalikan</h2>
                    <p class="text-xs text-blue-100/90">Fisik sarpras telah diperiksa dan kuantitas unit dikembalikan ke gudang.</p>
                </div>
            </div>
            <span class="hidden sm:inline-block px-3 py-1 bg-white/20 backdrop-blur-md rounded-full text-xs font-bold border border-white/20 font-mono">
                TERVERIFIKASI
            </span>
        </div>

        <div class="p-6 sm:p-8 space-y-6">
            <!-- Grid Info -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                <!-- Borrower -->
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-[10px] text-slate-400 block font-bold uppercase tracking-wider mb-1">Peminjam</span>
                    <h4 class="font-bold text-slate-900 text-sm">{{ $returnLog->loan->user->name }}</h4>
                    <p class="text-slate-500 mt-0.5">{{ $returnLog->loan->user->email }}</p>
                </div>

                <!-- Item -->
                <div class="p-4 rounded-xl bg-blue-50/40 border border-blue-100">
                    <span class="text-[10px] text-blue-600 block font-bold uppercase tracking-wider mb-1">Barang Dikembalikan</span>
                    <h4 class="font-bold text-slate-900 text-sm">{{ $returnLog->loan->item->name }}</h4>
                    <div class="flex items-center gap-2 mt-0.5">
                        <span class="font-mono text-[11px] font-bold text-blue-700 bg-white px-2 py-0.5 rounded border border-blue-200">
                            {{ $returnLog->loan->item->code }}
                        </span>
                        <span class="font-mono font-bold text-slate-800">@indoint($returnLog->loan->quantity) unit</span>
                    </div>
                </div>

                <!-- Initial Loan Date -->
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-[10px] text-slate-400 block font-bold uppercase tracking-wider mb-1">Tanggal Mulai Pinjam</span>
                    <span class="font-semibold text-slate-800 text-xs">@indodate($returnLog->loan->loan_date)</span>
                </div>

                <!-- Returned Date -->
                <div class="p-4 rounded-xl bg-emerald-50/50 border border-emerald-100">
                    <span class="text-[10px] text-emerald-700 block font-bold uppercase tracking-wider mb-1">Tanggal Resmi Diterima</span>
                    <span class="font-bold text-emerald-800 text-xs">@indodate($returnLog->returned_at)</span>
                </div>

                <!-- Due Date -->
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-[10px] text-slate-400 block font-bold uppercase tracking-wider mb-1">Batas Waktu Tempo</span>
                    <span class="font-semibold text-slate-800 text-xs">@indodate($returnLog->loan->due_date)</span>
                </div>

                <!-- Condition on Return -->
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-[10px] text-slate-400 block font-bold uppercase tracking-wider mb-1">Kondisi Fisik Saat Kembali</span>
                    @if($returnLog->condition_on_return === 'baik')
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 mt-0.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            Baik (Lengkap & Normal)
                        </span>
                    @elseif($returnLog->condition_on_return === 'rusak ringan')
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200 mt-0.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                            Rusak Ringan
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200 mt-0.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                            Rusak Berat
                        </span>
                    @endif
                </div>
            </div>

            <!-- Notes -->
            <div class="border-t border-slate-100 pt-5">
                <span class="text-xs font-bold text-slate-700 block mb-2">Catatan Pemeriksaan Admin:</span>
                <div class="bg-slate-50 p-4 rounded-xl text-slate-700 text-xs leading-relaxed border border-slate-100">
                    {{ $returnLog->notes ?: 'Pemeriksaan fisik selesai. Barang dikembalikan dalam kondisi sesuai standar tanpa catatan kerusakan.' }}
                </div>
            </div>

            <!-- Meta Footer -->
            <div class="text-[11px] text-slate-400 pt-4 border-t border-slate-100 flex flex-wrap justify-between gap-2">
                <span>Diverifikasi pada: @indodatetime($returnLog->created_at)</span>
                <span class="font-mono">ID Referensi Peminjaman: #TRX-{{ $returnLog->loan_id }}</span>
            </div>
        </div>
    </div>
</x-app-layout>
