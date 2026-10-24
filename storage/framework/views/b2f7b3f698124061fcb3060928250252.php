<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <nav class="text-xs text-blue-600/70 mb-1 flex items-center gap-1.5 font-medium">
                    <span class="text-slate-400">SIM Sarpras</span>
                    <span class="text-slate-300">&rsaquo;</span>
                    <span class="text-slate-700 font-semibold">Dashboard Utama</span>
                </nav>
                <div class="flex items-center gap-3">
                    <h1 class="text-2xl font-black text-slate-900 tracking-tight">
                        <?php echo e(Auth::user()->isAdmin() ? 'Dashboard Pengelola Sarpras' : 'Dashboard Peminjaman Inventaris'); ?>

                    </h1>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200 shadow-2xs">
                        <?php echo now() ? \Carbon\Carbon::parse(now())->locale('id')->translatedFormat('j M Y') : '-'; ?>
                    </span>
                </div>
            </div>
            
            <!-- Quick Action Toolbar with soft click animations -->
            <div class="flex flex-wrap items-center gap-2">
                <?php if(Auth::user()->isAdmin()): ?>
                    <a href="<?php echo e(route('reports.index')); ?>" class="inline-flex items-center gap-1.5 px-3 py-2 bg-white border border-slate-200 hover:border-blue-300 rounded-xl text-xs font-semibold text-slate-700 hover:bg-blue-50/60 transition-all duration-200 active:scale-95 shadow-xs">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Laporan Resmi
                    </a>
                    <a href="<?php echo e(route('return_logs.create')); ?>" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-white border border-slate-200 hover:border-blue-300 rounded-xl text-xs font-semibold text-slate-700 hover:bg-blue-50/60 transition-all duration-200 active:scale-95 shadow-xs">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Pengembalian
                    </a>
                    <a href="<?php echo e(route('items.create')); ?>" class="inline-flex items-center gap-1.5 px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl text-xs font-semibold hover:from-blue-700 hover:to-indigo-700 shadow-md shadow-blue-500/20 transition-all duration-200 active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Barang
                    </a>
                <?php else: ?>
                    <a href="<?php echo e(route('items.index')); ?>" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-white border border-slate-200 hover:border-blue-300 rounded-xl text-xs font-semibold text-slate-700 hover:bg-blue-50/60 transition-all duration-200 active:scale-95 shadow-xs">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        Katalog Sarpras
                    </a>
                    <a href="<?php echo e(route('loans.create')); ?>" class="inline-flex items-center gap-1.5 px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl text-xs font-bold hover:from-blue-700 hover:to-indigo-700 shadow-md shadow-blue-500/20 transition-all duration-200 active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Ajukan Peminjaman
                    </a>
                <?php endif; ?>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <?php if(Auth::user()->isAdmin()): ?>
        <!-- ========================================== -->
        <!-- ADMIN DASHBOARD                            -->
        <!-- ========================================== -->
        <div class="space-y-6">
            <!-- Stat Cards Grid with soft lift animation -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Total Items & Physical Stock -->
                <div class="bg-white p-5 rounded-2xl border border-blue-100/80 shadow-[0_2px_12px_rgba(37,99,235,0.04)] card-hover flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Sarpras Terdata</span>
                            <span class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shadow-xs border border-blue-100/60">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex items-baseline gap-2 mt-3">
                            <span class="text-2xl font-black text-slate-900 font-mono"><?php echo number_format((float)($totalItems ?? 0), 0, ',', '.'); ?></span>
                            <span class="text-xs text-slate-500 font-medium">Jenis (<?php echo number_format((float)($totalStockPhysical ?? 0), 0, ',', '.'); ?> Unit)</span>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                        <span class="text-slate-500 font-medium"><?php echo e($totalCategories); ?> Kategori Sarpras</span>
                        <a href="<?php echo e(route('items.index')); ?>" class="text-blue-600 font-bold hover:underline active:scale-95 transition">Kelola Aset &rarr;</a>
                    </div>
                </div>

                <!-- Kondisi Fisik Segment -->
                <div class="bg-white p-5 rounded-2xl border border-blue-100/80 shadow-[0_2px_12px_rgba(37,99,235,0.04)] card-hover flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Kondisi Fisik Sarpras</span>
                            <span class="w-9 h-9 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center shadow-xs border border-sky-100/60">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </span>
                        </div>
                        <div class="mt-3 flex items-center gap-3">
                            <div>
                                <span class="text-[11px] text-slate-500 block">Baik</span>
                                <span class="text-lg font-black text-emerald-600 font-mono"><?php echo e($conditionStats['baik']); ?></span>
                            </div>
                            <div class="border-l border-slate-200 pl-3">
                                <span class="text-[11px] text-slate-500 block">R. Ringan</span>
                                <span class="text-lg font-black text-amber-600 font-mono"><?php echo e($conditionStats['rusak_ringan']); ?></span>
                            </div>
                            <div class="border-l border-slate-200 pl-3">
                                <span class="text-[11px] text-slate-500 block">R. Berat</span>
                                <span class="text-lg font-black text-rose-600 font-mono"><?php echo e($conditionStats['rusak_berat']); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                        <span class="text-slate-500 font-medium">Kelayakan: <?php echo e($totalStockPhysical > 0 ? round(($conditionStats['baik'] / $totalStockPhysical) * 100) : 0); ?>%</span>
                        <a href="<?php echo e(route('reports.index')); ?>" class="text-blue-600 font-bold hover:underline active:scale-95 transition">Rekap &rarr;</a>
                    </div>
                </div>

                <!-- Active Loans -->
                <div class="bg-white p-5 rounded-2xl border border-blue-100/80 shadow-[0_2px_12px_rgba(37,99,235,0.04)] card-hover flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Sedang Dipinjam</span>
                            <span class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shadow-xs border border-amber-100/60">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex items-baseline gap-2 mt-3">
                            <span class="text-2xl font-black text-amber-700 font-mono"><?php echo number_format((float)($activeLoans ?? 0), 0, ',', '.'); ?></span>
                            <span class="text-xs text-slate-500 font-medium">Transaksi Aktif</span>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                        <span class="text-slate-500 font-medium">Total Kembali: <?php echo number_format((float)($returnedLoans ?? 0), 0, ',', '.'); ?></span>
                        <a href="<?php echo e(route('loans.index', ['status' => 'dipinjam'])); ?>" class="text-amber-700 font-bold hover:underline active:scale-95 transition">Pantau &rarr;</a>
                    </div>
                </div>

                <!-- Overdue Loans -->
                <div class="bg-white p-5 rounded-2xl border border-blue-100/80 shadow-[0_2px_12px_rgba(37,99,235,0.04)] card-hover flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Jatuh Tempo / Terlambat</span>
                            <span class="w-9 h-9 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center shadow-xs border border-rose-100/60">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex items-baseline gap-2 mt-3">
                            <span class="text-2xl font-black text-rose-600 font-mono"><?php echo number_format((float)($lateLoans ?? 0), 0, ',', '.'); ?></span>
                            <span class="text-xs text-slate-500 font-medium">Perlu Ditegur</span>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                        <span class="text-slate-500 font-medium">Penagihan Sarpras</span>
                        <a href="<?php echo e(route('loans.index', ['status' => 'terlambat'])); ?>" class="text-rose-600 font-bold hover:underline active:scale-95 transition">Tindak Lanjut &rarr;</a>
                    </div>
                </div>
            </div>

            <!-- Main Content 2-Column Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Recent Loans Table (2 Cols) -->
                <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/90 shadow-[0_2px_12px_rgba(37,99,235,0.03)] overflow-hidden">
                    <div class="p-4 sm:p-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                        <div>
                            <h2 class="text-sm font-bold text-slate-900">Transaksi Peminjaman Terkini</h2>
                            <p class="text-xs text-slate-500">Sirkulasi peminjaman sarpras yang baru diajukan atau diproses.</p>
                        </div>
                        <a href="<?php echo e(route('loans.index')); ?>" class="text-xs font-bold text-blue-600 hover:text-blue-700 bg-blue-50/80 hover:bg-blue-100/80 border border-blue-200/60 px-3 py-1.5 rounded-xl transition-all active:scale-95">
                            Lihat Semua Transaksi
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs text-slate-600">
                            <thead class="bg-slate-50/70 text-[11px] uppercase tracking-wider text-slate-500 border-b border-slate-200">
                                <tr>
                                    <th class="py-3 px-4">Peminjam</th>
                                    <th class="py-3 px-4">Barang & Kode</th>
                                    <th class="py-3 px-4 text-center">Unit</th>
                                    <th class="py-3 px-4">Tenggat</th>
                                    <th class="py-3 px-4 text-center">Status</th>
                                    <th class="py-3 px-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <?php $__empty_1 = true; $__currentLoopData = $recentLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr class="row-hover">
                                        <td class="py-3 px-4 font-bold text-slate-900">
                                            <?php echo e($loan->user->name); ?>

                                        </td>
                                        <td class="py-3 px-4">
                                            <span class="font-bold text-slate-900 block truncate max-w-[180px]"><?php echo e($loan->item->name); ?></span>
                                            <span class="font-mono text-[10px] text-slate-400"><?php echo e($loan->item->code); ?> &bull; <?php echo e($loan->item->location ?? 'Gudang'); ?></span>
                                        </td>
                                        <td class="py-3 px-4 text-center font-black font-mono text-slate-800">
                                            <?php echo number_format((float)($loan->quantity ?? 0), 0, ',', '.'); ?>
                                        </td>
                                        <td class="py-3 px-4 text-slate-700">
                                            <?php echo $loan->due_date ? \Carbon\Carbon::parse($loan->due_date)->locale('id')->translatedFormat('j M Y') : '-'; ?>
                                        </td>
                                        <td class="py-3 px-4 text-center">
                                            <?php if($loan->status === 'dipinjam'): ?>
                                                <span class="inline-flex items-center px-2.5 py-0.5 text-[11px] font-bold rounded-full bg-amber-50 text-amber-700 border border-amber-200">
                                                    Dipinjam
                                                </span>
                                            <?php elseif($loan->status === 'dikembalikan'): ?>
                                                <span class="inline-flex items-center px-2.5 py-0.5 text-[11px] font-bold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                    Kembali
                                                </span>
                                            <?php else: ?>
                                                <span class="inline-flex items-center px-2.5 py-0.5 text-[11px] font-bold rounded-full bg-rose-50 text-rose-700 border border-rose-200">
                                                    Terlambat
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="py-3 px-4 text-right space-x-1 whitespace-nowrap">
                                            <a href="<?php echo e(route('loans.show', $loan)); ?>" class="inline-flex items-center px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-blue-50 hover:text-blue-600 text-slate-700 text-[11px] font-semibold transition active:scale-95">
                                                Detail
                                            </a>
                                            <?php if($loan->status !== 'dikembalikan'): ?>
                                                <a href="<?php echo e(route('return_logs.create', ['loan_id' => $loan->id])); ?>" class="inline-flex items-center px-2.5 py-1 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-200 text-[11px] font-semibold transition active:scale-95">
                                                    Kembalikan
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="6" class="py-8 text-center text-slate-400">Belum ada riwayat transaksi peminjaman.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Right Column: Low Stock / Need Attention -->
                <div class="space-y-6 lg:col-span-1">
                    <!-- Low Stock Alert -->
                    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-[0_2px_12px_rgba(37,99,235,0.03)] overflow-hidden">
                        <div class="p-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                            <h2 class="text-xs font-bold text-slate-900 uppercase tracking-wider flex items-center gap-1.5">
                                <span class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></span>
                                Stok Sarpras Kritis (&le; 2)
                            </h2>
                            <a href="<?php echo e(route('items.index', ['stock_status' => 'empty'])); ?>" class="text-[11px] text-blue-600 hover:text-blue-700 font-bold active:scale-95 transition">Filter</a>
                        </div>
                        <div class="p-3 divide-y divide-slate-100 text-xs">
                            <?php $__empty_1 = true; $__currentLoopData = $lowStockItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="py-2.5 flex items-center justify-between first:pt-0 last:pb-0 hover:bg-blue-50/30 px-2 rounded-xl transition">
                                    <div class="pr-2 truncate">
                                        <div class="font-bold text-slate-900 truncate"><?php echo e($item->name); ?></div>
                                        <div class="text-[10px] text-slate-400 font-mono"><?php echo e($item->code); ?> &bull; <?php echo e($item->location ?? 'Gudang'); ?></div>
                                    </div>
                                    <span class="px-2.5 py-0.5 text-[11px] font-bold rounded-full shrink-0 <?php echo e($item->stock == 0 ? 'bg-rose-50 text-rose-700 border border-rose-200' : 'bg-amber-50 text-amber-700 border border-amber-200'); ?>">
                                        <?php echo e($item->stock); ?> Unit
                                    </span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="text-center py-4 text-slate-400 text-xs">
                                    Semua stok sarpras dalam jumlah aman.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Quick Shortcuts / Useful Tools -->
                    <div class="bg-gradient-to-br from-blue-50 via-sky-50/50 to-white rounded-2xl p-4 sm:p-5 border border-blue-200/80 shadow-xs">
                        <div class="flex items-center gap-2.5 mb-2">
                            <div class="w-8 h-8 rounded-xl bg-blue-600 text-white flex items-center justify-center text-xs shadow-xs">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xs font-bold text-blue-900 uppercase tracking-wider leading-tight">Pusat Laporan & Akreditasi</h3>
                                <p class="text-[10px] text-blue-600 font-semibold">Standar Dokumen Resmi Sekolah</p>
                            </div>
                        </div>
                        <p class="text-[11px] text-slate-600 leading-relaxed mb-3">
                            Format berkas cetak berita acara resmi telah siap dengan Kop Sekolah dan lembar tanda tangan.
                        </p>
                        <div class="flex flex-col gap-2 text-xs">
                            <a href="<?php echo e(route('reports.index', ['type' => 'items'])); ?>" class="flex items-center justify-between p-2.5 rounded-xl bg-white border border-blue-100 hover:border-blue-300 hover:bg-blue-50/70 transition-all text-slate-700 font-semibold active:scale-[0.98] shadow-2xs">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                    <span>Rekapitulasi Aset & Ruangan</span>
                                </span>
                                <span class="text-blue-500 font-bold">&rarr;</span>
                            </a>
                            <a href="<?php echo e(route('reports.index', ['type' => 'loans'])); ?>" class="flex items-center justify-between p-2.5 rounded-xl bg-white border border-blue-100 hover:border-blue-300 hover:bg-blue-50/70 transition-all text-slate-700 font-semibold active:scale-[0.98] shadow-2xs">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <span>Laporan Sirkulasi Peminjaman</span>
                                </span>
                                <span class="text-blue-500 font-bold">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Audit Trail Feed -->
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-[0_2px_12px_rgba(37,99,235,0.03)] overflow-hidden">
                <div class="p-4 sm:p-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                    <div>
                        <h2 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Aktivitas Sistem Terkini (Audit Trail)</h2>
                        <p class="text-[11px] text-slate-500">Log transparansi aksi penambahan, perubahan, dan transaksi sarpras.</p>
                    </div>
                    <a href="<?php echo e(route('activity_logs.index')); ?>" class="text-xs font-bold text-blue-600 hover:text-blue-700 active:scale-95 transition">
                        Buka Log Lengkap &rarr;
                    </a>
                </div>
                <div class="p-4 sm:p-5">
                    <div class="space-y-3">
                        <?php $__currentLoopData = $recentActivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-start gap-3 text-xs border-b border-slate-100 pb-2.5 last:border-0 last:pb-0 hover:bg-blue-50/20 px-2 rounded-xl transition">
                                <span class="px-2.5 py-0.5 rounded-lg text-[10px] font-bold bg-blue-50 text-blue-700 shrink-0 uppercase tracking-wide border border-blue-200/70">
                                    <?php echo e(str_replace('_', ' ', $act->action)); ?>

                                </span>
                                <div class="flex-1">
                                    <span class="font-bold text-slate-900"><?php echo e($act->user->name ?? 'Sistem'); ?>:</span>
                                    <span class="text-slate-600"><?php echo e($act->description); ?></span>
                                </div>
                                <span class="text-[11px] text-slate-400 font-mono shrink-0"><?php echo $act->created_at ? \Carbon\Carbon::parse($act->created_at)->locale('id')->translatedFormat('j M Y H:i') : '-'; ?></span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <!-- ========================================== -->
        <!-- USER / GURU / SISWA DASHBOARD              -->
        <!-- ========================================== -->
        <div class="space-y-6">
            <!-- 1. PERSONALIZED WELCOME HERO BANNER -->
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-700 via-indigo-700 to-sky-600 text-white p-6 sm:p-8 shadow-xl shadow-blue-600/15">
                <!-- Decorative background elements -->
                <div class="absolute -top-24 -right-24 w-80 h-80 rounded-full bg-white/10 blur-2xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -left-24 w-80 h-80 rounded-full bg-sky-400/20 blur-2xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div class="flex items-start gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-white/15 backdrop-blur-md border border-white/20 flex items-center justify-center shrink-0 font-black text-xl text-white shadow-inner">
                            <?php echo e(strtoupper(substr(Auth::user()->name, 0, 2))); ?>

                        </div>
                        <div>
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="text-xs font-semibold text-blue-200">Portal Layanan Inventaris Siswa & Guru</span>
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-400/20 text-emerald-200 border border-emerald-300/30">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-300 animate-pulse"></span>
                                    Akun Terverifikasi
                                </span>
                            </div>
                            <h2 class="text-2xl sm:text-3xl font-black text-white tracking-tight mt-1">
                                Selamat Datang, <?php echo e(Auth::user()->name); ?>!
                            </h2>
                            <p class="text-xs sm:text-sm text-blue-100/90 mt-1 max-w-xl leading-relaxed">
                                Kelola kebutuhan peralatan belajar, praktikum, dan sarana multimedia SMKN 1 Ketapang secara mandiri, cepat, dan tercatat resmi.
                            </p>
                        </div>
                    </div>

                    <!-- Quick Call to Action Buttons -->
                    <div class="flex items-center gap-3 shrink-0 flex-wrap sm:flex-nowrap">
                        <a href="<?php echo e(route('loans.create')); ?>" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-3 rounded-2xl bg-white text-blue-700 hover:bg-blue-50 font-bold text-xs shadow-lg shadow-black/10 active:scale-95 transition-all duration-200 group">
                            <svg class="w-4 h-4 text-blue-600 group-hover:rotate-90 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span>Ajukan Peminjaman</span>
                        </a>
                        <a href="<?php echo e(route('items.index')); ?>" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-3 rounded-2xl bg-white/10 hover:bg-white/20 text-white font-semibold text-xs border border-white/20 backdrop-blur-md active:scale-95 transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <span>Cari Sarpras</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- 2. USER STAT CARDS -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <!-- Active Loans -->
                <div class="bg-white p-5 rounded-2xl border border-blue-100 shadow-[0_2px_12px_rgba(37,99,235,0.04)] card-hover flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Sedang Dipinjam</span>
                            <span class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center border border-amber-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                        </div>
                        <div class="mt-3">
                            <span class="text-3xl font-black text-amber-600 font-mono"><?php echo number_format((float)($myActiveLoans->count() ?? 0), 0, ',', '.'); ?></span>
                            <span class="text-xs text-slate-500 font-medium ml-1">Unit Barang</span>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                        <span class="text-slate-400">Tenggat aktif</span>
                        <a href="<?php echo e(route('loans.index', ['status' => 'dipinjam'])); ?>" class="text-amber-700 font-bold hover:underline">Lihat Rincian &rarr;</a>
                    </div>
                </div>

                <!-- Overdue Status -->
                <div class="bg-white p-5 rounded-2xl border border-blue-100 shadow-[0_2px_12px_rgba(37,99,235,0.04)] card-hover flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Jatuh Tempo Terlewati</span>
                            <span class="w-9 h-9 rounded-xl <?php echo e($myLateLoans->count() > 0 ? 'bg-rose-50 text-rose-600 border border-rose-100' : 'bg-emerald-50 text-emerald-600 border border-emerald-100'); ?> flex items-center justify-center">
                                <?php if($myLateLoans->count() > 0): ?>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                <?php else: ?>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                <?php endif; ?>
                            </span>
                        </div>
                        <div class="mt-3">
                            <span class="text-3xl font-black font-mono <?php echo e($myLateLoans->count() > 0 ? 'text-rose-600' : 'text-emerald-600'); ?>">
                                <?php echo number_format((float)($myLateLoans->count() ?? 0), 0, ',', '.'); ?>
                            </span>
                            <span class="text-xs text-slate-500 font-medium ml-1">Unit Terlambat</span>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                        <?php if($myLateLoans->count() > 0): ?>
                            <span class="text-rose-600 font-bold">Harap segera kembalikan!</span>
                            <a href="<?php echo e(route('loans.index', ['status' => 'terlambat'])); ?>" class="text-rose-600 font-bold hover:underline">Selesaikan &rarr;</a>
                        <?php else: ?>
                            <span class="text-emerald-600 font-semibold">Status Peminjaman Tertib</span>
                            <span class="text-slate-400">Aman</span>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Total Returned History -->
                <div class="bg-white p-5 rounded-2xl border border-blue-100 shadow-[0_2px_12px_rgba(37,99,235,0.04)] card-hover flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Riwayat Pengembalian</span>
                            <span class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center border border-emerald-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </span>
                        </div>
                        <div class="mt-3">
                            <span class="text-3xl font-black text-emerald-600 font-mono"><?php echo number_format((float)($myReturnedCount ?? 0), 0, ',', '.'); ?></span>
                            <span class="text-xs text-slate-500 font-medium ml-1">Unit Selesai</span>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                        <span class="text-slate-400">Total: <?php echo number_format((float)($myTotalLoansCount ?? 0), 0, ',', '.'); ?> Pengajuan</span>
                        <a href="<?php echo e(route('loans.index')); ?>" class="text-emerald-700 font-bold hover:underline">Riwayat &rarr;</a>
                    </div>
                </div>
            </div>

            <!-- 3. CURRENT BORROWED ITEMS SECTION -->
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-[0_2px_12px_rgba(37,99,235,0.03)] overflow-hidden">
                <div class="p-4 sm:p-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                    <div class="flex items-center gap-2.5">
                        <span class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shadow-2xs border border-blue-100">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </span>
                        <div>
                            <h2 class="text-sm font-bold text-slate-900">Barang yang Sedang Anda Pinjam</h2>
                            <p class="text-xs text-slate-500">Daftar sarpras sekolah yang saat ini sedang berada dalam tanggung jawab pemakaian Anda.</p>
                        </div>
                    </div>
                    <a href="<?php echo e(route('loans.index')); ?>" class="text-xs font-bold text-blue-600 hover:text-blue-700 active:scale-95 transition">
                        Riwayat Lengkap &rarr;
                    </a>
                </div>

                <?php if($myActiveLoans->concat($myLateLoans)->count() > 0): ?>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs text-slate-600">
                            <thead class="bg-slate-50/70 text-[11px] uppercase tracking-wider text-slate-500 border-b border-slate-200">
                                <tr>
                                    <th class="py-3 px-4">Nama Sarpras & Lokasi</th>
                                    <th class="py-3 px-4 text-center">Jumlah</th>
                                    <th class="py-3 px-4">Tanggal Pinjam</th>
                                    <th class="py-3 px-4">Batas Pengembalian</th>
                                    <th class="py-3 px-4 text-center">Status</th>
                                    <th class="py-3 px-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <?php $__currentLoopData = $myActiveLoans->concat($myLateLoans); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="row-hover">
                                        <td class="py-3.5 px-4">
                                            <div class="font-bold text-slate-900"><?php echo e($loan->item->name); ?></div>
                                            <div class="text-[10px] text-slate-400 font-mono mt-0.5">
                                                <?php echo e($loan->item->code); ?> &bull; <?php echo e($loan->item->location ?? 'Gudang Sarpras'); ?>

                                            </div>
                                        </td>
                                        <td class="py-3.5 px-4 text-center font-mono font-black text-slate-900">
                                            <?php echo number_format((float)($loan->quantity ?? 0), 0, ',', '.'); ?> Unit
                                        </td>
                                        <td class="py-3.5 px-4 text-slate-700">
                                            <?php echo $loan->loan_date ? \Carbon\Carbon::parse($loan->loan_date)->locale('id')->translatedFormat('j M Y') : '-'; ?>
                                        </td>
                                        <td class="py-3.5 px-4 font-semibold <?php echo e($loan->status === 'terlambat' ? 'text-rose-600' : 'text-slate-700'); ?>">
                                            <?php echo $loan->due_date ? \Carbon\Carbon::parse($loan->due_date)->locale('id')->translatedFormat('j M Y') : '-'; ?>
                                        </td>
                                        <td class="py-3.5 px-4 text-center">
                                            <?php if($loan->status === 'terlambat'): ?>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                                    Terlambat
                                                </span>
                                            <?php else: ?>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                                    Dipinjam
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="py-3.5 px-4 text-right">
                                            <a href="<?php echo e(route('loans.show', $loan)); ?>" class="inline-flex items-center px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-xl font-bold text-xs transition active:scale-95 shadow-2xs">
                                                Bukti Pinjam
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <!-- Clean & Inspiring Empty State -->
                    <div class="p-8 text-center">
                        <div class="w-16 h-16 rounded-3xl bg-emerald-50 text-emerald-600 mx-auto flex items-center justify-center border border-emerald-100/80 mb-3 shadow-xs">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-sm font-bold text-slate-800">Tidak Ada Tanggungan Peminjaman</h3>
                        <p class="text-xs text-slate-500 max-w-md mx-auto mt-1">
                            Saat ini Anda tidak memiliki barang yang sedang dipinjam. Semua sarpras telah terselesaikan dengan tertib.
                        </p>
                        <div class="mt-4">
                            <a href="<?php echo e(route('loans.create')); ?>" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs shadow-md shadow-blue-500/20 active:scale-95 transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Ajukan Pinjam Baru
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- 4. SARPRAS READY TO BORROW (SHOWCASE GRID) -->
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-[0_2px_12px_rgba(37,99,235,0.03)] p-5 sm:p-6">
                <div class="flex items-center justify-between mb-5">
                    <div class="flex items-center gap-2.5">
                        <span class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shadow-2xs border border-emerald-100">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                        </span>
                        <div>
                            <h2 class="text-sm font-bold text-slate-900">Sarpras Tersedia untuk Dipinjam</h2>
                            <p class="text-xs text-slate-500">Peralatan multimedia, lab kejuruan, dan sarana praktik siap digunakan.</p>
                        </div>
                    </div>
                    <a href="<?php echo e(route('items.index')); ?>" class="text-xs font-bold text-blue-600 hover:underline active:scale-95 transition">
                        Buka Semua Katalog &rarr;
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <?php $__empty_1 = true; $__currentLoopData = $availableItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="border border-blue-100/90 rounded-2xl p-4 flex flex-col justify-between hover:border-blue-300 card-hover bg-gradient-to-b from-white via-sky-50/15 to-blue-50/25">
                            <div>
                                <div class="flex items-center justify-between text-[11px] text-slate-500 mb-1.5">
                                    <span class="px-2 py-0.5 rounded-md bg-blue-50 text-blue-700 font-bold text-[10px] uppercase tracking-wide border border-blue-100">
                                        <?php echo e($item->category->name); ?>

                                    </span>
                                    <span class="font-mono font-bold text-slate-600 text-[10px]"><?php echo e($item->code); ?></span>
                                </div>
                                <h3 class="font-bold text-slate-900 text-xs leading-snug"><?php echo e($item->name); ?></h3>
                                <p class="text-[11px] text-slate-500 mt-1 flex items-center gap-1">
                                    <svg class="w-3 h-3 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="truncate"><?php echo e($item->location ?? 'Gudang Sarpras'); ?></span>
                                </p>
                            </div>
                            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                                <span class="inline-flex items-center gap-1.5 font-bold text-emerald-700 font-mono bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200/60 text-[11px]">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    <?php echo number_format((float)($item->stock ?? 0), 0, ',', '.'); ?> Unit Tersedia
                                </span>
                                <a href="<?php echo e(route('loans.create', ['item_id' => $item->id])); ?>" class="inline-flex items-center gap-1 font-bold text-blue-600 hover:text-blue-700 bg-white hover:bg-blue-50 border border-blue-200/80 px-2.5 py-1 rounded-xl active:scale-95 transition shadow-2xs">
                                    <span>Pinjam</span>
                                    <span class="text-xs">&rarr;</span>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-span-3 text-center py-6 text-slate-400 text-xs">
                            Belum ada inventaris yang tersedia untuk dipinjam saat ini.
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- 5. THREE STEPS BORROWING PROCEDURE (SCHOOL STANDARD) -->
            <div class="rounded-3xl bg-gradient-to-br from-blue-50/80 via-sky-50/40 to-white border border-blue-200/80 p-6 sm:p-7 shadow-xs relative overflow-hidden">
                <div class="relative z-10">
                    <div class="flex items-center gap-2.5 mb-4">
                        <span class="w-8 h-8 rounded-xl bg-blue-100/80 text-blue-700 flex items-center justify-center text-xs border border-blue-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                        <div>
                            <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">
                                Alur Standar Operasional Peminjaman Sarpras SMKN 1 Ketapang
                            </h3>
                            <p class="text-[11px] text-slate-500">Prosedur tertib peminjaman barang inventaris sekolah</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="bg-white border border-blue-100 rounded-2xl p-4 shadow-2xs hover:border-blue-300 transition-colors">
                            <span class="text-blue-600 font-mono font-black text-xl">01</span>
                            <h4 class="text-xs font-bold text-slate-900 mt-1">Pilih Sarpras & Ajukan</h4>
                            <p class="text-[11px] text-slate-500 mt-1 leading-relaxed">
                                Pilih barang yang dibutuhkan dari katalog dan tentukan tanggal rencana pengembalian.
                            </p>
                        </div>
                        <div class="bg-white border border-emerald-100 rounded-2xl p-4 shadow-2xs hover:border-emerald-300 transition-colors">
                            <span class="text-emerald-600 font-mono font-black text-xl">02</span>
                            <h4 class="text-xs font-bold text-slate-900 mt-1">Serah Terima Fisik</h4>
                            <p class="text-[11px] text-slate-500 mt-1 leading-relaxed">
                                Tunjukkan bukti pengajuan di ruang Sarana Prasarana untuk verifikasi dan serah terima unit.
                            </p>
                        </div>
                        <div class="bg-white border border-amber-100 rounded-2xl p-4 shadow-2xs hover:border-amber-300 transition-colors">
                            <span class="text-amber-600 font-mono font-black text-xl">03</span>
                            <h4 class="text-xs font-bold text-slate-900 mt-1">Kembalikan Tepat Waktu</h4>
                            <p class="text-[11px] text-slate-500 mt-1 leading-relaxed">
                                Kembalikan sarpras sebelum jatuh tempo dalam kondisi bersih dan berfungsi baik.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Inventarisku\resources\views/dashboard.blade.php ENDPATH**/ ?>