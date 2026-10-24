@props([
    'initialMessage' => session('success') ?? null,
    'initialTitle' => 'Berhasil!'
])

<div 
    x-data="{
        show: false,
        title: '{{ $initialTitle }}',
        message: '{{ addslashes($initialMessage ?? '') }}',
        progress: 100,
        timer: null,
        progressInterval: null,
        duration: 4000,
        init() {
            @if(session('success'))
                this.trigger('{{ addslashes(session('success')) }}', 'Berhasil!');
            @elseif(session('status') === 'profile-updated')
                this.trigger('Informasi profil akun Anda berhasil diperbarui.', 'Profil Diperbarui!');
            @elseif(session('status') === 'password-updated')
                this.trigger('Kata sandi akun Anda berhasil diperbarui dengan aman.', 'Kata Sandi Diperbarui!');
            @endif

            window.addEventListener('notify-success', (e) => {
                const msg = e.detail?.message || 'Tindakan berhasil diselesaikan.';
                const ttl = e.detail?.title || 'Berhasil!';
                this.trigger(msg, ttl);
            });
        },
        trigger(msg, ttl = 'Berhasil!') {
            this.message = msg;
            this.title = ttl;
            this.show = true;
            this.progress = 100;

            // Mainkan suara chime lembut jika diizinkan browser
            if (window.playSuccessChime) {
                window.playSuccessChime();
            }

            // Reset timers
            if (this.timer) clearTimeout(this.timer);
            if (this.progressInterval) clearInterval(this.progressInterval);

            const stepTime = 40;
            const stepPercent = (stepTime / this.duration) * 100;

            this.progressInterval = setInterval(() => {
                this.progress = Math.max(0, this.progress - stepPercent);
            }, stepTime);

            this.timer = setTimeout(() => {
                this.close();
            }, this.duration);
        },
        close() {
            this.show = false;
            if (this.timer) clearTimeout(this.timer);
            if (this.progressInterval) clearInterval(this.progressInterval);
        }
    }"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-[-20px] scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
    x-transition:leave-end="opacity-0 translate-y-[-10px] scale-95"
    class="fixed inset-0 z-[999] flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-xs"
    style="display: none;"
    x-cloak
    @keydown.escape.window="close()"
>
    <!-- Modal Dialog Card -->
    <div 
        @click.outside="close()"
        class="bg-white rounded-2xl shadow-2xl shadow-emerald-900/20 border border-emerald-100/80 max-w-md w-full overflow-hidden relative transform transition-all"
    >
        <!-- Ambient Glowing Header Light -->
        <div class="h-2 bg-gradient-to-r from-emerald-400 via-teal-400 to-emerald-500"></div>

        <div class="p-6 text-center">
            <!-- Animated SVG Checkmark Icon -->
            <div class="mx-auto w-16 h-16 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center justify-center relative shadow-inner mb-4">
                <div class="absolute inset-0 rounded-2xl bg-emerald-400/20 blur-md animate-pulse"></div>
                <svg class="w-10 h-10 text-emerald-500 relative z-10" viewBox="0 0 52 52">
                    <circle class="checkmark-circle" cx="26" cy="26" r="23" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round"/>
                    <path class="checkmark-check" fill="none" stroke="currentColor" stroke-width="3.8" stroke-linecap="round" stroke-linejoin="round" d="M14 27l8 8 16-16"/>
                </svg>
            </div>

            <!-- Title & Message -->
            <h3 class="text-lg font-bold text-slate-900 tracking-tight" x-text="title">Berhasil!</h3>
            <p class="text-xs text-slate-600 mt-2 leading-relaxed px-2" x-text="message">
                Operasi sistem telah berhasil disimpan.
            </p>

            <!-- Action Button -->
            <div class="mt-6">
                <button 
                    type="button" 
                    @click="close()" 
                    class="w-full py-2.5 px-4 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-semibold text-xs shadow-md shadow-emerald-500/20 active:scale-95 transition-all duration-150 flex items-center justify-center gap-1.5"
                >
                    <span>Selesai & Lanjutkan</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Animated Countdown Progress Bar -->
        <div class="w-full h-1 bg-slate-100 overflow-hidden">
            <div 
                class="h-full bg-emerald-500 transition-all duration-75 ease-linear"
                :style="'width: ' + progress + '%'"
            ></div>
        </div>
    </div>
</div>
