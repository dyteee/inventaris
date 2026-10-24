<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <nav class="text-xs text-blue-600/70 mb-1 flex items-center gap-1.5 font-medium">
                    <a href="{{ route('dashboard') }}" class="hover:text-blue-700 transition">Dashboard</a>
                    <span class="text-slate-300">&rsaquo;</span>
                    <a href="{{ route('loans.index') }}" class="hover:text-blue-700 transition">Peminjaman</a>
                    <span class="text-slate-300">&rsaquo;</span>
                    <span class="text-slate-700 font-semibold">Transaksi #{{ $loan->id }}</span>
                </nav>
                <div class="flex items-center gap-3">
                    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Detail Transaksi Peminjaman</h1>
                    <span class="font-mono text-xs font-semibold px-2.5 py-0.5 bg-blue-50 text-blue-700 border border-blue-200 rounded-full">
                        #TRX-{{ $loan->id }}
                    </span>
                </div>
            </div>
            <div class="flex items-center gap-2">
                @if(Auth::user()->isAdmin() && in_array($loan->status, ['dipinjam', 'terlambat']))
                    <a href="{{ route('return_logs.create', ['loan_id' => $loan->id]) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white rounded-xl text-xs font-semibold shadow-sm shadow-emerald-500/25 active:scale-95 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Catat Pengembalian
                    </a>
                @endif
                <a href="{{ route('loans.index') }}" class="px-3.5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-semibold active:scale-95 transition">
                    &larr; Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
        <!-- Card 1: Peminjam & Barang -->
        <div class="bg-white rounded-2xl border border-blue-100/80 shadow-[0_4px_20px_rgba(37,99,235,0.04)] overflow-hidden">
            <div class="p-5 border-b border-slate-100 bg-gradient-to-r from-slate-50/60 to-transparent flex items-center justify-between">
                <h2 class="text-sm font-bold text-slate-900">Informasi Peminjam & Barang</h2>
                @if($loan->status === 'dipinjam')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                        <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                        Sedang Dipinjam
                    </span>
                @elseif($loan->status === 'dikembalikan')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                        <svg class="w-3.5 h-3.5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        Telah Dikembalikan
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200">
                        <span class="w-2 h-2 rounded-full bg-rose-500 animate-ping"></span>
                        Terlambat
                    </span>
                @endif
            </div>

            <div class="p-6 space-y-6">
                <!-- Borrower Tile -->
                <div class="flex items-center gap-4 p-4 rounded-xl bg-slate-50 border border-slate-100">
                    <div class="w-12 h-12 rounded-xl bg-blue-600 text-white font-bold text-base flex items-center justify-center shrink-0 shadow-sm shadow-blue-500/20">
                        {{ strtoupper(substr($loan->user->name, 0, 2)) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider block">Peminjam</span>
                        <h3 class="text-sm font-bold text-slate-900 truncate">{{ $loan->user->name }}</h3>
                        <p class="text-xs text-slate-500 truncate">{{ $loan->user->email }}</p>
                    </div>
                </div>

                <!-- Item Tile -->
                <div class="p-4 rounded-xl bg-blue-50/40 border border-blue-100 space-y-3">
                    <span class="text-[10px] uppercase font-bold text-blue-600 tracking-wider block">Barang Inventaris Dipinjam</span>
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <a href="{{ route('items.show', $loan->item) }}" class="text-sm font-bold text-slate-900 hover:text-blue-600 transition block">
                                {{ $loan->item->name }}
                            </a>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="font-mono text-xs font-bold text-blue-700 bg-white px-2 py-0.5 rounded border border-blue-200">
                                    {{ $loan->item->code }}
                                </span>
                                <span class="text-xs text-slate-500">&bull; {{ $loan->item->category->name }}</span>
                            </div>
                        </div>
                        <div class="text-right shrink-0">
                            <span class="text-[10px] text-slate-400 block font-medium uppercase">Kuantitas</span>
                            <span class="text-base font-black font-mono text-slate-800">@indoint($loan->quantity) unit</span>
                        </div>
                    </div>
                </div>

                <!-- Dates Grid -->
                <div class="grid grid-cols-2 gap-3 text-xs">
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <span class="text-[10px] text-slate-400 block font-medium uppercase tracking-wider">Tanggal Pinjam</span>
                        <span class="text-xs font-bold text-slate-800 mt-1 block">@indodate($loan->loan_date)</span>
                    </div>

                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <span class="text-[10px] text-slate-400 block font-medium uppercase tracking-wider">Batas Tempo</span>
                        <span class="text-xs font-bold {{ $loan->status === 'terlambat' ? 'text-rose-600' : 'text-slate-800' }} mt-1 block">
                            @indodate($loan->due_date)
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Status Pengembalian & Log -->
        <div class="bg-white rounded-2xl border border-blue-100/80 shadow-[0_4px_20px_rgba(37,99,235,0.04)] overflow-hidden">
            <div class="p-5 border-b border-slate-100 bg-gradient-to-r from-slate-50/60 to-transparent">
                <h2 class="text-sm font-bold text-slate-900">Verifikasi Pengembalian Fisik</h2>
            </div>

            <div class="p-6">
                @if($loan->returnLog)
                    <div class="space-y-4 text-xs">
                        <!-- Success Banner -->
                        <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-emerald-600 text-white flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-emerald-900 text-sm">Barang Berhasil Dikembalikan</h4>
                                <p class="text-emerald-700 text-[11px]">Telah diverifikasi dan stok fisik telah dikembalikan ke inventaris.</p>
                            </div>
                        </div>

                        <div class="flex justify-between items-center py-2 border-b border-slate-100">
                            <span class="text-slate-500">Tanggal Pengembalian:</span>
                            <span class="font-bold text-emerald-700">@indodate($loan->returnLog->returned_at)</span>
                        </div>

                        <div class="flex justify-between items-center py-2 border-b border-slate-100">
                            <span class="text-slate-500">Kondisi Saat Kembali:</span>
                            @if($loan->returnLog->condition_on_return === 'baik')
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">Baik (Layak)</span>
                            @elseif($loan->returnLog->condition_on_return === 'rusak ringan')
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">Rusak Ringan</span>
                            @else
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200">Rusak Berat</span>
                            @endif
                        </div>

                        <div>
                            <span class="text-slate-500 block mb-1 font-semibold">Catatan Pemeriksaan Admin:</span>
                            <div class="bg-slate-50 p-3.5 rounded-xl text-slate-700 text-xs leading-relaxed border border-slate-100">
                                {{ $loan->returnLog->notes ?: 'Tidak ada catatan kerusakan atau keluhan.' }}
                            </div>
                        </div>

                        <div class="text-[11px] text-slate-400 pt-3 border-t border-slate-100">
                            Diverifikasi pada: @indodatetime($loan->returnLog->created_at)
                        </div>
                    </div>
                @else
                    <div class="py-12 text-center space-y-4">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center border border-amber-200/80">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-900">Barang Belum Dikembalikan</h3>
                            <p class="text-xs text-slate-500 max-w-xs mx-auto mt-1">Barang masih berada di tangan peminjam. Pengelola dapat memproses verifikasi fisik saat barang diserahkan kembali.</p>
                        </div>
                        @if(Auth::user()->isAdmin())
                            <div class="pt-2">
                                <a href="{{ route('return_logs.create', ['loan_id' => $loan->id]) }}" class="inline-flex items-center gap-1.5 px-5 py-2.5 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white rounded-xl text-xs font-semibold shadow-md shadow-emerald-500/25 active:scale-95 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Verifikasi Pengembalian Sekarang
                                </a>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
