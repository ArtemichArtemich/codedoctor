import { loadAnalyticsWithStrategy } from './analytics';

document.addEventListener('DOMContentLoaded', function() {
    // 1. Мобильное меню
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }
    
    // 2. Плавная навигация
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href === '#') return;
            
            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                requestAnimationFrame(() => {
                    target.scrollIntoView({ behavior: 'smooth' });
                });
            }
        });
    });
    
    // 3. Кнопки с onclick
    document.querySelectorAll('button[onclick*="getElementById"]').forEach(button => {
        button.addEventListener('click', function() {
            const onclick = this.getAttribute('onclick');
            const match = onclick.match(/getElementById\('([^']+)'\)/);
            if (match) {
                const target = document.getElementById(match[1]);
                if (target) {
                    requestAnimationFrame(() => {
                        target.scrollIntoView({ behavior: 'smooth' });
                    });
                }
            }
        });
    });

    // 4. ЗАПУСК АНАЛИТИКИ
    loadAnalyticsWithStrategy();
});

// Шрифты
if ('fonts' in document) {
    document.fonts.ready.then(() => {
        requestAnimationFrame(() => {
            document.documentElement.classList.add('fonts-loaded');
        });
    });
}