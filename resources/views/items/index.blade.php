<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <nav class="text-xs text-slate-400 mb-1 flex items-center gap-1.5">
                    <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition">Dashboard</a>
                    <span>&rsaquo;</span>
                    <span class="text-slate-700 font-medium">{{ Auth::user()->isAdmin() ? 'Manajemen Sarpras' : 'Katalog Inventaris' }}</span>
                </nav>
                <div class="flex items-center gap-3">
                    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">
                        {{ Auth::user()->isAdmin() ? 'Data Sarana & Prasarana' : 'Katalog Barang Sekolah' }}
                    </h1>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200/80">
                        {{ $items->total() }} Item Terdaftar
                    </span>
                </div>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('reports.index') }}" class="inline-flex items-center gap-1.5 px-3 py-2 bg-white border border-slate-200 hover:border-blue-300 rounded-lg text-xs font-semibold text-slate-700 hover:bg-blue-50/60 transition-all duration-200 active:scale-95 shadow-xs">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Rekap Laporan
                    </a>
                    <a href="{{ route('items.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold text-xs hover:bg-blue-500 shadow-sm shadow-blue-500/25 transition-all duration-200 active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Barang Baru
                    </a>
                @else
                    <a href="{{ route('loans.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold text-xs hover:bg-blue-500 shadow-sm shadow-blue-500/25 transition-all duration-200 active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Ajukan Peminjaman
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="space-y-4">
        <!-- Filter Bar -->
        <div class="bg-white p-4 rounded-xl border border-blue-100/80 shadow-[0_2px_10px_rgba(37,99,235,0.03)]">
            <form method="GET" action="{{ route('items.index') }}" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-6 gap-3">
                <!-- Search -->
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Cari Sarpras</label>
                    <div class="relative">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ $search }}" 
                            placeholder="Nama, kode aset, atau ruangan..." 
                            class="w-full text-xs rounded-lg border-slate-200 shadow-xs focus:border-blue-500 focus:ring-2 focus:ring-blue-400/20 pl-8 transition"
                        >
                        <svg class="w-4 h-4 text-slate-400 absolute left-2.5 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Category -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Kategori</label>
                    <select name="category_id" class="w-full text-xs rounded-lg border-slate-200 shadow-xs focus:border-blue-500 focus:ring-2 focus:ring-blue-400/20 transition">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $categoryId == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Location / Ruangan -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Ruangan / Lokasi</label>
                    <select name="location" class="w-full text-xs rounded-lg border-slate-200 shadow-xs focus:border-blue-500 focus:ring-2 focus:ring-blue-400/20 transition">
                        <option value="">Semua Ruangan</option>
                        @foreach($locations as $loc)
                            <option value="{{ $loc }}" {{ $location == $loc ? 'selected' : '' }}>
                                {{ $loc }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Condition -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Kondisi Fisik</label>
                    <select name="condition" class="w-full text-xs rounded-lg border-slate-200 shadow-xs focus:border-blue-500 focus:ring-2 focus:ring-blue-400/20 transition">
                        <option value="">Semua Kondisi</option>
                        <option value="baik" {{ $condition === 'baik' ? 'selected' : '' }}>Baik</option>
                        <option value="rusak ringan" {{ $condition === 'rusak ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                        <option value="rusak berat" {{ $condition === 'rusak berat' ? 'selected' : '' }}>Rusak Berat</option>
                    </select>
                </div>

                <!-- Stock & Submit -->
                <div class="flex items-end gap-1.5">
                    <div class="flex-1">
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Stok Unit</label>
                        <select name="stock_status" class="w-full text-xs rounded-lg border-slate-200 shadow-xs focus:border-blue-500 focus:ring-2 focus:ring-blue-400/20 transition">
                            <option value="">Semua</option>
                            <option value="available" {{ $stockStatus === 'available' ? 'selected' : '' }}>Tersedia (>0)</option>
                            <option value="empty" {{ $stockStatus === 'empty' ? 'selected' : '' }}>Habis (0)</option>
                        </select>
                    </div>
                    <button type="submit" class="px-3.5 py-2 bg-blue-600 text-white rounded-lg text-xs font-semibold hover:bg-blue-500 shadow-sm shadow-blue-500/20 transition-all active:scale-95 h-[35px] shrink-0">
                        Filter
                    </button>
                    @if($search || $categoryId || $condition || $location || $stockStatus)
                        <a href="{{ route('items.index') }}" title="Reset Filter" class="px-2.5 py-2 bg-slate-100 hover:bg-blue-50 text-slate-600 hover:text-blue-600 rounded-lg text-xs font-bold transition-all active:scale-95 h-[35px] flex items-center shrink-0">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Items Table -->
        <div class="bg-white rounded-xl border border-slate-200/90 shadow-[0_2px_12px_rgba(37,99,235,0.03)] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-slate-50/70 text-[11px] uppercase tracking-wider text-slate-500 border-b border-slate-200">
                        <tr>
                            <th class="py-3 px-3.5 w-12 text-center">No</th>
                            <th class="py-3 px-3.5 w-24">Kode</th>
                            <th class="py-3 px-3.5">Nama Sarana & Prasarana</th>
                            <th class="py-3 px-3.5">Kategori</th>
                            <th class="py-3 px-3.5">Ruang / Penempatan</th>
                            <th class="py-3 px-3.5 text-center">Stok Fisik</th>
                            <th class="py-3 px-3.5 text-center">Kondisi</th>
                            <th class="py-3 px-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($items as $index => $item)
                            <tr class="row-hover">
                                <td class="py-3 px-3.5 text-center text-slate-400 font-mono">
                                    {{ $items->firstItem() + $index }}
                                </td>
                                <td class="py-3 px-3.5 font-mono text-xs font-bold text-blue-700">
                                    {{ $item->code }}
                                </td>
                                <td class="py-3 px-3.5 font-medium text-slate-900">
                                    <a href="{{ route('items.show', $item) }}" class="hover:text-blue-600 transition block">
                                        {{ $item->name }}
                                    </a>
                                    @if($item->source_fund)
                                        <span class="text-[10px] text-slate-400 font-normal">
                                            Sumber: {{ $item->source_fund }} &bull; Th. {{ $item->procurement_year ?? '-' }}
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-3.5 text-slate-600">
                                    {{ $item->category->name }}
                                </td>
                                <td class="py-3 px-3.5">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-medium bg-blue-50/70 text-blue-700 border border-blue-200/60">
                                        {{ $item->location ?? 'Gudang Sarpras' }}
                                    </span>
                                </td>
                                <td class="py-3 px-3.5 text-center font-mono font-bold">
                                    @if($item->stock > 0)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            @indoint($item->stock) unit
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                            Kosong (0)
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-3.5 text-center">
                                    @if($item->condition === 'baik')
                                        <span class="inline-flex items-center px-2.5 py-0.5 text-[11px] font-semibold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            Baik
                                        </span>
                                    @elseif($item->condition === 'rusak ringan')
                                        <span class="inline-flex items-center px-2.5 py-0.5 text-[11px] font-semibold rounded-full bg-amber-50 text-amber-700 border border-amber-200">
                                            Rusak Ringan
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 text-[11px] font-semibold rounded-full bg-rose-50 text-rose-700 border border-rose-200">
                                            Rusak Berat
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-3.5 text-right space-x-1 whitespace-nowrap">
                                    @if(Auth::user()->isAdmin())
                                        <a href="{{ route('items.show', $item) }}" class="inline-flex items-center px-2 py-1 bg-white hover:bg-slate-50 text-slate-700 rounded-md text-[11px] font-medium border border-slate-200 transition active:scale-95">
                                            Detail
                                        </a>
                                        <a href="{{ route('items.edit', $item) }}" class="inline-flex items-center px-2 py-1 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-md text-[11px] font-medium border border-blue-200 transition active:scale-95">
                                            Edit
                                        </a>
                                        <form action="{{ route('items.destroy', $item) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus aset {{ $item->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-2 py-1 bg-white hover:bg-rose-50 text-rose-600 rounded-md text-[11px] font-medium border border-rose-200 transition active:scale-95">
                                                Hapus
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('items.show', $item) }}" class="inline-flex items-center px-2.5 py-1 bg-slate-100 hover:bg-blue-50 hover:text-blue-700 text-slate-700 rounded-md text-[11px] font-medium transition active:scale-95">
                                            Detail
                                        </a>
                                        @if($item->stock > 0 && $item->condition !== 'rusak berat')
                                            <a href="{{ route('loans.create', ['item_id' => $item->id]) }}" class="inline-flex items-center px-3 py-1 bg-blue-600 hover:bg-blue-500 text-white rounded-md text-[11px] font-semibold transition active:scale-95 shadow-xs">
                                                Pinjam
                                            </a>
                                        @else
                                            <span class="text-[11px] text-slate-400 italic">Tidak Tersedia</span>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-10 text-center text-slate-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-10 h-10 text-blue-200 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                        <p class="font-medium text-slate-600">Tidak ada barang inventaris yang ditemukan</p>
                                        <p class="text-[11px] text-slate-400 mt-0.5">Coba sesuaikan kata kunci atau filter pencarian Anda.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($items->hasPages())
                <div class="p-3.5 border-t border-slate-100 bg-slate-50/50">
                    {{ $items->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
