<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <nav class="text-xs text-slate-400 mb-1 flex items-center gap-1.5">
                    <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition">Dashboard</a>
                    <span>&rsaquo;</span>
                    <span class="text-slate-700 font-medium">Klasifikasi Kategori</span>
                </nav>
                <div class="flex items-center gap-3">
                    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Kategori Sarana & Prasarana</h1>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200/80">
                        {{ $categories->total() }} Kategori
                    </span>
                </div>
            </div>
            <a href="{{ route('categories.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-600 text-white rounded-lg text-xs font-semibold hover:bg-blue-500 shadow-sm shadow-blue-500/20 transition-all duration-200 active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Kategori
            </a>
        </div>
    </x-slot>

    <div class="bg-white rounded-xl border border-slate-200/90 shadow-[0_2px_12px_rgba(37,99,235,0.03)] overflow-hidden">
        <!-- Search & Filter Bar -->
        <div class="p-4 border-b border-slate-100 bg-slate-50/40">
            <form method="GET" action="{{ route('categories.index') }}" class="flex flex-col sm:flex-row gap-2.5 items-center justify-between">
                <div class="relative w-full sm:w-80">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ $search }}" 
                        placeholder="Cari nama klasifikasi kategori..." 
                        class="w-full text-xs rounded-lg border-slate-200 shadow-xs focus:border-blue-500 focus:ring-2 focus:ring-blue-400/20 pl-8 transition"
                    >
                    <svg class="w-4 h-4 text-slate-400 absolute left-2.5 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <div class="flex gap-2 w-full sm:w-auto">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-xs font-semibold hover:bg-blue-500 shadow-sm shadow-blue-500/20 transition-all active:scale-95 h-[35px]">
                        Cari
                    </button>
                    @if($search)
                        <a href="{{ route('categories.index') }}" class="px-3 py-2 bg-slate-100 hover:bg-blue-50 text-slate-700 hover:text-blue-700 rounded-lg text-xs font-medium transition-all active:scale-95 h-[35px] flex items-center">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50/70 text-[11px] uppercase tracking-wider text-slate-500 border-b border-slate-200">
                    <tr>
                        <th class="py-3 px-3.5 w-14 text-center">No</th>
                        <th class="py-3 px-3.5">Nama Kategori</th>
                        <th class="py-3 px-3.5 text-center">Jumlah Barang Terdaftar</th>
                        <th class="py-3 px-3.5">Waktu Registrasi</th>
                        <th class="py-3 px-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($categories as $index => $category)
                        <tr class="row-hover">
                            <td class="py-3 px-3.5 text-center text-slate-400 font-mono">
                                {{ $categories->firstItem() + $index }}
                            </td>
                            <td class="py-3 px-3.5 font-bold text-slate-900">
                                {{ $category->name }}
                            </td>
                            <td class="py-3 px-3.5 text-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-blue-50 text-blue-700 border border-blue-200/80 font-mono">
                                    {{ $category->items_count }} Sarpras
                                </span>
                            </td>
                            <td class="py-3 px-3.5 text-slate-600">
                                @indodate($category->created_at)
                            </td>
                            <td class="py-3 px-3.5 text-right space-x-1.5 whitespace-nowrap">
                                <a href="{{ route('categories.edit', $category) }}" class="inline-flex items-center px-2 py-1 bg-white border border-slate-200 text-slate-700 hover:bg-blue-50 hover:text-blue-700 rounded-md text-[11px] font-medium transition active:scale-95">
                                    Edit
                                </a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori {{ $category->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-2 py-1 bg-white border border-rose-200 text-rose-600 hover:bg-rose-50 rounded-md text-[11px] font-medium transition active:scale-95">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-10 text-center text-slate-400">
                                Tidak ada kategori yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($categories->hasPages())
            <div class="p-3.5 border-t border-slate-100 bg-slate-50/50">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
