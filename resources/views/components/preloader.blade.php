<div id="preloader" class="fixed inset-0 z-[100] bg-background flex items-center justify-center transition-opacity duration-500">
    <div class="relative">
        <!-- Анимированный фон -->
        <div class="absolute inset-0">
            <div class="absolute -top-20 -left-20 w-40 h-40 bg-accent/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-20 -right-20 w-40 h-40 bg-accent2/10 rounded-full blur-3xl"></div>
        </div>
        
        <!-- Основной логотип -->
        <div class="relative flex flex-col items-center">
            <!-- Анимированный круг -->
            <div class="relative w-24 h-24 mb-8">
                <!-- Внешний круг -->
                <div class="absolute inset-0 border-4 border-accent/20 rounded-full"></div>
                
                <!-- Вращающийся круг -->
                <div class="absolute inset-0 border-4 border-transparent border-t-accent border-r-accent2 rounded-full animate-spin"
                     style="animation-duration: 1.5s;"></div>
                
                <!-- Инициалы -->
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-16 h-16 rounded-full bg-gradient-to-br from-accent to-accent2 flex items-center justify-center text-background text-2xl font-bold">
                        А
                    </div>
                </div>
                
                <!-- Точечки -->
                <div class="absolute -top-2 left-1/2 transform -translate-x-1/2">
                    <div class="w-3 h-3 bg-accent rounded-full animate-pulse"></div>
                </div>
                <div class="absolute top-1/2 -right-2 transform -translate-y-1/2">
                    <div class="w-3 h-3 bg-accent2 rounded-full animate-pulse" style="animation-delay: 0.2s;"></div>
                </div>
                <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2">
                    <div class="w-3 h-3 bg-accent rounded-full animate-pulse" style="animation-delay: 0.4s;"></div>
                </div>
                <div class="absolute top-1/2 -left-2 transform -translate-y-1/2">
                    <div class="w-3 h-3 bg-accent2 rounded-full animate-pulse" style="animation-delay: 0.6s;"></div>
                </div>
            </div>
            
            <!-- Текст -->
            <div class="text-center">
                <div class="text-xl font-bold mb-2">Техническое сопровождение сайтов — Code Doctor</div>
                <div class="text-text-secondary text-sm">Загружаю крутые решения...</div>
                
                <!-- Прогресс-бар -->
                <div class="w-48 h-1 bg-card rounded-full overflow-hidden mt-4">
                    <div id="preloader-progress" class="h-full bg-gradient-to-r from-accent to-accent2 rounded-full transition-all duration-300" 
                         style="width: 0%"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Симуляция прогресса загрузки
let progress = 0;
const progressElement = document.getElementById('preloader-progress');
const preloader = document.getElementById('preloader');

function simulateProgress() {
    if (progress < 90) {
        progress += Math.random() * 15 + 5;
        if (progress > 90) progress = 90;
        
        if (progressElement) {
            progressElement.style.width = progress + '%';
        }
        
        setTimeout(simulateProgress, Math.random() * 200 + 100);
    }
}

// Запускаем симуляцию прогресса
document.addEventListener('DOMContentLoaded', function() {
    simulateProgress();
    
    // Когда вся страница загружена
    window.addEventListener('load', function() {
        // Доводим прогресс до 100%
        if (progressElement) {
            progressElement.style.width = '100%';
        }
        
        // Скрываем прелоадер через 300мс
        setTimeout(function() {
            if (preloader) {
                preloader.style.opacity = '0';
                setTimeout(function() {
                    preloader.style.display = 'none';
                    // Добавляем класс loaded для отключения анимаций
                    document.body.classList.add('loaded');
                }, 500);
            }
        }, 300);
    });
    
    // На всякий случай: если load не сработал, скрываем через 3 секунды
    setTimeout(function() {
        if (preloader && preloader.style.display !== 'none') {
            if (progressElement) {
                progressElement.style.width = '100%';
            }
            setTimeout(function() {
                preloader.style.opacity = '0';
                setTimeout(function() {
                    preloader.style.display = 'none';
                }, 500);
            }, 300);
        }
    }, 3000);
});
</script>