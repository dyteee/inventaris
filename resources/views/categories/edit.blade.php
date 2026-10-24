<x-app-layout>
    <x-slot name="header">
        <nav class="text-xs text-blue-600/70 mb-1 flex items-center gap-1.5 font-medium">
            <a href="{{ route('dashboard') }}" class="hover:text-blue-700 transition">Dashboard</a>
            <span class="text-slate-300">&rsaquo;</span>
            <a href="{{ route('categories.index') }}" class="hover:text-blue-700 transition">Kategori Sarpras</a>
            <span class="text-slate-300">&rsaquo;</span>
            <span class="text-slate-700 font-semibold">Edit Kategori</span>
        </nav>
        <div class="flex items-center gap-3">
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Edit Kategori Sarpras</h1>
            <span class="font-mono text-xs font-semibold px-2.5 py-0.5 bg-blue-50 text-blue-700 border border-blue-200 rounded-full">
                #ID-{{ $category->id }}
            </span>
        </div>
    </x-slot>

    <div class="max-w-xl mx-auto">
        <div class="bg-white rounded-2xl border border-blue-100/80 shadow-[0_8px_30px_rgba(37,99,235,0.06)] overflow-hidden">
            <!-- Header Illustration -->
            <div class="p-6 bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-700 text-white flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center border border-white/20 shadow-xs shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-bold text-white tracking-tight">Perbarui Nama Kategori</h2>
                    <p class="text-xs text-blue-100/80">Kategori ini menampung {{ $category->items()->count() }} aset inventaris.</p>
                </div>
            </div>

            <!-- Form Body -->
            <form method="POST" action="{{ route('categories.update', $category) }}" class="p-6 sm:p-8 space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
                        Nama Kategori Barang <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <input 
                            type="text" 
                            name="name" 
                            id="category_name" 
                            value="{{ old('name', $category->name) }}" 
                            autofocus 
                            placeholder="Contoh: Elektronik & Multimedia" 
                            class="block w-full rounded-xl border-slate-200 bg-slate-50/40 text-xs py-3 px-3.5 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500/20 transition font-medium"
                            required
                            oninput="updateCategoryPreview(this.value)"
                        >
                    </div>
                    @error('name')
                        <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Live Tag Preview Card -->
                <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 space-y-2">
                    <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider block">Preview Tampilan Label Kategori</span>
                    <div class="flex items-center gap-2">
                        <span id="category_preview_badge" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                            {{ $category->name }}
                        </span>
                        <span class="text-[11px] text-slate-400">&bull; Label aset di tabel & filter</span>
                    </div>
                </div>

                <!-- Quick Presets -->
                <div>
                    <span class="text-xs font-semibold text-slate-500 block mb-2">Pilihan Cepat Kategori:</span>
                    <div class="flex flex-wrap gap-2">
                        @foreach(['Elektronik & IT', 'Alat Praktikum IPA', 'Perabot & Meubelair', 'Sarana Olahraga', 'Audio Visual', 'Buku & Pustaka'] as $preset)
                            <button 
                                type="button" 
                                onclick="pickCategoryPreset('{{ $preset }}')" 
                                class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-blue-50 text-[11px] text-slate-600 hover:text-blue-600 border border-slate-200 hover:border-blue-200 transition font-medium active:scale-95"
                            >
                                + {{ $preset }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Actions -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('categories.index') }}" class="px-4 py-2.5 border border-slate-200 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-50 active:scale-95 transition">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center gap-1.5 px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white rounded-xl text-xs font-semibold shadow-md shadow-blue-500/25 active:scale-95 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Perbarui Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function updateCategoryPreview(val) {
            const badge = document.getElementById('category_preview_badge');
            if (badge) {
                badge.innerHTML = '<span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> ' + (val || 'Nama Kategori');
            }
        }
        function pickCategoryPreset(name) {
            const input = document.getElementById('category_name');
            input.value = name;
            updateCategoryPreview(name);
            input.focus();
        }
    </script>
</x-app-layout>
