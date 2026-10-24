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
        <nav class="text-xs text-slate-400 mb-1 flex items-center gap-1.5">
            <a href="<?php echo e(route('dashboard')); ?>" class="hover:text-blue-600 transition">Dashboard</a>
            <span>&rsaquo;</span>
            <span class="text-slate-700 font-medium">Audit Trail</span>
        </nav>
        <div class="flex items-center gap-3">
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Audit Trail & Rekam Jejak Sistem</h1>
            <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200/80">
                <?php echo e(($activityLogs ?? $logs)->total()); ?> Log Dicatat
            </span>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="space-y-4">
        <!-- Filter Bar -->
        <div class="bg-white p-4 rounded-xl border border-blue-100/80 shadow-[0_2px_10px_rgba(37,99,235,0.03)]">
            <form method="GET" action="<?php echo e(route('activity_logs.index')); ?>" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3">
                <!-- Search -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Cari Keterangan</label>
                    <input 
                        type="text" 
                        name="search" 
                        value="<?php echo e($search); ?>" 
                        placeholder="Deskripsi aktivitas..." 
                        class="w-full text-xs rounded-lg border-slate-200 shadow-xs focus:border-blue-500 focus:ring-2 focus:ring-blue-400/20 transition"
                    >
                </div>

                <!-- User Filter -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Pelaksana Aksi</label>
                    <select name="user_id" class="w-full text-xs rounded-lg border-slate-200 shadow-xs focus:border-blue-500 focus:ring-2 focus:ring-blue-400/20 transition">
                        <option value="">Semua Pelaksana</option>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($u->id); ?>" <?php echo e($userId == $u->id ? 'selected' : ''); ?>>
                                <?php echo e($u->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <!-- Action Filter -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Jenis Operasi</label>
                    <select name="action" class="w-full text-xs rounded-lg border-slate-200 shadow-xs focus:border-blue-500 focus:ring-2 focus:ring-blue-400/20 transition">
                        <option value="">Semua Operasi</option>
                        <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($act); ?>" <?php echo e($action === $act ? 'selected' : ''); ?>>
                                <?php echo e(strtoupper(str_replace('_', ' ', $act))); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <!-- Submit / Reset -->
                <div class="flex items-end gap-1.5">
                    <button type="submit" class="flex-1 py-2 bg-blue-600 text-white rounded-lg text-xs font-semibold hover:bg-blue-500 shadow-sm shadow-blue-500/20 transition-all active:scale-95 h-[35px]">
                        Terapkan Filter
                    </button>
                    <?php if($search || $userId || $action): ?>
                        <a href="<?php echo e(route('activity_logs.index')); ?>" title="Reset Filter" class="px-2.5 py-2 bg-slate-100 hover:bg-blue-50 text-slate-600 hover:text-blue-600 rounded-lg text-xs font-bold transition-all active:scale-95 h-[35px] flex items-center">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <!-- Logs Table -->
        <div class="bg-white rounded-xl border border-slate-200/90 shadow-[0_2px_12px_rgba(37,99,235,0.03)] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-slate-50/70 text-[11px] uppercase tracking-wider text-slate-500 border-b border-slate-200">
                        <tr>
                            <th class="py-3 px-3.5 w-14 text-center">No</th>
                            <th class="py-3 px-3.5">Waktu Eksekusi</th>
                            <th class="py-3 px-3.5">Pengguna</th>
                            <th class="py-3 px-3.5">Aksi / Operasi</th>
                            <th class="py-3 px-3.5">Rincian Deskripsi Log</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php $__empty_1 = true; $__currentLoopData = $activityLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="row-hover">
                                <td class="py-3 px-3.5 text-center text-slate-400 font-mono">
                                    <?php echo e($activityLogs->firstItem() + $index); ?>

                                </td>
                                <td class="py-3 px-3.5 text-slate-700 font-mono whitespace-nowrap">
                                    <?php echo $log->created_at ? \Carbon\Carbon::parse($log->created_at)->locale('id')->translatedFormat('j M Y H:i') : '-'; ?>
                                </td>
                                <td class="py-3 px-3.5 font-semibold text-slate-900 whitespace-nowrap">
                                    <?php echo e($log->user->name ?? 'Sistem Otomatis'); ?>

                                </td>
                                <td class="py-3 px-3.5 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-blue-50 text-blue-700 border border-blue-200/70">
                                        <?php echo e(str_replace('_', ' ', $log->action)); ?>

                                    </span>
                                </td>
                                <td class="py-3 px-3.5 text-slate-700 leading-relaxed">
                                    <?php echo e($log->description); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="py-10 text-center text-slate-400">
                                    Tidak ada catatan log aktivitas yang ditemukan.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if($activityLogs->hasPages()): ?>
                <div class="p-3.5 border-t border-slate-100 bg-slate-50/50">
                    <?php echo e($activityLogs->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
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
<?php /**PATH C:\xampp\htdocs\Inventarisku\resources\views/activity_logs/index.blade.php ENDPATH**/ ?>