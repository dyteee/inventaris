<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <nav class="text-xs text-blue-600/70 mb-1 flex items-center gap-1.5 font-medium">
                    <a href="{{ route('dashboard') }}" class="hover:text-blue-700 transition">Dashboard</a>
                    <span class="text-slate-300">&rsaquo;</span>
                    <span class="text-slate-700 font-semibold">Pengguna</span>
                </nav>
                <div class="flex items-center gap-3">
                    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Akun Pengguna Sistem</h1>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                        {{ $users->total() }} Akun
                    </span>
                </div>
            </div>
            <a href="{{ route('users.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-semibold shadow-sm shadow-blue-500/20 active:scale-95 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                Tambah Pengguna Baru
            </a>
        </div>
    </x-slot>

    <div class="space-y-4">
        <!-- Filter Bar -->
        <div class="bg-white p-4 rounded-xl border border-blue-100 shadow-sm shadow-blue-500/5">
            <form method="GET" action="{{ route('users.index') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <!-- Search -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Cari Pengguna</label>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ $search }}" 
                        placeholder="Nama atau alamat email..." 
                        class="w-full text-xs rounded-lg border-slate-200 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    >
                </div>

                <!-- Role Filter -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Hak Akses (Role)</label>
                    <select name="role" class="w-full text-xs rounded-lg border-slate-200 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Semua Role</option>
                        <option value="admin" {{ $role === 'admin' ? 'selected' : '' }}>Admin (Pengelola)</option>
                        <option value="user" {{ $role === 'user' ? 'selected' : '' }}>User (Guru / Siswa)</option>
                    </select>
                </div>

                <!-- Submit / Reset -->
                <div class="flex items-end gap-1.5">
                    <button type="submit" class="flex-1 py-2 bg-blue-600 hover:bg-blue-700 active:scale-95 text-white rounded-lg text-xs font-semibold shadow-sm shadow-blue-500/15 transition-all h-[38px]">
                        Terapkan Filter
                    </button>
                    @if($search || $role)
                        <a href="{{ route('users.index') }}" title="Reset Filter" class="px-3 py-2 bg-slate-100 text-slate-600 hover:text-slate-900 rounded-lg text-xs font-bold hover:bg-slate-200 active:scale-95 transition-all h-[38px] flex items-center">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-xl border border-blue-100 shadow-sm shadow-blue-500/5 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-slate-50/80 text-[11px] uppercase tracking-wider text-slate-500 border-b border-slate-100 font-semibold">
                        <tr>
                            <th class="py-3.5 px-4 w-14 text-center">No</th>
                            <th class="py-3.5 px-4">Nama Lengkap</th>
                            <th class="py-3.5 px-4">Email</th>
                            <th class="py-3.5 px-4 text-center">Hak Akses</th>
                            <th class="py-3.5 px-4">Terdaftar Sejak</th>
                            <th class="py-3.5 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($users as $index => $u)
                            <tr class="hover:bg-blue-50/40 transition-colors">
                                <td class="py-3.5 px-4 text-center text-slate-400 font-mono">
                                    {{ $users->firstItem() + $index }}
                                </td>
                                <td class="py-3.5 px-4 font-bold text-slate-900">
                                    {{ $u->name }}
                                </td>
                                <td class="py-3.5 px-4 text-slate-600 font-mono">
                                    {{ $u->email }}
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    @if($u->role === 'admin')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                            Admin Sarpras
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            Peminjam / Anggota
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 text-slate-600">
                                    @indodate($u->created_at)
                                </td>
                                <td class="py-3.5 px-4 text-right space-x-1.5 whitespace-nowrap">
                                    <a href="{{ route('users.edit', $u) }}" class="inline-flex items-center px-2.5 py-1 bg-white border border-slate-200 text-slate-700 hover:text-blue-600 hover:border-blue-300 rounded-md text-[11px] font-medium active:scale-95 transition-all shadow-sm">
                                        Edit
                                    </a>
                                    @if($u->id !== Auth::id())
                                        <form action="{{ route('users.destroy', $u) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun {{ $u->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-2.5 py-1 bg-white border border-rose-200 text-rose-600 hover:bg-rose-50 rounded-md text-[11px] font-medium active:scale-95 transition-all shadow-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-slate-400">
                                    <svg class="w-10 h-10 mx-auto text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Tidak ada data pengguna yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
                <div class="p-3.5 border-t border-slate-100 bg-slate-50/50">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
