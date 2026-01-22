/**
 * EventEase Core Engine
 * Professional Luxury Edition - 2026
 * Fixed: Form submission compatibility with PHP MySQL
 */

document.addEventListener('DOMContentLoaded', () => {

    // --- 1. LOGIKA PRELOADER ---
    const loader = document.getElementById('loader');
    const loaderText = document.getElementById('loader-text');
    const loaderBar = document.getElementById('loader-bar');

    if (loader) {
        setTimeout(() => {
            if (loaderText) loaderText.style.transform = 'translateY(0)';
            if (loaderBar) loaderBar.style.width = '100%';
        }, 100);

        window.addEventListener('load', () => {
            setTimeout(() => {
                loader.style.opacity = '0';
                loader.style.visibility = 'hidden';
                loader.style.transition = '1.2s cubic-bezier(0.19, 1, 0.22, 1)';
            }, 1000); 
        });
    }

    // --- 2. NAVBAR SCROLL EFFECT ---
    const navbar = document.getElementById('navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(5, 5, 5, 0.98)';
                navbar.style.padding = '15px 0';
                navbar.style.borderBottom = '1px solid rgba(255, 255, 255, 0.1)';
            } else {
                navbar.style.background = 'rgba(5, 5, 5, 0.8)';
                navbar.style.padding = '25px 0';
                navbar.style.borderBottom = '1px solid rgba(255, 255, 255, 0.05)';
            }
        });
    }

    // --- 3. MOBILE MENU & OVERLAY ---
    const menuBtn = document.getElementById('mobile-menu-btn');
    const mobileNav = document.getElementById('mobile-nav');
    const overlay = document.getElementById('nav-overlay');

    if (menuBtn && mobileNav && overlay) {
        const toggleMenu = () => {
            mobileNav.classList.toggle('active');
            overlay.classList.toggle('active');
            document.body.style.overflow = mobileNav.classList.contains('active') ? 'hidden' : 'auto';
        };

        menuBtn.addEventListener('click', toggleMenu);
        overlay.addEventListener('click', toggleMenu);
    }

    // --- 4. FAQ ACCORDION LOGIC ---
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const header = item.querySelector('.faq-header');
        if (header) {
            header.addEventListener('click', () => {
                const isOpen = item.classList.contains('active');
                faqItems.forEach(i => i.classList.remove('active'));
                if (!isOpen) {
                    item.classList.add('active');
                }
            });
        }
    });

    // --- 5. FORM SUBMIT LOADING (FIXED FOR PHP COMPATIBILITY) ---
    // Kami menggunakan pointer-events agar tombol tidak mati total (disabled),
    // sehingga PHP masih bisa menerima data dari tombol submit tersebut.
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                // Jangan gunakan submitBtn.disabled = true; 
                // Karena akan menyebabkan $_POST['kirim'] di PHP menjadi hilang/null
                submitBtn.style.pointerEvents = 'none'; 
                submitBtn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> SENDING...';
                submitBtn.style.letterSpacing = '1px';
                submitBtn.style.opacity = '0.7';
            }
        });
    });

    // --- 6. INISIALISASI AOS ---
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 1000,
            once: true,
            offset: 120,
            easing: 'ease-in-out'
        });
    }

});