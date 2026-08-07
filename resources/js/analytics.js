// analytics.js

const DEFAULT_CONFIG = {
    yandexMetrikaId: null,
    googleAnalyticsId: null,
    debug: false,
    ecommerce: true,
};

function getAnalyticsConfig() {
    return {
        ...DEFAULT_CONFIG,
        ...(window.CODE_DOCTOR_ANALYTICS || {}),
    };
}

// Яндекс.Метрика
export function loadYandexMetrika() {
    const config = getAnalyticsConfig();

    if (!config.yandexMetrikaId) return;
    if (window.__YANDEX_METRIKA_LOADED__) return;

    window.__YANDEX_METRIKA_LOADED__ = true;

    // Нужно для ecommerce: "dataLayer"
    window.dataLayer = window.dataLayer || [];

    (function (m, e, t, r, i, k, a) {
        m[i] = m[i] || function () {
            (m[i].a = m[i].a || []).push(arguments);
        };
        m[i].l = 1 * new Date();

        for (let j = 0; j < document.scripts.length; j++) {
            if (document.scripts[j].src === r) return;
        }

        k = e.createElement(t);
        a = e.getElementsByTagName(t)[0];
        k.async = 1;
        k.src = r;
        a.parentNode.insertBefore(k, a);
    })(
        window,
        document,
        'script',
        `https://mc.yandex.ru/metrika/tag.js?id=${config.yandexMetrikaId}`,
        'ym'
    );

    ym(config.yandexMetrikaId, 'init', {
        webvisor: true,
        clickmap: true,
        accurateTrackBounce: true,
        trackLinks: true,
        // defer: true,
        ecommerce: config.ecommerce ? 'dataLayer' : false,
    });

    if (config.debug) {
        console.log('[Analytics] Yandex Metrika loaded:', config.yandexMetrikaId);
    }
}

// Google Analytics
export function loadGoogleAnalytics() {
    const config = getAnalyticsConfig();

    if (!config.googleAnalyticsId) return;
    if (window.__GOOGLE_ANALYTICS_LOADED__) return;

    window.__GOOGLE_ANALYTICS_LOADED__ = true;

    const script = document.createElement('script');
    script.async = true;
    script.src = `https://www.googletagmanager.com/gtag/js?id=${config.googleAnalyticsId}`;
    document.head.appendChild(script);

    window.dataLayer = window.dataLayer || [];

    function gtag() {
        window.dataLayer.push(arguments);
    }

    window.gtag = window.gtag || gtag;

    gtag('js', new Date());
    gtag('config', config.googleAnalyticsId);

    if (config.debug) {
        console.log('[Analytics] Google Analytics loaded:', config.googleAnalyticsId);
    }
}

// Отправка целей в Метрику
export function reachGoal(goalId, params = {}) {
    const config = getAnalyticsConfig();

    if (!goalId) return;

    // Если Метрика ещё не загружена — создаём её перед отправкой цели
    if (!window.__YANDEX_METRIKA_LOADED__) {
        loadYandexMetrika();
    }

    if (typeof window.ym === 'function' && config.yandexMetrikaId) {
        window.ym(config.yandexMetrikaId, 'reachGoal', goalId, params);
    }

    if (config.debug) {
        console.log('[Analytics] Goal:', goalId, params);
    }
}

// Автоматическая обработка кликов по data-goal
export function initGoalClicks() {
    document.addEventListener('click', function (event) {
        const target = event.target.closest('[data-goal]');

        if (!target) return;

        reachGoal(target.dataset.goal, {
            url: window.location.href,
            text: target.innerText?.trim() || null,
            service: target.dataset.service || null,
            case: target.dataset.case || null,
        });
    });
}

// Стратегия загрузки
export function loadAnalyticsWithStrategy() {
    const isProd = import.meta.env.PROD;

    if (!isProd) return;

    // Метрика — с небольшой задержкой
    setTimeout(loadYandexMetrika, 1000);

    // GA — по взаимодействию
    let gaLoaded = false;

    const loadGA = () => {
        if (gaLoaded) return;

        loadGoogleAnalytics();
        gaLoaded = true;

        ['scroll', 'mousemove', 'touchstart', 'keydown'].forEach((event) => {
            window.removeEventListener(event, loadGA);
        });
    };

    ['scroll', 'mousemove', 'touchstart', 'keydown'].forEach((event) => {
        window.addEventListener(event, loadGA, { passive: true, once: true });
    });

    // Запасной таймер
    setTimeout(() => {
        if (!gaLoaded) loadGoogleAnalytics();
    }, 3000);
}

window.cdAnalytics = {
    reachGoal,
    loadYandexMetrika,
    loadGoogleAnalytics,
};

// Инициализация
function initAnalytics() {
    initGoalClicks();
    loadAnalyticsWithStrategy();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAnalytics);
} else {
    initAnalytics();
}