import './bootstrap';
import lottie from 'lottie-web';

// Lottie Animation Loader
window.lottie = lottie;

// Initialize Lottie animations when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    // Load all lottie animations on the page
    const lottieContainers = document.querySelectorAll('[data-lottie]');
    
    lottieContainers.forEach(container => {
        const animationPath = container.dataset.lottie;
        const loop = container.dataset.loop !== 'false';
        const autoplay = container.dataset.autoplay !== 'false';
        
        lottie.loadAnimation({
            container: container,
            renderer: 'svg',
            loop: loop,
            autoplay: autoplay,
            path: animationPath
        });
    });
});

// Sidebar toggle for mobile
function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    if (sidebar) {
        sidebar.classList.toggle('active');
    }
}

// Make toggleSidebar available globally
window.toggleSidebar = toggleSidebar;

// Dropdown toggle
function toggleDropdown(dropdownId) {
    const dropdown = document.getElementById(dropdownId);
    if (dropdown) {
        dropdown.classList.toggle('hidden');
    }
}

window.toggleDropdown = toggleDropdown;

// Auto-hide alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });
});

// Reveal-on-scroll animations using IntersectionObserver
document.addEventListener('DOMContentLoaded', () => {
    const animatedEls = document.querySelectorAll('[data-animate]');
    if (!('IntersectionObserver' in window) || animatedEls.length === 0) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                el.classList.add('in-view');
                observer.unobserve(el);
            }
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -10% 0px' });

    animatedEls.forEach(el => observer.observe(el));
});

// Micro-interaction: subtle hover ripple for buttons
document.addEventListener('mouseover', (e) => {
    const btn = e.target.closest('.btn');
    if (!btn) return;
    btn.style.transform = 'translateY(-1px)';
});
document.addEventListener('mouseout', (e) => {
    const btn = e.target.closest('.btn');
    if (!btn) return;
    btn.style.transform = '';
});
