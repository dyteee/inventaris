import './bootstrap';

import Alpine from 'alpinejs';
import QRCode from 'qrcode';

window.Alpine = Alpine;
window.QRCode = QRCode;

/**
 * 1. Web Audio API Success Chime (Soft tactile audio feedback)
 */
window.playSuccessChime = function () {
    try {
        const AudioContext = window.AudioContext || window.webkitAudioContext;
        if (!AudioContext) return;
        const ctx = new AudioContext();

        const now = ctx.currentTime;
        const osc1 = ctx.createOscillator();
        const osc2 = ctx.createOscillator();
        const gainNode = ctx.createGain();

        osc1.type = 'sine';
        osc2.type = 'triangle';

        // Lembut nada C5 (523Hz) naik ke G5 (784Hz)
        osc1.frequency.setValueAtTime(523.25, now);
        osc1.frequency.exponentialRampToValueAtTime(783.99, now + 0.12);

        osc2.frequency.setValueAtTime(523.25, now);
        osc2.frequency.exponentialRampToValueAtTime(1046.50, now + 0.14);

        gainNode.gain.setValueAtTime(0.08, now);
        gainNode.gain.exponentialRampToValueAtTime(0.001, now + 0.35);

        osc1.connect(gainNode);
        osc2.connect(gainNode);
        gainNode.connect(ctx.destination);

        osc1.start(now);
        osc2.start(now);
        osc1.stop(now + 0.35);
        osc2.stop(now + 0.35);
    } catch {
        // Abaikan jika browser tidak mengizinkan autoplay audio
    }
};

/**
 * 2. Helper Global untuk Memanggil Pop-up Sukses dari Mana Saja
 */
window.showSuccessPopup = function (message, title = 'Berhasil!') {
    window.dispatchEvent(new CustomEvent('notify-success', {
        detail: { message, title }
    }));
};

/**
 * 3. Helper Global untuk Modal Konfirmasi
 */
window.confirmAction = function ({ title, message, confirmText, cancelText, isDanger, onConfirm }) {
    window.dispatchEvent(new CustomEvent('open-confirm-modal', {
        detail: {
            title: title || 'Konfirmasi Tindakan',
            message: message || 'Apakah Anda yakin ingin memproses tindakan ini?',
            confirmText: confirmText || 'Ya, Lanjutkan',
            cancelText: cancelText || 'Batalkan',
            isDanger: isDanger !== false,
            callback: onConfirm
        }
    }));
};

/**
 * 4. Efek Ripple Animasi Klik Lembut
 */
function initRippleEffect() {
    document.addEventListener('click', (e) => {
        const btn = e.target.closest('button, input[type="submit"], input[type="button"], a.btn-action, .clickable, .ripple');
        if (!btn || btn.classList.contains('no-ripple')) return;

        const rect = btn.getBoundingClientRect();
        const ripple = document.createElement('span');
        ripple.classList.add('ripple-wave');

        const size = Math.max(rect.width, rect.height) * 2;
        ripple.style.width = ripple.style.height = `${size}px`;
        ripple.style.left = `${e.clientX - rect.left - size / 2}px`;
        ripple.style.top = `${e.clientY - rect.top - size / 2}px`;

        const computedPosition = window.getComputedStyle(btn).position;
        if (computedPosition === 'static') {
            btn.style.position = 'relative';
        }
        btn.style.overflow = 'hidden';

        btn.appendChild(ripple);
        setTimeout(() => ripple.remove(), 600);
    });
}

/**
 * 5. Indikator Loading Transisi Halaman (Ultra Slim Top Glow Bar)
 */
function initPageLoader() {
    const loader = document.createElement('div');
    loader.id = 'page-top-loader';
    loader.className = 'fixed top-0 left-0 h-[2.5px] bg-gradient-to-r from-blue-600 via-sky-400 to-indigo-600 shadow-[0_0_8px_rgba(59,130,246,0.6)] z-[9999] opacity-0 transition-all duration-200 pointer-events-none';
    loader.style.width = '0%';
    document.body.appendChild(loader);

    let loadTimeout = null;

    function startLoader() {
        if (loadTimeout) clearTimeout(loadTimeout);
        loadTimeout = setTimeout(() => {
            loader.style.opacity = '1';
            loader.style.width = '30%';
            setTimeout(() => { loader.style.width = '70%'; }, 200);
            setTimeout(() => { loader.style.width = '90%'; }, 500);
        }, 30);
    }

    // Tangani klik tautan navigasi internal
    document.addEventListener('click', (e) => {
        const link = e.target.closest('a[href]:not([target="_blank"]):not([href^="#"]):not([href^="javascript:"])');
        if (!link) return;
        if (e.ctrlKey || e.metaKey || e.shiftKey || e.defaultPrevented) return;

        const onclick = link.getAttribute('onclick') || '';
        if (onclick.includes('preventDefault')) return;

        const href = link.getAttribute('href');
        if (href && (href.startsWith('/') || href.startsWith(window.location.origin))) {
            startLoader();
        }
    });

    // Tangani submit form yang tidak dicegah
    document.addEventListener('submit', (e) => {
        if (e.defaultPrevented) return;
        const form = e.target;
        if (!form.hasAttribute('target')) {
            startLoader();
        }
    });

    // Reset saat halaman selesai dimuat
    window.addEventListener('pageshow', () => {
        if (loadTimeout) clearTimeout(loadTimeout);
        loader.style.width = '100%';
        setTimeout(() => {
            loader.style.opacity = '0';
            setTimeout(() => { loader.style.width = '0%'; }, 150);
        }, 120);
    });
}

/**
 * 6. Global Interceptor untuk onsubmit="return confirm(...)"
 * Mengubah confirm bawaan browser menjadi Modal Pop-up Smooth
 */
function initGlobalConfirmInterceptor() {
    document.addEventListener('submit', (e) => {
        const form = e.target;

        // Jika form sudah dikonfirmasi melalui modal kita, izinkan submit lanjut
        if (form.dataset.confirmed === 'true') {
            return;
        }

        // Cek apakah form memiliki data-confirm atau inline onsubmit dengan confirm
        const onsubmitAttr = form.getAttribute('onsubmit') || '';
        const dataConfirm = form.dataset.confirm;

        let message = '';
        if (dataConfirm) {
            message = dataConfirm;
        } else if (onsubmitAttr.includes('confirm(')) {
            // Ekstrak pesan dari confirm('...')
            const match = onsubmitAttr.match(/confirm\(['"]([^'"]+)['"]\)/);
            if (match && match[1]) {
                message = match[1];
            } else {
                message = 'Apakah Anda yakin ingin memproses tindakan ini?';
            }
        }

        if (message) {
            e.preventDefault();
            e.stopImmediatePropagation();

            window.dispatchEvent(new CustomEvent('open-confirm-modal', {
                detail: {
                    title: 'Konfirmasi Penghapusan',
                    message: message,
                    confirmText: 'Ya, Hapus Sekarang',
                    cancelText: 'Batalkan',
                    isDanger: true,
                    form: form
                }
            }));
            return false;
        }
    }, true);
}

// Inisialisasi saat DOM siap
document.addEventListener('DOMContentLoaded', () => {
    initRippleEffect();
    initPageLoader();
    initGlobalConfirmInterceptor();
});

Alpine.start();
