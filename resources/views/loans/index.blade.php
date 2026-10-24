<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <nav class="text-xs text-slate-400 mb-1 flex items-center gap-1.5">
                    <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition">Dashboard</a>
                    <span>&rsaquo;</span>
                    <span class="text-slate-700 font-medium">Sirkulasi Peminjaman</span>
                </nav>
                <div class="flex items-center gap-3">
                    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">
                        {{ Auth::user()->isAdmin() ? 'Daftar Peminjaman Sarpras' : 'Riwayat Peminjaman Saya' }}
                    </h1>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200/80">
                        {{ $loans->total() }} Transaksi
                    </span>
                </div>
            </div>
            <div class="flex items-center gap-2">
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('reports.index', ['type' => 'loans']) }}" class="inline-flex items-center gap-1.5 px-3 py-2 bg-white border border-slate-200 hover:border-blue-300 rounded-lg text-xs font-semibold text-slate-700 hover:bg-blue-50/60 transition-all duration-200 active:scale-95 shadow-xs">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Laporan Sirkulasi
                    </a>
                @endif
                <a href="{{ route('loans.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-600 text-white rounded-lg text-xs font-semibold hover:bg-blue-500 shadow-sm shadow-blue-500/20 transition-all duration-200 active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Ajukan Peminjaman
                </a>
            </div>
        </div>
    </x-slot>

    <div class="space-y-4">
        <!-- Filter Bar -->
        <div class="bg-white p-4 rounded-xl border border-blue-100/80 shadow-[0_2px_10px_rgba(37,99,235,0.03)]">
            <form method="GET" action="{{ route('loans.index') }}" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3">
                <!-- Search -->
                <div class="{{ Auth::user()->isAdmin() ? '' : 'sm:col-span-2' }}">
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Cari Transaksi</label>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ $search }}" 
                        placeholder="Nama barang atau peminjam..." 
                        class="w-full text-xs rounded-lg border-slate-200 shadow-xs focus:border-blue-500 focus:ring-2 focus:ring-blue-400/20 transition"
                    >
                </div>

                @if(Auth::user()->isAdmin())
                    <!-- User Filter -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Peminjam</label>
                        <select name="user_id" class="w-full text-xs rounded-lg border-slate-200 shadow-xs focus:border-blue-500 focus:ring-2 focus:ring-blue-400/20 transition">
                            <option value="">Semua Peminjam</option>
                            @foreach($users as $u)
                                <option value="{{ $u->id }}" {{ $userId == $u->id ? 'selected' : '' }}>
                                    {{ $u->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <!-- Status Filter -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Status Transaksi</label>
                    <select name="status" class="w-full text-xs rounded-lg border-slate-200 shadow-xs focus:border-blue-500 focus:ring-2 focus:ring-blue-400/20 transition">
                        <option value="">Semua Status</option>
                        <option value="dipinjam" {{ $status === 'dipinjam' ? 'selected' : '' }}>Sedang Dipinjam</option>
                        <option value="dikembalikan" {{ $status === 'dikembalikan' ? 'selected' : '' }}>Sudah Dikembalikan</option>
                        <option value="terlambat" {{ $status === 'terlambat' ? 'selected' : '' }}>Terlambat</option>
                    </select>
                </div>

                <!-- Submit / Reset -->
                <div class="flex items-end gap-1.5">
                    <button type="submit" class="flex-1 py-2 bg-blue-600 text-white rounded-lg text-xs font-semibold hover:bg-blue-500 shadow-sm shadow-blue-500/20 transition-all active:scale-95 h-[35px]">
                        Terapkan Filter
                    </button>
                    @if($search || $status || $userId)
                        <a href="{{ route('loans.index') }}" title="Reset Filter" class="px-2.5 py-2 bg-slate-100 hover:bg-blue-50 text-slate-600 hover:text-blue-600 rounded-lg text-xs font-bold transition-all active:scale-95 h-[35px] flex items-center">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Loans Table -->
        <div class="bg-white rounded-xl border border-slate-200/90 shadow-[0_2px_12px_rgba(37,99,235,0.03)] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-slate-50/70 text-[11px] uppercase tracking-wider text-slate-500 border-b border-slate-200">
                        <tr>
                            <th class="py-3 px-3.5 w-12 text-center">No</th>
                            <th class="py-3 px-3.5 w-20">ID</th>
                            @if(Auth::user()->isAdmin())
                                <th class="py-3 px-3.5">Peminjam</th>
                            @endif
                            <th class="py-3 px-3.5">Barang Inventaris</th>
                            <th class="py-3 px-3.5 text-center">Jumlah</th>
                            <th class="py-3 px-3.5">Tgl Pinjam</th>
                            <th class="py-3 px-3.5">Batas Pengembalian</th>
                            <th class="py-3 px-3.5 text-center">Status</th>
                            <th class="py-3 px-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($loans as $index => $loan)
                            <tr class="row-hover">
                                <td class="py-3 px-3.5 text-center text-slate-400 font-mono">
                                    {{ $loans->firstItem() + $index }}
                                </td>
                                <td class="py-3 px-3.5 font-mono text-[11px] text-blue-700">
                                    #TRX-{{ $loan->id }}
                                </td>
                                @if(Auth::user()->isAdmin())
                                    <td class="py-3 px-3.5 font-semibold text-slate-900">
                                        {{ $loan->user->name }}
                                        <div class="text-[10px] text-slate-400 font-normal">{{ $loan->user->email }}</div>
                                    </td>
                                @endif
                                <td class="py-3 px-3.5">
                                    <div class="font-semibold text-slate-900">{{ $loan->item->name }}</div>
                                    <div class="text-[10px] text-slate-400 font-mono">{{ $loan->item->code }} &bull; {{ $loan->item->location ?? 'Gudang' }}</div>
                                </td>
                                <td class="py-3 px-3.5 text-center font-bold font-mono text-slate-800">
                                    @indoint($loan->quantity) Unit
                                </td>
                                <td class="py-3 px-3.5 text-slate-700">
                                    @indodate($loan->loan_date)
                                </td>
                                <td class="py-3 px-3.5 font-medium {{ $loan->status === 'terlambat' ? 'text-rose-600 font-bold' : 'text-slate-700' }}">
                                    @indodate($loan->due_date)
                                </td>
                                <td class="py-3 px-3.5 text-center">
                                    @if($loan->status === 'dipinjam')
                                        <span class="inline-flex items-center px-2.5 py-0.5 text-[11px] font-semibold rounded-full bg-amber-50 text-amber-700 border border-amber-200">
                                            Dipinjam
                                        </span>
                                    @elseif($loan->status === 'dikembalikan')
                                        <span class="inline-flex items-center px-2.5 py-0.5 text-[11px] font-semibold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            Dikembalikan
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 text-[11px] font-semibold rounded-full bg-rose-50 text-rose-700 border border-rose-200">
                                            Terlambat
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-3.5 text-right space-x-1.5 whitespace-nowrap">
                                    <a href="{{ route('loans.show', $loan) }}" class="inline-flex items-center px-2 py-1 bg-white border border-slate-200 text-slate-700 hover:bg-blue-50 hover:text-blue-700 rounded-md text-[11px] font-medium transition active:scale-95">
                                        Detail
                                    </a>

                                    @if(Auth::user()->isAdmin())
                                        @if(in_array($loan->status, ['dipinjam', 'terlambat']))
                                            <a href="{{ route('return_logs.create', ['loan_id' => $loan->id]) }}" class="inline-flex items-center px-2 py-1 bg-emerald-50 border border-emerald-300 text-emerald-800 hover:bg-emerald-100 rounded-md text-[11px] font-semibold transition active:scale-95">
                                                Kembalikan
                                            </a>
                                        @endif

                                        <form action="{{ route('loans.destroy', $loan) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data transaksi peminjaman ini?')">
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
                                <td colspan="{{ Auth::user()->isAdmin() ? '9' : '8' }}" class="py-10 text-center text-slate-400">
                                    Tidak ada data transaksi peminjaman yang sesuai dengan filter.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($loans->hasPages())
                <div class="p-3.5 border-t border-slate-100 bg-slate-50/50">
                    {{ $loans->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
