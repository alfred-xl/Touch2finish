import Alpine from 'alpinejs';

document.documentElement.classList.add('js');

window.Alpine = Alpine;

Alpine.start();

const revealElements = document.querySelectorAll('[data-reveal]');
const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

if (revealElements.length) {
    if (reduceMotion || !('IntersectionObserver' in window)) {
        revealElements.forEach((element) => element.classList.add('is-visible'));
    } else {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px' });

        revealElements.forEach((element) => {
            const delay = Number(element.dataset.revealDelay || 0);
            element.style.setProperty('--reveal-delay', `${[0, 80, 160, 240].includes(delay) ? delay : 0}ms`);
            observer.observe(element);
        });
    }
}
