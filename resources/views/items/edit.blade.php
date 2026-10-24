<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <nav class="text-xs text-blue-600/70 mb-1 flex items-center gap-1.5 font-medium">
                    <a href="{{ route('dashboard') }}" class="hover:text-blue-700 transition">Dashboard</a>
                    <span class="text-slate-300">&rsaquo;</span>
                    <a href="{{ route('items.index') }}" class="hover:text-blue-700 transition">Data Sarpras</a>
                    <span class="text-slate-300">&rsaquo;</span>
                    <span class="text-slate-700 font-semibold">Perbarui Data</span>
                </nav>
                <div class="flex items-center gap-3">
                    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Edit Sarana & Prasarana</h1>
                    <span class="font-mono text-xs font-semibold px-2.5 py-0.5 bg-blue-50 text-blue-700 border border-blue-200 rounded-full">
                        {{ $item->code }}
                    </span>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('items.show', $item) }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-white border border-slate-200 hover:border-blue-300 rounded-xl text-xs font-semibold text-slate-700 hover:bg-blue-50/60 transition-all duration-200 active:scale-95 shadow-xs">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    Lihat Detail
                </a>
                <a href="{{ route('items.index') }}" class="inline-flex items-center gap-1 px-3.5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-semibold transition active:scale-95">
                    &larr; Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        <!-- Form Column (2 Cols) -->
        <div class="lg:col-span-2 space-y-6">
            <form method="POST" action="{{ route('items.update', $item) }}" id="item-form" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Card 1: Identitas Barang -->
                <div class="bg-white rounded-2xl border border-blue-100/80 shadow-[0_4px_20px_rgba(37,99,235,0.04)] overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 bg-gradient-to-r from-blue-50/50 to-transparent flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold text-xs shadow-sm shadow-blue-500/20">
                            1
                        </div>
                        <div>
                            <h2 class="text-sm font-bold text-slate-900">Identitas Sarana & Prasarana</h2>
                            <p class="text-xs text-slate-500">Informasi utama klasifikasi dan penomoran registrasi aset.</p>
                        </div>
                    </div>

                    <div class="p-6 space-y-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <!-- Category -->
                            <div>
                                <label for="category_id" class="block text-xs font-semibold text-slate-700 mb-1.5">
                                    Kategori Sarpras <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative">
                                    <select 
                                        name="category_id" 
                                        id="category_id" 
                                        class="block w-full rounded-xl border-slate-200 bg-slate-50/40 text-xs py-2.5 px-3.5 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500/20 transition"
                                        required
                                        onchange="updatePreview()"
                                    >
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }} data-name="{{ $category->name }}">
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_id')
                                    <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Code -->
                            <div>
                                <label for="code" class="block text-xs font-semibold text-slate-700 mb-1.5">
                                    Nomor / Kode Inventaris <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 font-mono text-xs font-bold">
                                        #
                                    </div>
                                    <input 
                                        type="text" 
                                        name="code" 
                                        id="code" 
                                        value="{{ old('code', $item->code) }}" 
                                        placeholder="Contoh: LAB-001" 
                                        class="block w-full pl-8 rounded-xl border-slate-200 bg-slate-50/40 text-xs py-2.5 px-3.5 uppercase font-mono font-bold tracking-wider text-slate-800 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500/20 transition"
                                        required
                                        oninput="updatePreview()"
                                    >
                                </div>
                                @error('code')
                                    <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-xs font-semibold text-slate-700 mb-1.5">
                                Nama Barang / Aset <span class="text-rose-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                value="{{ old('name', $item->name) }}" 
                                placeholder="Contoh: Proyektor Epson EB-X500" 
                                class="block w-full rounded-xl border-slate-200 bg-slate-50/40 text-xs py-2.5 px-3.5 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500/20 transition font-medium"
                                required
                                oninput="updatePreview()"
                            >
                            @error('name')
                                <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Card 2: Lokasi, Stok & Kondisi Fisik -->
                <div class="bg-white rounded-2xl border border-blue-100/80 shadow-[0_4px_20px_rgba(37,99,235,0.04)] overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 bg-gradient-to-r from-blue-50/50 to-transparent flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold text-xs shadow-sm shadow-blue-500/20">
                            2
                        </div>
                        <div>
                            <h2 class="text-sm font-bold text-slate-900">Lokasi Penempatan & Kondisi Fisik</h2>
                            <p class="text-xs text-slate-500">Ruangan penempatan unit, total stok fisik, serta status kelayakan operasional.</p>
                        </div>
                    </div>

                    <div class="p-6 space-y-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <!-- Location -->
                            <div>
                                <label for="location" class="block text-xs font-semibold text-slate-700 mb-1.5">
                                    Ruangan / Penempatan <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative">
                                    <input 
                                        type="text" 
                                        name="location" 
                                        id="location" 
                                        list="location-list"
                                        value="{{ old('location', $item->location) }}" 
                                        placeholder="Contoh: Lab Komputer 1" 
                                        class="block w-full rounded-xl border-slate-200 bg-slate-50/40 text-xs py-2.5 px-3.5 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500/20 transition"
                                        required
                                        oninput="updatePreview()"
                                    >
                                    <datalist id="location-list">
                                        @foreach($locations as $loc)
                                            <option value="{{ $loc }}">
                                        @endforeach
                                        <option value="Laboratorium IPA">
                                        <option value="Laboratorium Komputer">
                                        <option value="Ruang Multimedia">
                                        <option value="Perpustakaan">
                                        <option value="Ruang Guru & TU">
                                        <option value="Gudang Sarpras Utama">
                                    </datalist>
                                </div>
                                <div class="flex flex-wrap gap-1.5 mt-2">
                                    <button type="button" onclick="setLocation('Lab Komputer')" class="px-2 py-0.5 rounded-lg bg-slate-100 hover:bg-blue-50 text-[10px] text-slate-600 hover:text-blue-600 transition font-medium">Lab Komputer</button>
                                    <button type="button" onclick="setLocation('Ruang Guru & TU')" class="px-2 py-0.5 rounded-lg bg-slate-100 hover:bg-blue-50 text-[10px] text-slate-600 hover:text-blue-600 transition font-medium">Ruang Guru</button>
                                    <button type="button" onclick="setLocation('Gudang Sarpras Utama')" class="px-2 py-0.5 rounded-lg bg-slate-100 hover:bg-blue-50 text-[10px] text-slate-600 hover:text-blue-600 transition font-medium">Gudang Sarpras</button>
                                </div>
                                @error('location')
                                    <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Stock -->
                            <div>
                                <label for="stock" class="block text-xs font-semibold text-slate-700 mb-1.5">
                                    Jumlah Unit Fisik <span class="text-rose-500">*</span>
                                </label>
                                <div class="flex items-center gap-2">
                                    <button type="button" onclick="adjustStock(-1)" class="w-10 h-10 rounded-xl border border-slate-200 bg-slate-50 hover:bg-slate-100 flex items-center justify-center text-slate-600 font-bold active:scale-95 transition">-</button>
                                    <input 
                                        type="number" 
                                        name="stock" 
                                        id="stock" 
                                        value="{{ old('stock', $item->stock) }}" 
                                        min="0"
                                        class="block w-full rounded-xl border-slate-200 bg-slate-50/40 text-center text-xs py-2.5 px-3 font-mono font-bold text-slate-900 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500/20 transition"
                                        required
                                        oninput="updatePreview()"
                                    >
                                    <button type="button" onclick="adjustStock(1)" class="w-10 h-10 rounded-xl border border-slate-200 bg-slate-50 hover:bg-slate-100 flex items-center justify-center text-slate-600 font-bold active:scale-95 transition">+</button>
                                </div>
                                @error('stock')
                                    <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Condition Radio Selector -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-2">
                                Kondisi Fisik Kelayakan <span class="text-rose-500">*</span>
                            </label>
                            <input type="hidden" name="condition" id="condition_input" value="{{ old('condition', $item->condition) }}">
                            
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                <!-- Baik -->
                                <button 
                                    type="button" 
                                    onclick="setCondition('baik')" 
                                    id="btn-cond-baik"
                                    class="p-3.5 rounded-xl border text-left transition-all duration-200 flex flex-col justify-between group {{ old('condition', $item->condition) === 'baik' ? 'border-emerald-500 bg-emerald-50/50 ring-2 ring-emerald-500/20 shadow-xs' : 'border-slate-200 hover:border-slate-300 bg-white' }}"
                                >
                                    <div class="flex items-center justify-between mb-1.5">
                                        <span class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-700">
                                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                            Baik
                                        </span>
                                        <svg class="w-4 h-4 text-emerald-600 cond-check {{ old('condition', $item->condition) === 'baik' ? '' : 'hidden' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <p class="text-[11px] text-slate-500 leading-tight">Prima & siap digunakan tanpa kendala.</p>
                                </button>

                                <!-- Rusak Ringan -->
                                <button 
                                    type="button" 
                                    onclick="setCondition('rusak ringan')" 
                                    id="btn-cond-rusak-ringan"
                                    class="p-3.5 rounded-xl border text-left transition-all duration-200 flex flex-col justify-between group {{ old('condition', $item->condition) === 'rusak ringan' ? 'border-amber-500 bg-amber-50/50 ring-2 ring-amber-500/20 shadow-xs' : 'border-slate-200 hover:border-slate-300 bg-white' }}"
                                >
                                    <div class="flex items-center justify-between mb-1.5">
                                        <span class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-700">
                                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                            Rusak Ringan
                                        </span>
                                        <svg class="w-4 h-4 text-amber-600 cond-check {{ old('condition', $item->condition) === 'rusak ringan' ? '' : 'hidden' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <p class="text-[11px] text-slate-500 leading-tight">Berfungsi sebagian / perlu servis ringan.</p>
                                </button>

                                <!-- Rusak Berat -->
                                <button 
                                    type="button" 
                                    onclick="setCondition('rusak berat')" 
                                    id="btn-cond-rusak-berat"
                                    class="p-3.5 rounded-xl border text-left transition-all duration-200 flex flex-col justify-between group {{ old('condition', $item->condition) === 'rusak berat' ? 'border-rose-500 bg-rose-50/50 ring-2 ring-rose-500/20 shadow-xs' : 'border-slate-200 hover:border-slate-300 bg-white' }}"
                                >
                                    <div class="flex items-center justify-between mb-1.5">
                                        <span class="inline-flex items-center gap-1.5 text-xs font-bold text-rose-700">
                                            <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                                            Rusak Berat
                                        </span>
                                        <svg class="w-4 h-4 text-rose-600 cond-check {{ old('condition', $item->condition) === 'rusak berat' ? '' : 'hidden' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <p class="text-[11px] text-slate-500 leading-tight">Mati total / tidak layak dipinjamkan.</p>
                                </button>
                            </div>
                            @error('condition')
                                <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Card 3: Pengadaan & Spesifikasi Detail -->
                <div class="bg-white rounded-2xl border border-blue-100/80 shadow-[0_4px_20px_rgba(37,99,235,0.04)] overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 bg-gradient-to-r from-blue-50/50 to-transparent flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold text-xs shadow-sm shadow-blue-500/20">
                            3
                        </div>
                        <div>
                            <h2 class="text-sm font-bold text-slate-900">Pengadaan & Spesifikasi Teknis</h2>
                            <p class="text-xs text-slate-500">Asal pendanaan anggaran, tahun registrasi, dan catatan pemeliharaan.</p>
                        </div>
                    </div>

                    <div class="p-6 space-y-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <!-- Source Fund -->
                            <div>
                                <label for="source_fund" class="block text-xs font-semibold text-slate-700 mb-1.5">
                                    Sumber Pendanaan
                                </label>
                                <select 
                                    name="source_fund" 
                                    id="source_fund" 
                                    class="block w-full rounded-xl border-slate-200 bg-slate-50/40 text-xs py-2.5 px-3.5 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500/20 transition"
                                    onchange="updatePreview()"
                                >
                                    <option value="BOS Reguler" {{ old('source_fund', $item->source_fund) === 'BOS Reguler' ? 'selected' : '' }}>BOS Reguler</option>
                                    <option value="BOS Kinerja" {{ old('source_fund', $item->source_fund) === 'BOS Kinerja' ? 'selected' : '' }}>BOS Kinerja / Afirmasi</option>
                                    <option value="DAK Pendidikan" {{ old('source_fund', $item->source_fund) === 'DAK Pendidikan' ? 'selected' : '' }}>DAK Fisik Pendidikan</option>
                                    <option value="Komite Sekolah" {{ old('source_fund', $item->source_fund) === 'Komite Sekolah' ? 'selected' : '' }}>Komite Sekolah / Mandiri</option>
                                    <option value="Hibah / Bantuan" {{ old('source_fund', $item->source_fund) === 'Hibah / Bantuan' ? 'selected' : '' }}>Hibah / Sumbangan Alumni / CSR</option>
                                </select>
                                @error('source_fund')
                                    <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Year -->
                            <div>
                                <label for="procurement_year" class="block text-xs font-semibold text-slate-700 mb-1.5">
                                    Tahun Pengadaan / Perolehan
                                </label>
                                <input 
                                    type="number" 
                                    name="procurement_year" 
                                    id="procurement_year" 
                                    value="{{ old('procurement_year', $item->procurement_year) }}" 
                                    min="1990" 
                                    max="{{ date('Y') + 1 }}"
                                    class="block w-full rounded-xl border-slate-200 bg-slate-50/40 text-xs py-2.5 px-3.5 font-mono focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500/20 transition"
                                    oninput="updatePreview()"
                                >
                                @error('procurement_year')
                                    <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-xs font-semibold text-slate-700 mb-1.5">
                                Spesifikasi Teknis / Catatan Perawatan
                            </label>
                            <textarea 
                                name="description" 
                                id="description" 
                                rows="3" 
                                placeholder="Tuliskan nomor seri mesin/model, kelengkapan aksesoris, atau catatan kelayakan fisik barang..." 
                                class="block w-full rounded-xl border-slate-200 bg-slate-50/40 text-xs py-2.5 px-3.5 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500/20 transition"
                                oninput="updatePreview()"
                            >{{ old('description', $item->description) }}</textarea>
                            @error('description')
                                <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Action Footer -->
                <div class="flex items-center justify-between p-4 bg-white rounded-2xl border border-blue-100/80 shadow-xs">
                    <a href="{{ route('items.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 active:scale-95 transition">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white rounded-xl text-xs font-semibold shadow-md shadow-blue-500/25 active:scale-95 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Perubahan Data
                    </button>
                </div>
            </form>
        </div>

        <!-- Right Side: Live Card Preview -->
        <div class="lg:col-span-1 space-y-6 lg:sticky lg:top-6">
            <div class="bg-white rounded-2xl border border-blue-100 shadow-[0_8px_30px_rgba(37,99,235,0.06)] overflow-hidden">
                <div class="p-5 border-b border-slate-100 bg-gradient-to-br from-slate-900 to-blue-950 text-white relative">
                    <div class="flex items-center justify-between mb-3">
                        <span id="prev-category" class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-white/20 backdrop-blur-xs text-white border border-white/20">
                            {{ $item->category->name }}
                        </span>
                        <span class="text-[10px] text-blue-200 font-mono tracking-wider">LIVE PREVIEW</span>
                    </div>
                    <h3 id="prev-name" class="text-base font-bold text-white tracking-tight leading-snug line-clamp-2">
                        {{ $item->name }}
                    </h3>
                    <p id="prev-code" class="text-xs font-mono font-bold text-blue-300 mt-1">
                        {{ $item->code }}
                    </p>
                </div>

                <div class="p-5 space-y-4">
                    <!-- QR Code Preview -->
                    <div class="bg-blue-50/50 border border-blue-100 rounded-xl p-3 flex items-center gap-3">
                        <canvas id="prev-qr-canvas" class="w-14 h-14 shrink-0 rounded bg-white p-1 border border-blue-200/60"></canvas>
                        <div class="text-[11px] text-slate-600">
                            <span class="font-bold text-slate-800 block">Stiker Barcode / QR</span>
                            <span class="text-slate-500">Otomatis sinkron dengan kode inventaris.</span>
                        </div>
                    </div>

                    <!-- Metrics Grid -->
                    <div class="grid grid-cols-2 gap-3 text-xs">
                        <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                            <span class="text-[10px] text-slate-400 block font-medium">Stok Fisik</span>
                            <span id="prev-stock" class="text-sm font-bold font-mono text-slate-800 mt-0.5 block">
                                {{ $item->stock }} Unit
                            </span>
                        </div>
                        <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                            <span class="text-[10px] text-slate-400 block font-medium">Kondisi Fisik</span>
                            <span id="prev-condition-badge" class="inline-block mt-0.5 text-xs font-bold capitalize">
                                {{ $item->condition }}
                            </span>
                        </div>
                    </div>

                    <div class="space-y-2 text-xs border-t border-slate-100 pt-3">
                        <div class="flex justify-between py-1 border-b border-slate-50">
                            <span class="text-slate-400">Lokasi:</span>
                            <span id="prev-location" class="font-semibold text-slate-700">{{ $item->location }}</span>
                        </div>
                        <div class="flex justify-between py-1 border-b border-slate-50">
                            <span class="text-slate-400">Sumber Dana:</span>
                            <span id="prev-source" class="font-medium text-slate-700">{{ $item->source_fund }}</span>
                        </div>
                        <div class="flex justify-between py-1">
                            <span class="text-slate-400">Tahun Perolehan:</span>
                            <span id="prev-year" class="font-mono text-slate-700">{{ $item->procurement_year }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hint Box -->
            <div class="bg-blue-50/70 border border-blue-200/80 rounded-2xl p-4 text-xs text-blue-900 flex items-start gap-3">
                <svg class="w-5 h-5 text-blue-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="space-y-1">
                    <p class="font-bold">Tips Kode Inventaris:</p>
                    <p class="text-blue-800/80 leading-relaxed text-[11px]">
                        Gunakan kode singkatan ruangan dan jenis barang (misal: <code>LAB-PC-01</code> atau <code>SPR-PROJ-03</code>) agar mudah dipindai dengan barcode scanner.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setLocation(loc) {
            document.getElementById('location').value = loc;
            updatePreview();
        }

        function adjustStock(delta) {
            const el = document.getElementById('stock');
            let val = parseInt(el.value || '0', 10) + delta;
            if (val < 0) val = 0;
            el.value = val;
            updatePreview();
        }

        function setCondition(cond) {
            document.getElementById('condition_input').value = cond;
            
            // Buttons visual update
            ['baik', 'rusak ringan', 'rusak berat'].forEach(c => {
                const id = 'btn-cond-' + c.replace(' ', '-');
                const btn = document.getElementById(id);
                if (!btn) return;
                const check = btn.querySelector('.cond-check');
                if (c === cond) {
                    if (c === 'baik') btn.className = 'p-3.5 rounded-xl border text-left transition-all duration-200 flex flex-col justify-between group border-emerald-500 bg-emerald-50/50 ring-2 ring-emerald-500/20 shadow-xs';
                    if (c === 'rusak ringan') btn.className = 'p-3.5 rounded-xl border text-left transition-all duration-200 flex flex-col justify-between group border-amber-500 bg-amber-50/50 ring-2 ring-amber-500/20 shadow-xs';
                    if (c === 'rusak berat') btn.className = 'p-3.5 rounded-xl border text-left transition-all duration-200 flex flex-col justify-between group border-rose-500 bg-rose-50/50 ring-2 ring-rose-500/20 shadow-xs';
                    if (check) check.classList.remove('hidden');
                } else {
                    btn.className = 'p-3.5 rounded-xl border text-left transition-all duration-200 flex flex-col justify-between group border-slate-200 hover:border-slate-300 bg-white';
                    if (check) check.classList.add('hidden');
                }
            });

            updatePreview();
        }

        function updatePreview() {
            const name = document.getElementById('name').value || 'Nama Sarpras';
            const code = document.getElementById('code').value || 'KODE-000';
            const location = document.getElementById('location').value || '-';
            const stock = document.getElementById('stock').value || '0';
            const source = document.getElementById('source_fund').value || '-';
            const year = document.getElementById('procurement_year').value || '-';
            const cond = document.getElementById('condition_input').value || 'baik';

            const catSelect = document.getElementById('category_id');
            const selectedOpt = catSelect.options[catSelect.selectedIndex];
            const catName = selectedOpt ? selectedOpt.getAttribute('data-name') : 'Kategori';

            document.getElementById('prev-name').textContent = name;
            document.getElementById('prev-code').textContent = code;
            document.getElementById('prev-category').textContent = catName;
            document.getElementById('prev-location').textContent = location;
            document.getElementById('prev-stock').textContent = stock + ' Unit';
            document.getElementById('prev-source').textContent = source;
            document.getElementById('prev-year').textContent = year;

            const condEl = document.getElementById('prev-condition-badge');
            condEl.textContent = cond.toUpperCase();
            if (cond === 'baik') condEl.className = 'inline-block mt-0.5 text-xs font-bold text-emerald-600';
            else if (cond === 'rusak ringan') condEl.className = 'inline-block mt-0.5 text-xs font-bold text-amber-600';
            else condEl.className = 'inline-block mt-0.5 text-xs font-bold text-rose-600';

            // QR Code render
            if (window.QRCode) {
                const canvas = document.getElementById('prev-qr-canvas');
                if (canvas) {
                    window.QRCode.toCanvas(canvas, code, {
                        width: 56,
                        margin: 1,
                        color: { dark: '#0f172a', light: '#ffffff' }
                    });
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            updatePreview();
        });
    </script>
</x-app-layout>
