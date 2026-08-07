<div id="cookie-consent" class="fixed bottom-0 left-0 right-0 z-50 transform transition-transform duration-300 translate-y-full">
    <div class="container mx-auto px-4 pb-6">
        <div class="bg-card border border-accent/20 rounded-2xl shadow-2xl p-6 max-w-2xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-center gap-4">
                <div class="flex-1">
                    <h3 class="text-lg font-bold mb-2">🍪 Используем cookies</h3>
                    <p class="text-text-secondary text-sm">
                        Мы используем файлы cookies для улучшения работы сайта. 
                        Продолжая использование сайта, вы соглашаетесь с 
                        <a href="{{ route('cookies') }}" class="text-accent hover:text-accent/80 transition">Политикой использования cookies</a>
                        и 
                        <a href="{{ route('policy') }}" class="text-accent hover:text-accent/80 transition">Политикой конфиденциальности</a>.
                    </p>
                </div>
                <div class="flex gap-3">
                    <button onclick="acceptCookies()" 
                            class="px-5 py-2 bg-accent text-background font-semibold rounded-xl hover:bg-accent/90 transition whitespace-nowrap">
                        Принять
                    </button>
                    <button onclick="rejectCookies()" 
                            class="px-5 py-2 border border-white/20 text-text-secondary font-semibold rounded-xl hover:border-accent/50 hover:text-white transition whitespace-nowrap">
                        Отклонить
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Проверяем, было ли уже согласие
function checkCookieConsent() {
    const consent = localStorage.getItem('cookie_consent');
    const consentDate = localStorage.getItem('cookie_consent_date');
    
    // Если согласие было принято менее недели назад - не показываем
    if (consent === 'accepted' && consentDate) {
        const oneWeekAgo = Date.now() - (7 * 24 * 60 * 60 * 1000);
        if (parseInt(consentDate) > oneWeekAgo) {
            return false; // Не показывать
        }
    }
    
    // Если явно отклонили - не показываем (можно показывать через неделю)
    if (consent === 'rejected' && consentDate) {
        const oneWeekAgo = Date.now() - (7 * 24 * 60 * 60 * 1000);
        if (parseInt(consentDate) > oneWeekAgo) {
            return false; // Не показывать
        }
    }
    
    return true; // Показывать
}

// Показываем соглашение если нужно
document.addEventListener('DOMContentLoaded', function() {
    if (checkCookieConsent()) {
        setTimeout(() => {
            const consentElement = document.getElementById('cookie-consent');
            if (consentElement) {
                consentElement.classList.remove('translate-y-full');
            }
        }, 1000); // Показываем через 1 секунду
    }
});

// Принять cookies
function acceptCookies() {
    localStorage.setItem('cookie_consent', 'accepted');
    localStorage.setItem('cookie_consent_date', Date.now().toString());
    
    const consentElement = document.getElementById('cookie-consent');
    if (consentElement) {
        consentElement.classList.add('translate-y-full');
    }
    
    // Можно отправить событие в аналитику
    console.log('Cookies accepted');
}

// Отклонить cookies
function rejectCookies() {
    localStorage.setItem('cookie_consent', 'rejected');
    localStorage.setItem('cookie_consent_date', Date.now().toString());
    
    const consentElement = document.getElementById('cookie-consent');
    if (consentElement) {
        consentElement.classList.add('translate-y-full');
    }
    
    // Можно удалить аналитические cookies
    deleteAnalyticsCookies();
    console.log('Cookies rejected');
}

// Функция для удаления аналитических cookies (пример)
function deleteAnalyticsCookies() {
    // Удаляем возможные аналитические cookies
    const cookies = document.cookie.split(';');
    cookies.forEach(cookie => {
        const cookieName = cookie.split('=')[0].trim();
        // Удаляем cookies с аналитическими именами
        if (cookieName.includes('_ga') || cookieName.includes('_gid') || 
            cookieName.includes('_ym') || cookieName.includes('_fbp')) {
            document.cookie = `${cookieName}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
        }
    });
}

// Проверяем при каждой загрузке страницы
if (checkCookieConsent()) {
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
            const consentElement = document.getElementById('cookie-consent');
            if (consentElement) {
                consentElement.classList.remove('translate-y-full');
            }
        }, 1000);
    });
}
</script>