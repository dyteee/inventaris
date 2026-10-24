<div 
    x-data="{
        isOpen: false,
        title: 'Konfirmasi Tindakan',
        message: 'Apakah Anda yakin ingin memproses tindakan ini?',
        confirmText: 'Ya, Lanjutkan',
        cancelText: 'Batalkan',
        targetForm: null,
        callback: null,
        isDanger: true,
        init() {
            window.addEventListener('open-confirm-modal', (e) => {
                this.title = e.detail?.title || 'Konfirmasi Penghapusan';
                this.message = e.detail?.message || 'Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.';
                this.confirmText = e.detail?.confirmText || 'Ya, Hapus Sekarang';
                this.cancelText = e.detail?.cancelText || 'Batalkan';
                this.targetForm = e.detail?.form || null;
                this.callback = e.detail?.callback || null;
                this.isDanger = e.detail?.isDanger !== false;
                this.isOpen = true;
            });
        },
        confirm() {
            this.isOpen = false;
            if (this.targetForm) {
                // Tandai form agar bypass konfirmasi loop
                this.targetForm.dataset.confirmed = 'true';
                if (typeof this.targetForm.requestSubmit === 'function') {
                    this.targetForm.requestSubmit();
                } else {
                    this.targetForm.submit();
                }
            } else if (typeof this.callback === 'function') {
                this.callback();
            }
        },
        cancel() {
            this.isOpen = false;
            this.targetForm = null;
            this.callback = null;
        }
    }"
    x-show="isOpen"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    class="fixed inset-0 z-[998] flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-xs"
    style="display: none;"
    x-cloak
    @keydown.escape.window="cancel()"
>
    <!-- Modal Box -->
    <div 
        @click.outside="cancel()"
        class="bg-white rounded-2xl shadow-2xl shadow-slate-900/20 border border-slate-100 max-w-sm w-full overflow-hidden relative"
    >
        <div class="h-1.5" :class="isDanger ? 'bg-gradient-to-r from-rose-500 to-amber-500' : 'bg-gradient-to-r from-blue-500 to-sky-500'"></div>

        <div class="p-6 text-center">
            <!-- Icon with pulse -->
            <div 
                class="mx-auto w-14 h-14 rounded-2xl flex items-center justify-center relative mb-4"
                :class="isDanger ? 'bg-rose-50 border border-rose-100 text-rose-600' : 'bg-blue-50 border border-blue-100 text-blue-600'"
            >
                <div 
                    class="absolute inset-0 rounded-2xl blur-md animate-pulse opacity-40"
                    :class="isDanger ? 'bg-rose-400' : 'bg-blue-400'"
                ></div>
                <template x-if="isDanger">
                    <svg class="w-7 h-7 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </template>
                <template x-if="!isDanger">
                    <svg class="w-7 h-7 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </template>
            </div>

            <!-- Title & Message -->
            <h3 class="text-base font-bold text-slate-900 tracking-tight" x-text="title">Konfirmasi Penghapusan</h3>
            <p class="text-xs text-slate-600 mt-2 leading-relaxed px-2" x-text="message">
                Apakah Anda yakin ingin memproses data ini?
            </p>

            <!-- Buttons -->
            <div class="mt-6 flex items-center gap-2.5">
                <button 
                    type="button" 
                    @click="cancel()" 
                    class="flex-1 py-2.5 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs active:scale-95 transition-all duration-150"
                    x-text="cancelText"
                >
                    Batalkan
                </button>
                <button 
                    type="button" 
                    @click="confirm()" 
                    class="flex-1 py-2.5 px-3 rounded-xl text-white font-semibold text-xs shadow-md active:scale-95 transition-all duration-150"
                    :class="isDanger ? 'bg-rose-600 hover:bg-rose-700 shadow-rose-500/20' : 'bg-blue-600 hover:bg-blue-700 shadow-blue-500/20'"
                    x-text="confirmText"
                >
                    Ya, Lanjutkan
                </button>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Inventarisku\resources\views/components/custom-confirm-modal.blade.php ENDPATH**/ ?>