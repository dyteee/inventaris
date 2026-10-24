<?php
    $user = Auth::user();
    $isAdmin = $user && $user->isAdmin();
?>

<!-- SIDEBAR COMPONENT -->
<aside 
    class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-slate-200/90 shadow-[2px_0_12px_rgba(30,41,59,0.04)] flex flex-col justify-between transition-transform duration-300 ease-in-out lg:translate-x-0"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    x-cloak
>
    <!-- Top Branding & Header -->
    <div class="h-16 px-4 flex items-center justify-between border-b border-slate-100 bg-white/80 backdrop-blur-sm">
        <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center gap-2.5 group">
            <div class="w-10 h-10 rounded-xl overflow-hidden bg-white shadow-xs border border-slate-100 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform duration-200 p-0.5">
                <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Logo SMKN 1 Ketapang" class="w-full h-full object-contain rounded-lg">
            </div>
            <div class="flex flex-col">
                <span class="font-bold text-slate-800 text-sm tracking-tight leading-none group-hover:text-blue-600 transition-colors">SMKN 1 KETAPANG</span>
                <span class="text-[10px] text-blue-600 font-semibold tracking-wider uppercase mt-1">SIM Inventaris Sarpras</span>
            </div>
        </a>

        <!-- Mobile Close Button (Visible only on < lg) -->
        <button 
            type="button" 
            @click="sidebarOpen = false" 
            class="lg:hidden p-1.5 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-100 focus:outline-none transition"
            aria-label="Tutup Sidebar"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- User Capsule Card in Sidebar -->
    <div class="p-3 mx-3 mt-3 rounded-xl bg-gradient-to-r from-slate-50 to-blue-50/40 border border-slate-100 flex items-center gap-3">
        <div class="w-9 h-9 rounded-xl <?php echo e($isAdmin ? 'bg-blue-600 text-white shadow-sm shadow-blue-500/20' : 'bg-emerald-600 text-white shadow-sm shadow-emerald-500/20'); ?> flex items-center justify-center text-xs font-bold shrink-0">
            <?php echo e(strtoupper(substr($user?->name ?? 'User', 0, 2))); ?>

        </div>
        <div class="min-w-0 flex-1">
            <p class="text-xs font-bold text-slate-800 truncate leading-tight"><?php echo e($user?->name ?? 'Pengguna'); ?></p>
            <div class="flex items-center gap-1.5 mt-0.5">
                <span class="w-1.5 h-1.5 rounded-full <?php echo e($isAdmin ? 'bg-blue-500' : 'bg-emerald-500'); ?>"></span>
                <span class="text-[10px] font-semibold uppercase tracking-wider <?php echo e($isAdmin ? 'text-blue-600' : 'text-emerald-600'); ?>">
                    <?php echo e($isAdmin ? 'Administrator' : 'Peminjam'); ?>

                </span>
            </div>
        </div>
    </div>

    <!-- Scrollable Navigation Links -->
    <div class="flex-1 overflow-y-auto px-3 py-3 space-y-4 custom-scrollbar">
        <!-- MENU UTAMA -->
        <div>
            <div class="px-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">
                Menu Utama
            </div>
            <a 
                href="<?php echo e(route('dashboard')); ?>" 
                class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all group <?php echo e(request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-sm shadow-blue-500/25' : 'text-slate-600 hover:text-blue-600 hover:bg-blue-50/70'); ?>"
            >
                <svg class="w-4 h-4 shrink-0 transition-colors <?php echo e(request()->routeIs('dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-blue-600'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                <span>Dashboard</span>
            </a>
        </div>

        <!-- SARANA & PRASARANA -->
        <div>
            <div class="px-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">
                Sarana & Prasarana
            </div>
            <div class="space-y-0.5">
                <a 
                    href="<?php echo e(route('items.index')); ?>" 
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all group <?php echo e(request()->routeIs('items.*') ? 'bg-blue-600 text-white shadow-sm shadow-blue-500/25' : 'text-slate-600 hover:text-blue-600 hover:bg-blue-50/70'); ?>"
                >
                    <svg class="w-4 h-4 shrink-0 transition-colors <?php echo e(request()->routeIs('items.*') ? 'text-white' : 'text-slate-400 group-hover:text-blue-600'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <span><?php echo e($isAdmin ? 'Data Barang (Aset)' : 'Katalog Sarpras'); ?></span>
                </a>

                <?php if($isAdmin): ?>
                    <a 
                        href="<?php echo e(route('categories.index')); ?>" 
                        class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all group <?php echo e(request()->routeIs('categories.*') ? 'bg-blue-600 text-white shadow-sm shadow-blue-500/25' : 'text-slate-600 hover:text-blue-600 hover:bg-blue-50/70'); ?>"
                    >
                        <svg class="w-4 h-4 shrink-0 transition-colors <?php echo e(request()->routeIs('categories.*') ? 'text-white' : 'text-slate-400 group-hover:text-blue-600'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        <span>Kategori Barang</span>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- SIRKULASI & TRANSAKSI -->
        <div>
            <div class="px-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">
                Sirkulasi & Transaksi
            </div>
            <div class="space-y-0.5">
                <a 
                    href="<?php echo e(route('loans.index')); ?>" 
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all group <?php echo e(request()->routeIs('loans.*') ? 'bg-blue-600 text-white shadow-sm shadow-blue-500/25' : 'text-slate-600 hover:text-blue-600 hover:bg-blue-50/70'); ?>"
                >
                    <svg class="w-4 h-4 shrink-0 transition-colors <?php echo e(request()->routeIs('loans.*') ? 'text-white' : 'text-slate-400 group-hover:text-blue-600'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    <span><?php echo e($isAdmin ? 'Data Peminjaman' : 'Peminjaman Saya'); ?></span>
                </a>

                <a 
                    href="<?php echo e(route('return_logs.index')); ?>" 
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all group <?php echo e(request()->routeIs('return_logs.*') ? 'bg-blue-600 text-white shadow-sm shadow-blue-500/25' : 'text-slate-600 hover:text-blue-600 hover:bg-blue-50/70'); ?>"
                >
                    <svg class="w-4 h-4 shrink-0 transition-colors <?php echo e(request()->routeIs('return_logs.*') ? 'text-white' : 'text-slate-400 group-hover:text-blue-600'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span><?php echo e($isAdmin ? 'Log Pengembalian' : 'Riwayat Kembali'); ?></span>
                </a>
            </div>
        </div>

        <?php if($isAdmin): ?>
            <!-- FITUR PENGELOLA & SISTEM -->
            <div>
                <div class="px-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">
                    Fitur Pengelola & Sistem
                </div>
                <div class="space-y-0.5">

                    <a 
                        href="<?php echo e(route('reports.index')); ?>" 
                        class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all group <?php echo e(request()->routeIs('reports.*') ? 'bg-blue-600 text-white shadow-sm shadow-blue-500/25' : 'text-slate-600 hover:text-blue-600 hover:bg-blue-50/70'); ?>"
                    >
                        <svg class="w-4 h-4 shrink-0 transition-colors <?php echo e(request()->routeIs('reports.*') ? 'text-white' : 'text-slate-400 group-hover:text-blue-600'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Laporan Resmi</span>
                    </a>

                    <a 
                        href="<?php echo e(route('activity_logs.index')); ?>" 
                        class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all group <?php echo e(request()->routeIs('activity_logs.*') ? 'bg-blue-600 text-white shadow-sm shadow-blue-500/25' : 'text-slate-600 hover:text-blue-600 hover:bg-blue-50/70'); ?>"
                    >
                        <svg class="w-4 h-4 shrink-0 transition-colors <?php echo e(request()->routeIs('activity_logs.*') ? 'text-white' : 'text-slate-400 group-hover:text-blue-600'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Log Aktivitas (Audit)</span>
                    </a>

                    <a 
                        href="<?php echo e(route('users.index')); ?>" 
                        class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all group <?php echo e(request()->routeIs('users.*') ? 'bg-blue-600 text-white shadow-sm shadow-blue-500/25' : 'text-slate-600 hover:text-blue-600 hover:bg-blue-50/70'); ?>"
                    >
                        <svg class="w-4 h-4 shrink-0 transition-colors <?php echo e(request()->routeIs('users.*') ? 'text-white' : 'text-slate-400 group-hover:text-blue-600'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span>Manajemen Pengguna</span>
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Sidebar Footer & Logout -->
    <div class="p-3 border-t border-slate-100 bg-slate-50/70 space-y-1">
        <a 
            href="<?php echo e(route('profile.edit')); ?>" 
            class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-semibold text-slate-600 hover:text-blue-600 hover:bg-white transition-all shadow-xs"
        >
            <span class="flex items-center gap-2.5">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>Profil Saya</span>
            </span>
            <span class="text-[10px] text-slate-400">&rsaquo;</span>
        </a>

        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button 
                type="submit" 
                class="w-full flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs font-semibold text-rose-600 hover:bg-rose-50 hover:text-rose-700 transition-all active:scale-95 text-left"
            >
                <svg class="w-4 h-4 text-rose-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span>Keluar (Log Out)</span>
            </button>
        </form>

        <div class="pt-2 px-1 flex items-center justify-between text-[10px] text-slate-400 border-t border-slate-200/50">
            <span>SIM Sarpras Sekolah</span>
            <span class="inline-flex items-center gap-1 text-emerald-600 font-medium">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Online
            </span>
        </div>
    </div>
</aside>
<?php /**PATH C:\xampp\htdocs\Inventarisku\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>