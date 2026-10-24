<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <nav class="text-xs text-slate-400 mb-1 flex items-center gap-1.5">
                    <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition">Dashboard</a>
                    <span>&rsaquo;</span>
                    <span class="text-slate-700 font-medium">Log Pengembalian</span>
                </nav>
                <div class="flex items-center gap-3">
                    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">
                        {{ Auth::user()->isAdmin() ? 'Buku Ekspedisi Pengembalian Sarpras' : 'Riwayat Pengembalian Saya' }}
                    </h1>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200/80">
                        {{ $returnLogs->total() }} Log Dicatat
                    </span>
                </div>
            </div>
            @if(Auth::user()->isAdmin())
                <a href="{{ route('return_logs.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-600 text-white rounded-lg text-xs font-semibold hover:bg-blue-500 shadow-sm shadow-blue-500/20 transition-all duration-200 active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Catat Pengembalian Baru
                </a>
            @endif
        </div>
    </x-slot>

    <div class="space-y-4">
        <!-- Filter Bar -->
        <div class="bg-white p-4 rounded-xl border border-blue-100/80 shadow-[0_2px_10px_rgba(37,99,235,0.03)]">
            <form method="GET" action="{{ route('return_logs.index') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <!-- Search -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Cari Data</label>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ $search }}" 
                        placeholder="Cari barang, peminjam, atau catatan..." 
                        class="w-full text-xs rounded-lg border-slate-200 shadow-xs focus:border-blue-500 focus:ring-2 focus:ring-blue-400/20 transition"
                    >
                </div>

                <!-- Condition Filter -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Kondisi Saat Kembali</label>
                    <select name="condition_on_return" class="w-full text-xs rounded-lg border-slate-200 shadow-xs focus:border-blue-500 focus:ring-2 focus:ring-blue-400/20 transition">
                        <option value="">Semua Kondisi</option>
                        <option value="baik" {{ $condition === 'baik' ? 'selected' : '' }}>Baik</option>
                        <option value="rusak ringan" {{ $condition === 'rusak ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                        <option value="rusak berat" {{ $condition === 'rusak berat' ? 'selected' : '' }}>Rusak Berat</option>
                    </select>
                </div>

                <!-- Submit / Reset -->
                <div class="flex items-end gap-1.5">
                    <button type="submit" class="flex-1 py-2 bg-blue-600 text-white rounded-lg text-xs font-semibold hover:bg-blue-500 shadow-sm shadow-blue-500/20 transition-all active:scale-95 h-[35px]">
                        Terapkan Filter
                    </button>
                    @if($search || $condition)
                        <a href="{{ route('return_logs.index') }}" title="Reset Filter" class="px-2.5 py-2 bg-slate-100 hover:bg-blue-50 text-slate-600 hover:text-blue-600 rounded-lg text-xs font-bold transition-all active:scale-95 h-[35px] flex items-center">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
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
                            @if(Auth::user()->isAdmin())
                                <th class="py-3 px-3.5">Peminjam</th>
                            @endif
                            <th class="py-3 px-3.5">Barang Inventaris</th>
                            <th class="py-3 px-3.5">Tanggal Kembali</th>
                            <th class="py-3 px-3.5 text-center">Kondisi Fisik Kembali</th>
                            <th class="py-3 px-3.5">Catatan Verifikasi</th>
                            <th class="py-3 px-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($returnLogs as $index => $log)
                            <tr class="row-hover">
                                <td class="py-3 px-3.5 text-center text-slate-400 font-mono">
                                    {{ $returnLogs->firstItem() + $index }}
                                </td>
                                @if(Auth::user()->isAdmin())
                                    <td class="py-3 px-3.5 font-semibold text-slate-900">
                                        {{ $log->loan->user->name }}
                                        <div class="text-[10px] text-slate-400 font-normal font-mono">#TRX-{{ $log->loan->id }}</div>
                                    </td>
                                @endif
                                <td class="py-3 px-3.5">
                                    <div class="font-semibold text-slate-900">{{ $log->loan->item->name }}</div>
                                    <div class="text-[10px] text-slate-400 font-mono">{{ $log->loan->item->code }} &bull; @indoint($log->loan->quantity) unit</div>
                                </td>
                                <td class="py-3 px-3.5 text-slate-700 font-medium">
                                    @indodate($log->returned_at)
                                </td>
                                <td class="py-3 px-3.5 text-center">
                                    @if($log->condition_on_return === 'baik')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            Baik
                                        </span>
                                    @elseif($log->condition_on_return === 'rusak ringan')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                            Rusak Ringan
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                            Rusak Berat
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-3.5 text-slate-600 max-w-[260px] truncate">
                                    {{ $log->notes ?: 'Tidak ada catatan tambahan.' }}
                                </td>
                                <td class="py-3 px-3.5 text-right space-x-1.5 whitespace-nowrap">
                                    <a href="{{ route('return_logs.show', $log) }}" class="inline-flex items-center px-2 py-1 bg-white border border-slate-200 text-slate-700 hover:bg-blue-50 hover:text-blue-700 rounded-md text-[11px] font-medium transition active:scale-95">
                                        Detail
                                    </a>

                                    @if(Auth::user()->isAdmin())
                                        <form action="{{ route('return_logs.destroy', $log) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan & menghapus catatan log pengembalian ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-2 py-1 bg-white border border-rose-200 text-rose-600 hover:bg-rose-50 rounded-md text-[11px] font-medium transition active:scale-95">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ Auth::user()->isAdmin() ? '7' : '6' }}" class="py-10 text-center text-slate-400">
                                    Tidak ada catatan riwayat pengembalian yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($returnLogs->hasPages())
                <div class="p-3.5 border-t border-slate-100 bg-slate-50/50">
                    {{ $returnLogs->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
