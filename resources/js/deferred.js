function initStickyNav() {
    const nav = document.querySelector('nav');
    if (!nav) return;
    
    let hasShadow = nav.classList.contains('shadow-lg');
    
    const updateNav = () => {
        const shouldHaveShadow = window.scrollY > 100;
        
        if (shouldHaveShadow !== hasShadow) {
            if (shouldHaveShadow) {
                nav.classList.add('shadow-lg', 'bg-card/95');
            } else {
                nav.classList.remove('shadow-lg', 'bg-card/95');
            }
            hasShadow = shouldHaveShadow;
        }
    };
    
    // Используем throttling вместо debounce
    let ticking = false;
    window.addEventListener('scroll', () => {
        if (!ticking) {
            ticking = true;
            requestAnimationFrame(() => {
                updateNav();
                ticking = false;
            });
        }
    }, { passive: true });
    
    // Инициализация
    updateNav();
}

// Запускаем после загрузки
if (document.readyState === 'complete') {
    initStickyNav();
} else {
    window.addEventListener('load', initStickyNav);
}