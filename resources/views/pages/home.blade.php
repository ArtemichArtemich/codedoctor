@extends('layouts.app')

@section('title', 'Техническое сопровождение сайтов — Code Doctor')
@section('description', 'Исправляю ошибки, разбираю старые сайты, настраиваю оплату, доставку, формы и интеграции. Сопровождение интернет-магазинов и сервисных сайтов.')

@section('content')

    <!-- HERO -->
    <section class="relative overflow-hidden py-6 md:py-16 z-10 11111888">
        <div class="container">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <!-- Текст -->
                <div>
                    <div class="inline-flex items-center px-4 py-2 bg-accent/10 border border-accent/30 rounded-full mb-6">
                        <span class="text-accent font-medium">Сайты, заявки, заказы и интеграции</span>
                    </div>
                    
                    <h1 class="text-3xl md:text-5xl font-bold mb-6 leading-tight">
                        Техническое сопровождение интернет-магазинов и сервисных сайтов
                    </h1>
                    
                    <p class="text-l text-text-secondary mb-10 max-w-xl">
                        Исправляю ошибки, разбираю старые сайты, настраиваю оплату, доставку, формы, заявки и интеграции.
                        Помогаю малому бизнесу выйти из технического хаоса и развивать сайт без случайных правок.
                    </p>

                    <p class="text-l text-text-secondary mb-10 max-w-xl">
                        <span class="text-accent font-medium">Разбор сайта — от 5 000 ₽</span><br>
                        <span class="text-accent font-medium">Срочная помощь — от 5 000 ₽</span><br>
                        <span class="text-accent font-medium">Сопровождение сайта — от 15 000 ₽/мес</span>
                    </p>
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div class="flex flex-wrap gap-4">
                            <a href="#contacts" 
                            data-goal="diagnostic_cta_click" 
                            class="inline-block px-8 py-4 bg-accent text-background font-bold rounded-xl hover:bg-accent/90 transition shadow-lg hover:shadow-xl">
                                Получить диагностику сайта
                            </a>
                            <a href="https://t.me/artem_fullstack" 
                            data-goal="telegram_click" 
                            class="inline-block px-8 py-4 bg-accent/20 backdrop-blur-sm border border-accent/30 text-white font-bold rounded-xl hover:bg-accent/30 transition">
                                Написать в Telegram
                            </a>
                        </div>
                        <a href="#cases" data-goal="cases_click" 
                        class="px-8 py-4 border-2 border-white/20 text-white font-bold rounded-xl hover:border-accent hover:bg-accent/10 transition inline-flex items-center gap-2">
                            Посмотреть кейсы <span>→</span>
                        </a>
                    </div>
                </div>
                
                <!-- Фото -->
                <div class="relative">
                    <div class="relative w-full mx-auto">
                        <!-- Размытый фон-подложка -->
                        <div class="absolute inset-0 bg-gradient-to-br from-accent/20 to-accent2/20 rounded-3xl blur-3xl transform scale-105"></div>
                        
                        <!-- Основной контейнер -->
                        <div class="relative bg-card/50 backdrop-blur-sm border border-white/10 rounded-3xl overflow-hidden">
                            <!-- Внешняя рамка для PNG -->
                            <div class="relative">
                                <!-- Дымный размытый фон для фото -->
                                <div class="absolute inset-0 bg-gradient-to-br from-accent/10 via-card/30 to-accent2/10 blur-xl"></div>
                                
                                <!-- Твоё PNG фото -->
                                <x-auto-img 
                                    src="hero/photo.png"
                                    alt="Техническое сопровождение сайтов — Code Doctor"
                                    class="relative w-full h-auto object-contain object-center z-10 drop-shadow-[0_20px_40px_rgba(246,201,69,0.2)]"
                                    :lazy="false"
                                    :priority="true"
                                    width="600"
                                    height="600"
                                    loading="eager"
                                    fetchpriority="high"
                                    decoding="async"
                                    sizes="(max-width: 768px) 378px, 600px"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ПРОБЛЕМЫ -->
    <section class="py-20 bg-card/30">
        <div class="container">
            <div class="max-w-3xl mx-auto text-center mb-12">
                <div class="inline-flex items-center px-4 py-2 bg-accent/10 border border-accent/30 rounded-full mb-6">
                    <span class="text-accent font-medium">Диагностика боли</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    С какими задачами обращаются
                </h2>
                <p class="text-text-secondary text-lg">
                    Если сайт работает нестабильно, мешает продажам или держится на старых доработках — начнём с разбора и определим, что исправлять в первую очередь.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-4 max-w-4xl mx-auto">
                @php
                    $problems = [
                        'Сайт сломался после обновления или чужой доработки.',
                        'Не работает корзина, оформление заказа, оплата или доставка.',
                        'Не приходят заявки, заказы, письма или уведомления.',
                        'Формы, бронирование или личный кабинет работают нестабильно.',
                        'Сайт медленно загружается и теряет клиентов.',
                        'Старый разработчик пропал, а проект нужно поддерживать и развивать.',
                        'Нужно доработать сайт под реальные бизнес-процессы.',
                        'Владелец устал от технического хаоса и хочет понятный план действий.',
                        'Нужен технический специалист на связи без найма в штат.'
                    ];
                @endphp

                @foreach($problems as $problem)
                <div class="flex items-start gap-4 p-5 rounded-2xl bg-card border border-white/5 hover:border-accent/20 transition group">
                    <div class="w-6 h-6 rounded-full bg-accent/20 flex items-center justify-center flex-shrink-0 mt-0.5 group-hover:bg-accent/30 transition">
                        <span class="text-accent text-sm">✓</span>
                    </div>
                    <span class="text-text-secondary group-hover:text-white transition">
                        {{ $problem }}
                    </span>
                </div>
                @endforeach
            </div>
        </div>
    </section>
        
    <!-- Услуги -->
    <section id="services" class="py-20">
        <div class="container">
            <div class="text-center mb-12">
                <div class="inline-flex items-center px-4 py-2 bg-accent/10 border border-accent/30 rounded-full mb-6">
                    <span class="text-accent font-medium">Что я делаю</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Решаю реальные задачи бизнеса</h2>
                <p class="text-text-secondary text-lg max-w-2xl mx-auto">
                    Не просто пишу код — разбираюсь в системе сайта, исправляю слабые места и помогаю бизнесу работать стабильнее.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <!-- 1. Разбор сайта и техническая диагностика -->
                <div class="group bg-card p-8 rounded-3xl border border-white/5 hover:border-accent/30 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-accent/10">
                    <div class="w-14 h-14 rounded-2xl bg-accent/10 flex items-center justify-center mb-6 group-hover:bg-accent/20 transition">
                        <span class="text-2xl">🔍</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Разбор сайта и техническая диагностика</h3>
                    <p class="text-text-secondary text-sm mb-4">Проверю сайт как разработчик и как человек, который понимает продажи.</p>
                    <ul class="text-sm text-text-secondary space-y-2 mb-6">
                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Корзина, оформление заказа, мобильная версия</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Скорость, ошибки, аналитика, тех. риски</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Список проблем с приоритетами и сметой</span>
                        </li>
                    </ul>
                    <div class="pt-4 border-t border-white/5 flex justify-between items-center">
                        <span class="text-accent font-bold">от 5 000 ₽</span>
                        <a href="#contacts" data-goal="diagnostic_cta_click" class="text-sm text-text-secondary hover:text-accent transition">Заказать →</a>
                    </div>
                </div>

                <!-- 2. Срочная помощь сайту -->
                <div class="group bg-card p-8 rounded-3xl border border-white/5 hover:border-accent/30 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-accent/10">
                    <div class="w-14 h-14 rounded-2xl bg-accent/10 flex items-center justify-center mb-6 group-hover:bg-accent/20 transition">
                        <span class="text-2xl">⚡</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Срочная помощь сайту</h3>
                    <p class="text-text-secondary text-sm mb-4">Сайт не открывается, ошибка, не работает оплата или формы.</p>
                    <ul class="text-sm text-text-secondary space-y-2 mb-6">
                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Диагностика и поиск причины</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Аккуратное исправление без лишнего вмешательства</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Белый экран, 500-ошибки, пропажа заказов</span>
                        </li>
                    </ul>
                    <div class="pt-4 border-t border-white/5 flex justify-between items-center">
                        <span class="text-accent font-bold">от 5 000 ₽</span>
                        <a href="#contacts" data-goal="urgent_help_cta_click" class="text-sm text-text-secondary hover:text-accent transition">Вызвать →</a>
                    </div>
                </div>

                <!-- 3. Доработка интернет-магазина / OpenCart -->
                <div class="group bg-card p-8 rounded-3xl border border-white/5 hover:border-accent/30 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-accent/10">
                    <div class="w-14 h-14 rounded-2xl bg-accent/10 flex items-center justify-center mb-6 group-hover:bg-accent/20 transition">
                        <span class="text-2xl">🛒</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Доработка интернет-магазина / OpenCart</h3>
                    <p class="text-text-secondary text-sm mb-4">Дорабатываю под реальные задачи бизнеса.</p>
                    <ul class="text-sm text-text-secondary space-y-2 mb-6">
                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Корзина, заказы, доставка, оплата</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Модули, скидки, статусы, интеграции</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Аккуратно с чужим кодом, без риска всё сломать</span>
                        </li>
                    </ul>
                    <div class="pt-4 border-t border-white/5 flex justify-between items-center">
                        <span class="text-accent font-bold">от 15 000 ₽</span>
                        <a href="#contacts" data-goal="opencart_cta_click" class="text-sm text-text-secondary hover:text-accent transition">Обсудить →</a>
                    </div>
                </div>

                <!-- 4. Техническое сопровождение сайта -->
                <div class="group bg-card p-8 rounded-3xl border border-white/5 hover:border-accent/30 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-accent/10">
                    <div class="w-14 h-14 rounded-2xl bg-accent/10 flex items-center justify-center mb-6 group-hover:bg-accent/20 transition">
                        <span class="text-2xl">🛡️</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Техническое сопровождение сайта</h3>
                    <p class="text-text-secondary text-sm mb-4">Разработчик на связи для бизнеса, которому нужна стабильность.</p>
                    <ul class="text-sm text-text-secondary space-y-2 mb-6">
                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Регулярные задачи, исправления, доработки</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Контроль стабильности, обновления</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Не ищете подрядчика под каждую мелочь</span>
                        </li>
                    </ul>
                    <div class="pt-4 border-t border-white/5 flex justify-between items-center">
                        <span class="text-accent font-bold">от 15 000 ₽/мес</span>
                        <a href="#contacts" data-goal="maintenance_cta_click" class="text-sm text-text-secondary hover:text-accent transition">Подключить →</a>
                    </div>
                </div>

                <!-- 5. Аналитика заявок, заказов и e-commerce -->
                <div class="group bg-card p-8 rounded-3xl border border-white/5 hover:border-accent/30 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-accent/10">
                    <div class="w-14 h-14 rounded-2xl bg-accent/10 flex items-center justify-center mb-6 group-hover:bg-accent/20 transition">
                        <span class="text-2xl">📊</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Аналитика заявок, заказов и e-commerce</h3>
                    <p class="text-text-secondary text-sm mb-4">Настрою Метрику и e-commerce-события для магазина.</p>
                    <ul class="text-sm text-text-secondary space-y-2 mb-6">
                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Корзина, оформление, покупки — всё видит</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Источники трафика и где теряете клиентов</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Понятная картина, а не просто счётчик</span>
                        </li>
                    </ul>
                    <div class="pt-4 border-t border-white/5 flex justify-between items-center">
                        <span class="text-accent font-bold">от 15 000 ₽</span>
                        <a href="#contacts" data-goal="metrika_cta_click" class="text-sm text-text-secondary hover:text-accent transition">Настроить →</a>
                    </div>
                </div>

                <!-- 6. Бонус / Доп. услуга -->
                <div class="group bg-card p-8 rounded-3xl border border-white/5 hover:border-accent/30 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-accent/10">
                    <div class="w-14 h-14 rounded-2xl bg-accent/10 flex items-center justify-center mb-6 group-hover:bg-accent/20 transition">
                        <span class="text-2xl">💬</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Интеграции и автоматизация</h3>
                    <p class="text-text-secondary text-sm mb-4">Связываю сайт с 1С, CRM, оплатой, доставкой, внешними API и внутренними сервисами.</p>
                    <ul class="text-sm text-text-secondary space-y-2 mb-6">
                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Обмены и статусы заказов</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Автоматизация ручных операций</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Нестандартная логика</span>
                        </li>
                    </ul>
                    <div class="pt-4 border-t border-white/5 flex justify-between items-center">
                        <span class="text-accent font-bold">от 40 000 ₽</span>
                        <a href="#contacts" data-goal="integration_cta_click" class="text-sm text-text-secondary hover:text-accent transition">Обсудить →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
        
    <!-- Преимущества -->
    <section id="benefits" class="py-20">
        <div class="container">
            <div class="text-center mb-12">
                <div class="inline-flex items-center px-4 py-2 bg-accent/10 border border-accent/30 rounded-full mb-6">
                    <span class="text-accent font-medium">Почему выбирают меня</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Почему со мной удобно</h2>
                <p class="text-text-secondary text-lg max-w-2xl mx-auto">
                    Работаю как технический партнёр, а не просто исполнитель
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-5xl mx-auto">
                
                <!-- 1 -->
                <div class="flex gap-4 p-5 rounded-2xl bg-card/30 border border-white/5 hover:border-accent/20 transition group">
                    <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-accent/10 flex items-center justify-center group-hover:bg-accent/20 transition">
                        <span class="text-accent text-xl">✍️</span>
                    </div>
                    <div>
                        <h3 class="font-bold mb-1">Не переписываю сайт без необходимости</h3>
                        <p class="text-text-secondary text-sm">Сначала разбираюсь в логике, потом предлагаю решение. Снижаю риск сломать рабочий проект.</p>
                    </div>
                </div>

                <!-- 2 -->
                <div class="flex gap-4 p-5 rounded-2xl bg-card/30 border border-white/5 hover:border-accent/20 transition group">
                    <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-accent/10 flex items-center justify-center group-hover:bg-accent/20 transition">
                        <span class="text-accent text-xl">🛒</span>
                    </div>
                    <div>
                        <h3 class="font-bold mb-1">Понимаю сайты с бизнес-логикой</h3>
                        <p class="text-text-secondary text-sm">Работаю с заказами, заявками, оплатой, доставкой, формами, интеграциями, аналитикой, личными кабинетами и внутренними процессами.</p>
                    </div>
                </div>

                <!-- 3 -->
                <div class="flex gap-4 p-5 rounded-2xl bg-card/30 border border-white/5 hover:border-accent/20 transition group">
                    <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-accent/10 flex items-center justify-center group-hover:bg-accent/20 transition">
                        <span class="text-accent text-xl">🔧</span>
                    </div>
                    <div>
                        <h3 class="font-bold mb-1">Беру задачи, где нужен разбор</h3>
                        <p class="text-text-secondary text-sm">Чужой код, старые доработки, нестандартные модули, мало документации — всё это умею.</p>
                    </div>
                </div>

                <!-- 4 -->
                <div class="flex gap-4 p-5 rounded-2xl bg-card/30 border border-white/5 hover:border-accent/20 transition group">
                    <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-accent/10 flex items-center justify-center group-hover:bg-accent/20 transition">
                        <span class="text-accent text-xl">🗣️</span>
                    </div>
                    <div>
                        <h3 class="font-bold mb-1">Объясняю простым языком</h3>
                        <p class="text-text-secondary text-sm">После диагностики понятно: что сломано, почему это важно и сколько стоит исправление.</p>
                    </div>
                </div>

                <!-- 5 -->
                <div class="flex gap-4 p-5 rounded-2xl bg-card/30 border border-white/5 hover:border-accent/20 transition group">
                    <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-accent/10 flex items-center justify-center group-hover:bg-accent/20 transition">
                        <span class="text-accent text-xl">🔄</span>
                    </div>
                    <div>
                        <h3 class="font-bold mb-1">Разовая работа или постоянная поддержка</h3>
                        <p class="text-text-secondary text-sm">Закрываю отдельные правки и регулярное сопровождение магазина. Выбираете удобный формат.</p>
                    </div>
                </div>

                <!-- 6 -->
                <div class="flex gap-4 p-5 rounded-2xl bg-card/30 border border-white/5 hover:border-accent/20 transition group">
                    <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-accent/10 flex items-center justify-center group-hover:bg-accent/20 transition">
                        <span class="text-accent text-xl">⚡</span>
                    </div>
                    <div>
                        <h3 class="font-bold mb-1">Быстрая реакция на проблемы</h3>
                        <p class="text-text-secondary text-sm">На срочные проблемы реагирую быстрее обычных задач: сайт не открывается, сломалась оплата, не приходят заказы.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Секция со статистикой -->
    <section class="py-20 bg-card/30">
        <div class="container">
            <div class="grid md:grid-cols-3 gap-8 text-center">
                <div>
                    <div class="text-4xl md:text-5xl font-bold text-accent mb-2">12+</div>
                    <div class="text-text-secondary">лет в разработке</div>
                </div>
                <div>
                    <div class="text-4xl md:text-5xl font-bold text-accent mb-2">50+</div>
                    <div class="text-text-secondary">успешных проектов</div>
                </div>
                <div>
                    <div class="text-4xl md:text-5xl font-bold text-accent mb-2">5+</div>
                    <div class="text-text-secondary">лет с e-commerce</div>
                </div>
            </div>
        </div>
    </section>
        
    <!-- Кейсы -->
    <section id="cases" class="py-20">
        <div class="container">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">Кейсы</h2>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($cases as $caseKey => $case)
                <div class="group bg-card rounded-3xl overflow-hidden border border-white/5 hover:border-accent/30 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-accent/10">
                    <!-- Верхняя часть с логотипом -->
                    <div class="h-60 bg-gradient-to-br from-accent/20 flex flex-col items-center justify-center p-6 group-hover:bg-gradient-to-br group-hover:from-accent/25 group-hover:to-accent2/25 transition-all duration-300">
                        <!-- Логотип клиента (буквы) -->
                        <div class="w-20 h-20 rounded-2xl bg-card/40 backdrop-blur-sm border border-white/10 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <span class="text-3xl font-bold text-white">{{ $case['logo'] ?? substr($case['title_short'], 0, 2) }}</span>
                        </div>
                        
                        <!-- Название проекта -->
                        <h3 class="text-xl font-bold text-center mb-2 text-white">{{ $case['title_short'] }}</h3>
                        
                        <!-- Длительность -->
                        <div class="text-sm text-white/70">{{ $case['duration'] }}</div>
                    </div>
                    
                    <!-- Контент кейса -->
                    <div class="p-6">
                        <!-- Теги/технологии -->
                        @if(isset($case['tags']) && count($case['tags']) > 0)
                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach(array_slice($case['tags'], 0, 3) as $tag)
                            <span class="px-3 py-1 bg-background/50 rounded-lg text-xs text-text-secondary">
                                {{ $tag }}
                            </span>
                            @endforeach
                            @if(count($case['tags']) > 3)
                            <span class="px-3 py-1 bg-background/50 rounded-lg text-xs text-text-secondary">
                                +{{ count($case['tags']) - 3 }}
                            </span>
                            @endif
                        </div>
                        @endif
                        
                        <!-- Описание задачи -->
                        <p class="text-text-secondary mb-4 text-sm">
                            {{ Str::limit($case['task'], 120) }}
                        </p>
                        
                        <!-- Кнопка смотреть сайт (только для реальных проектов) -->
                        @if(isset($case['website']) && $case['website'] !== '#')
                        <div class="mb-4">
                            <a href="{{ $case['website'] }}" 
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-background border border-white/10 rounded-lg hover:border-accent/50 hover:bg-accent/5 transition-all text-sm group/btn">
                                <span>Посмотреть сайт</span>
                                <span class="group-hover/btn:translate-x-0.5 transition-transform">↗</span>
                            </a>
                        </div>
                        @endif
                        
                        <!-- Цена и ссылка -->
                        <div class="flex justify-between items-center pt-4 border-t border-white/5">
                            <span class="text-accent font-bold">{{ $case['price'] }}</span>
                            <a href="{{ url('/cases/' . $case['slug']) }}" 
                            data-goal="case_detail_click" 
                            class="text-accent hover:text-accent transition text-sm font-medium group-hover:translate-x-1 transition-transform inline-flex items-center gap-1">
                                Подробнее
                                <span class="group-hover:translate-x-0.5 transition-transform">→</span>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- CTA -->
            <div class="text-center mt-12">
                <a href="#contacts" 
                data-goal="project_cta_click" 
                class="inline-block px-8 py-4 bg-accent text-background font-bold rounded-xl hover:bg-accent/90 transition shadow-lg hover:shadow-xl">
                    Обсудить ваш проект
                </a>
            </div>
        </div>
    </section>

    <!-- Стоимость -->
    <section id="prices" class="py-20 bg-card/30">
        <div class="container">
            <div class="text-center mb-12">
                <div class="inline-flex items-center px-4 py-2 bg-accent/10 border border-accent/30 rounded-full mb-6">
                    <span class="text-accent font-medium">Прозрачно и честно</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Стоимость</h2>
                <p class="text-text-secondary text-lg max-w-2xl mx-auto">
                    Фиксированные цены на типовые задачи. Никаких сюрпризов.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
                
                <!-- 1. Диагностика -->
                <div class="bg-card p-6 rounded-2xl border border-white/5 hover:border-accent/30 transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-3xl">🔍</span>
                        <span class="text-accent font-bold text-2xl">от 5 000 ₽</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Разбор сайта и техническая диагностика</h3>
                    <p class="text-text-secondary text-sm mb-4">Проверка сайта, форм, заказов, скорости, ошибок, аналитики и технических рисков.</p>
                    <p class="text-text-tertiary text-xs">На выходе — список проблем и оценка исправлений</p>
                </div>

                <!-- 2. Срочная помощь -->
                <div class="bg-card p-6 rounded-2xl border border-white/5 hover:border-accent/30 transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-3xl">⚡</span>
                        <span class="text-accent font-bold text-2xl">от 5 000 ₽</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Срочная помощь сайту</h3>
                    <p class="text-text-secondary text-sm mb-4">Исправление ошибок, проблем с оплатой, формами, корзиной, заявками и заказами.</p>
                    <p class="text-text-tertiary text-xs">Восстановлю работоспособность сайта</p>
                </div>

                <!-- 3. Пакет правок -->
                <div class="bg-card p-6 rounded-2xl border border-white/5 hover:border-accent/30 transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-3xl">📦</span>
                        <span class="text-accent font-bold text-2xl">от 15 000 ₽</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Пакет правок / доработка сайта</h3>
                    <p class="text-text-secondary text-sm mb-4">Несколько согласованных доработок: интерфейс, логика, модули, формы, карточки, корзина, оформление заказа.</p>
                    <p class="text-text-tertiary text-xs">Оформление заказа под ключ</p>
                </div>

                <!-- 4. Интеграции и сложная логика -->
                <div class="bg-card p-6 rounded-2xl border border-white/5 hover:border-accent/30 transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-3xl">🔌</span>
                        <span class="text-accent font-bold text-2xl">от 40 000 ₽</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Интеграции и сложная логика</h3>
                    <p class="text-text-secondary text-sm mb-4">Обмен с CRM, 1С, оплатой, доставкой, внешними API и внутренними сервисами.</p>
                    <p class="text-text-tertiary text-xs">Нестандартные сценарии заказов</p>
                </div>

                <!-- 5. Поддержка -->
                <div class="bg-card p-6 rounded-2xl border-2 border-accent/30 relative hover:border-accent transition-all duration-300 hover:-translate-y-1">
                    <div class="absolute -top-3 left-4">
                        <span class="bg-accent text-background px-3 py-0.5 rounded-full text-xs font-bold">Популярно</span>
                    </div>
                    <div class="flex items-center justify-between mb-4 mt-2">
                        <span class="text-3xl">🛡️</span>
                        <span class="text-accent font-bold text-2xl">от 15 000 ₽<span class="text-sm">/мес</span></span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Техническое сопровождение сайта</h3>
                    <p class="text-text-secondary text-sm mb-4">Регулярные задачи, контроль стабильности, консультации и развитие сайта без поиска нового подрядчика.</p>
                    <p class="text-text-tertiary text-xs">Развитие сайта без поиска нового подрядчика</p>
                </div>

                <!-- 6. Индивидуальный расчёт -->
                <div class="bg-card p-6 rounded-2xl border border-white/5 hover:border-accent/30 transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-3xl">💬</span>
                        <span class="text-accent font-bold text-xl">Договорная</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Нестандартная задача?</h3>
                    <p class="text-text-secondary text-sm mb-4">Опишите ваш проект — предложу оптимальное решение и точную стоимость.</p>
                    <a href="#contacts" data-goal="custom_task_cta_click" class="inline-block mt-2 text-accent text-sm hover:underline">Связаться →</a>
                </div>
            </div>

            <p class="text-center text-text-tertiary text-sm mt-10">
                Точная стоимость фиксируется в договоре после анализа задачи
            </p>
        </div>
    </section>
    
    <!-- Как я работаю -->
    <section id="process" class="py-20">
        <div class="container">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">Как я работаю</h2>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Шаг 1 -->
                <div class="text-center">
                    {{-- <div class="w-20 h-20 rounded-2xl bg-accent/10 flex items-center justify-center mx-auto mb-6">
                        <span class="text-3xl">🔍</span>
                    </div> --}}
                    <div class="w-8 h-8 rounded-full bg-accent text-background flex items-center justify-center mx-auto mb-4 font-bold">1</div>
                    <h3 class="text-xl font-bold mb-3">Анализ задачи</h3>
                    <p class="text-text-secondary">Изучаю ваш проект, понимаю цели и предлагаю оптимальное решение</p>
                </div>
                
                <!-- Шаг 2 -->
                <div class="text-center">
                    {{-- <div class="w-20 h-20 rounded-2xl bg-accent/10 flex items-center justify-center mx-auto mb-6">
                        <span class="text-3xl">📊</span>
                    </div> --}}
                    <div class="w-8 h-8 rounded-full bg-accent text-background flex items-center justify-center mx-auto mb-4 font-bold">2</div>
                    <h3 class="text-xl font-bold mb-3">Оценка</h3>
                    <p class="text-text-secondary">Рассчитываю стоимость и сроки, согласовываем детали</p>
                </div>
                
                <!-- Шаг 3 -->
                <div class="text-center">
                    {{-- <div class="w-20 h-20 rounded-2xl bg-accent/10 flex items-center justify-center mx-auto mb-6">
                        <span class="text-3xl">💳</span>
                    </div> --}}
                    <div class="w-8 h-8 rounded-full bg-accent text-background flex items-center justify-center mx-auto mb-4 font-bold">3</div>
                    <h3 class="text-xl font-bold mb-3">Предоплата</h3>
                    <p class="text-text-secondary">Заключаем договор, вносим предоплату 50% и приступаем к работе</p>
                </div>
                
                <!-- Шаг 4 -->
                <div class="text-center">
                    {{-- <div class="w-20 h-20 rounded-2xl bg-accent/10 flex items-center justify-center mx-auto mb-6">
                        <span class="text-3xl">👨‍💻</span>
                    </div> --}}
                    <div class="w-8 h-8 rounded-full bg-accent text-background flex items-center justify-center mx-auto mb-4 font-bold">4</div>
                    <h3 class="text-xl font-bold mb-3">Работа</h3>
                    <p class="text-text-secondary">Разрабатываю, тестирую, предоставляю промежуточные отчёты</p>
                </div>
                
                <!-- Шаг 5 -->
                <div class="text-center">
                    {{-- <div class="w-20 h-20 rounded-2xl bg-accent/10 flex items-center justify-center mx-auto mb-6">
                        <span class="text-3xl">✅</span>
                    </div> --}}
                    <div class="w-8 h-8 rounded-full bg-accent text-background flex items-center justify-center mx-auto mb-4 font-bold">5</div>
                    <h3 class="text-xl font-bold mb-3">Сдача</h3>
                    <p class="text-text-secondary">Предоставляю готовый результат, объясняю как пользоваться</p>
                </div>
                
                <!-- Шаг 6 -->
                <div class="text-center">
                    {{-- <div class="w-20 h-20 rounded-2xl bg-accent/10 flex items-center justify-center mx-auto mb-6">
                        <span class="text-3xl">🛡️</span>
                    </div> --}}
                    <div class="w-8 h-8 rounded-full bg-accent text-background flex items-center justify-center mx-auto mb-4 font-bold">6</div>
                    <h3 class="text-xl font-bold mb-3">Поддержка</h3>
                    <p class="text-text-secondary">Гарантийная поддержка, консультации, дальнейшее сопровождение</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Секция с технолгиями -->
    <section class="py-20">
        <div class="container">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">Технологии</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach([
                    ['icon' => '🛒', 'name' => 'OpenCart', 'desc' => 'E-commerce'],
                    ['icon' => '🐘', 'name' => 'PHP', 'desc' => 'Backend'],
                    ['icon' => '⚡', 'name' => 'JavaScript', 'desc' => 'Frontend'],
                    ['icon' => '🗄️', 'name' => 'MySQL', 'desc' => 'Базы данных'],
                    ['icon' => '🔌', 'name' => 'API', 'desc' => 'Интеграции'],
                    ['icon' => '🎨', 'name' => 'Tailwind', 'desc' => 'Дизайн'],
                ] as $tech)
                <div class="bg-card p-6 rounded-2xl text-center border border-white/5 hover:border-accent/30 transition">
                    <div class="text-3xl mb-3">{{ $tech['icon'] }}</div>
                    <div class="font-bold mb-1">{{ $tech['name'] }}</div>
                    <div class="text-sm text-text-secondary">{{ $tech['desc'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('components.brands-carousel')
    
    <!-- Контакты -->
    <section id="contacts" class="py-20 bg-card/30">
        <div class="container">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">Опишите задачу — предложу оптимальное решение</h2>
            <p class="text-center text-text-secondary mb-12">Кратко расскажите, что за сайт и что нужно сделать.</p>
            <div class="grid md:grid-cols-2 gap-12 max-w-6xl mx-auto">
                <!-- Форма -->
                <div class="bg-card p-8 rounded-3xl border border-white/5">
                    <form id="contact-form" class="space-y-6" novalidate>
                        @csrf
                        
                        <div>
                            <label class="block text-text-secondary mb-2">Имя *</label>
                            <input type="text" 
                                name="name"
                                required
                                minlength="2"
                                maxlength="255"
                                class="w-full px-4 py-3 bg-background border border-white/10 rounded-xl text-white placeholder:text-text-tertiary focus:outline-none focus:border-accent2 transition"
                                placeholder="Ваше имя">
                            <div class="text-xs text-text-tertiary mt-1">Минимум 2 символа</div>
                        </div>
                        
                        <div>
                            <label class="block text-text-secondary mb-2">Контакты для связи *</label>
                            <input type="text" 
                                name="contact"
                                required
                                minlength="5"
                                maxlength="255"
                                class="w-full px-4 py-3 bg-background border border-white/10 rounded-xl text-white placeholder:text-text-tertiary focus:outline-none focus:border-accent2 transition"
                                placeholder="Telegram, email или телефон">
                            <div class="text-xs text-text-tertiary mt-1">Пример: @telegram_username, email@example.com, +79991234567</div>
                        </div>
                        
                        <div>
                            <label class="block text-text-secondary mb-2">Ссылка на сайт</label>
                            <input type="url" 
                                name="website"
                                pattern="https?://.+"
                                maxlength="255"
                                class="w-full px-4 py-3 bg-background border border-white/10 rounded-xl text-white placeholder:text-text-tertiary focus:outline-none focus:border-accent2 transition"
                                placeholder="https://ваш-сайт.ru">
                            <div class="text-xs text-text-tertiary mt-1">Должен начинаться с http:// или https://</div>
                        </div>
                        
                        <div>
                            <label class="block text-text-secondary mb-2">Описание задачи *</label>
                            <textarea rows="5"
                                    name="message"
                                    required
                                    minlength="10"
                                    maxlength="2000"
                                    class="w-full px-4 py-3 bg-background border border-white/10 rounded-xl text-white placeholder:text-text-tertiary focus:outline-none focus:border-accent2 transition"
                                    placeholder="Что нужно сделать, какие проблемы решить, какие цели"></textarea>
                            <div class="text-xs text-text-tertiary mt-1">Минимум 10 символов, максимум 2000</div>
                        </div>

                        <div>
                            <label class="flex items-start space-x-3 cursor-pointer">
                                <input type="checkbox"
                                    name="privacy"
                                    required
                                    class="mt-1 w-5 h-5 rounded border-white/20 bg-background text-accent focus:ring-accent focus:ring-offset-0 focus:outline-none"
                                    id="privacy-checkbox">
                                <span class="text-sm text-text-secondary">
                                    Я соглашаюсь с 
                                    <a href="/policy" target="_blank" class="text-accent hover:underline">
                                        политикой конфиденциальности
                                    </a>
                                    и обработкой персональных данных
                                </span>
                            </label>
                            <div class="text-xs text-red-400 mt-1 hidden" id="privacy-error">
                                Необходимо согласиться с политикой конфиденциальности
                            </div>
                        </div>
                        
                        <div id="form-message" class="hidden p-4 rounded-xl"></div>
                        
                        <button type="submit"
                                id="submit-btn"
                                class="w-full py-4 bg-accent text-background font-bold rounded-xl hover:bg-accent/90 transition shadow-lg hover:shadow-xl">
                            Отправить заявку
                        </button>
                        
                        <p class="text-center text-text-secondary text-sm">
                            Обычно отвечаю в течение рабочего дня
                        </p>
                    </form>
                </div>
                
                <!-- Контактная информация -->
                <div class="space-y-8">
                    <div>
                        <h3 class="text-xl font-bold mb-4">Контакты</h3>
                        <div class="space-y-4">
                            <a href="https://t.me/artem_fullstack" target="_blank" data-goal="telegram_click" 
                               class="flex items-center space-x-3 text-text-secondary hover:text-accent2 transition">
                                <span class="text-2xl">📱</span>
                                <span>Telegram: @artem_fullstack</span>
                            </a>
                            <a href="mailto:web@code-doctor.ru" data-goal="email_click" 
                               class="flex items-center space-x-3 text-text-secondary hover:text-accent2 transition">
                                <span class="text-2xl">✉️</span>
                                <span>Email: web@code-doctor.ru</span>
                            </a>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-xl font-bold mb-4">Преимущества работы со мной</h3>
                        <div class="space-y-3">
                            <div class="flex items-start space-x-3">
                                <span class="text-accent2 text-xl">✓</span>
                                <span class="text-text-secondary">Прямой контакт с исполнителем</span>
                            </div>
                            <div class="flex items-start space-x-3">
                                <span class="text-accent2 text-xl">✓</span>
                                <span class="text-text-secondary">Прозрачные сроки и стоимость</span>
                            </div>
                            <div class="flex items-start space-x-3">
                                <span class="text-accent2 text-xl">✓</span>
                                <span class="text-text-secondary">Работа по договору</span>
                            </div>
                            <div class="flex items-start space-x-3">
                                <span class="text-accent2 text-xl">✓</span>
                                <span class="text-text-secondary">Гарантия на работы</span>
                            </div>
                            <div class="flex items-start space-x-3">
                                <span class="text-accent2 text-xl">✓</span>
                                <span class="text-text-secondary">Оперативно реагирую на срочные проблемы</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('components.schema')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // ========== Обработка фото ==========
            const realPhoto = document.getElementById('real-photo');
            if (realPhoto) {
                const placeholder = document.getElementById('photo-placeholder');
                
                realPhoto.onload = function() {
                    if (placeholder) {
                        placeholder.style.display = 'none';
                        realPhoto.classList.remove('hidden');
                    }
                };
                
                realPhoto.onerror = function() {
                    if (placeholder) {
                        placeholder.style.display = 'flex';
                        realPhoto.classList.add('hidden');
                    }
                };
                
                // Проверяем сразу
                if (realPhoto.complete) {
                    if (realPhoto.naturalHeight === 0) {
                        if (placeholder) {
                            placeholder.style.display = 'flex';
                            realPhoto.classList.add('hidden');
                        }
                    } else {
                        if (placeholder) {
                            placeholder.style.display = 'none';
                            realPhoto.classList.remove('hidden');
                        }
                    }
                }
            }
            
            // ========== Обработка формы ==========
            const form = document.getElementById('contact-form');
            const privacyCheckbox = document.getElementById('privacy-checkbox');
            const privacyError = document.getElementById('privacy-error');

            if (form) {
                const submitBtn = document.getElementById('submit-btn');
                const formMessage = document.getElementById('form-message');
                
                form.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    
                    if (!submitBtn) return;

                    if (privacyCheckbox && !privacyCheckbox.checked) {
                        privacyError?.classList.remove('hidden');
                        privacyCheckbox.focus();
                        privacyCheckbox.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        return;
                    }
                    
                    // Показываем индикатор загрузки
                    const originalText = submitBtn.textContent;
                    submitBtn.textContent = 'Отправка...';
                    submitBtn.disabled = true;
                    
                    // Скрываем предыдущее сообщение и ошибки
                    if (formMessage) {
                        formMessage.classList.add('hidden');
                    }
                    
                    // Убираем предыдущие ошибки
                    clearFormErrors();
                    
                    try {
                        const formData = new FormData(form);
                        
                        // Получаем CSRF токен из мета-тега
                        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                                    document.querySelector('input[name="_token"]')?.value;
                        
                        const response = await fetch('/contact', {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json'
                            },
                            body: formData
                        });
                        
                        const data = await response.json();
                        
                        if (response.ok) {
                            if (window.cdAnalytics?.reachGoal) {
                                window.cdAnalytics.reachGoal('lead_submit', {
                                    source: 'contact_form',
                                    page: window.location.href
                                });
                            }
                            // Успех
                            if (formMessage) {
                                formMessage.textContent = data.message;
                                formMessage.className = 'p-4 rounded-xl bg-accent2/20 text-accent2 border border-accent2/30';
                                formMessage.classList.remove('hidden');
                                
                                // Очищаем форму
                                form.reset();
                                
                                // Прокручиваем к сообщению
                                setTimeout(() => {
                                    formMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                }, 100);
                            }
                        } else {
                            // Ошибки валидации
                            if (data.errors) {
                                displayFormErrors(data.errors);
                            } else {
                                // Другая ошибка
                                if (formMessage) {
                                    formMessage.textContent = data.message || 'Произошла ошибка. Попробуйте еще раз.';
                                    formMessage.className = 'p-4 rounded-xl bg-red-500/20 text-red-400 border border-red-500/30';
                                    formMessage.classList.remove('hidden');
                                }
                            }
                        }
                    } catch (error) {
                        // Сетевая ошибка
                        if (formMessage) {
                            formMessage.textContent = 'Ошибка соединения. Проверьте интернет и попробуйте еще раз.';
                            formMessage.className = 'p-4 rounded-xl bg-red-500/20 text-red-400 border border-red-500/30';
                            formMessage.classList.remove('hidden');
                        }
                        console.error('Form error:', error);
                    } finally {
                        // Восстанавливаем кнопку
                        if (submitBtn) {
                            submitBtn.textContent = originalText;
                            submitBtn.disabled = false;
                        }
                    }
                });
                
                // Функция для отображения ошибок валидации
                function displayFormErrors(errors) {
                    Object.keys(errors).forEach(fieldName => {
                        const field = form.querySelector(`[name="${fieldName}"]`);
                        if (field) {
                            // Добавляем класс ошибки к полю
                            field.classList.add('border-red-500', 'border-2');
                            
                            // Создаем элемент с ошибкой
                            const errorElement = document.createElement('div');
                            errorElement.className = 'error-text text-red-400 text-sm mt-1 flex items-center';
                            errorElement.innerHTML = `
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                ${errors[fieldName][0]}
                            `;
                            
                            // Вставляем после поля
                            field.parentNode.appendChild(errorElement);
                        }
                    });
                    
                    // Прокручиваем к первой ошибке
                    const firstErrorField = form.querySelector('.border-red-500');
                    if (firstErrorField) {
                        firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        firstErrorField.focus();
                    }
                }
                
                // Функция для очистки ошибок
                function clearFormErrors() {
                    // Убираем классы ошибок с полей
                    form.querySelectorAll('.border-red-500').forEach(field => {
                        field.classList.remove('border-red-500', 'border-2');
                    });
                    
                    // Удаляем сообщения об ошибках
                    form.querySelectorAll('.error-text').forEach(error => {
                        error.remove();
                    });
                }
                
                // Валидация в реальном времени (убираем ошибки при вводе)
                const inputs = form.querySelectorAll('input, textarea');
                inputs.forEach(input => {
                    input.addEventListener('input', function() {
                        this.classList.remove('border-red-500', 'border-2');
                        const errorElement = this.parentNode.querySelector('.error-text');
                        if (errorElement) {
                            errorElement.remove();
                        }
                    });
                    
                    // Валидация при потере фокуса
                    input.addEventListener('blur', function() {
                        if (this.value.trim() === '' && this.hasAttribute('required')) {
                            this.classList.add('border-red-500', 'border-2');
                            if (!this.parentNode.querySelector('.error-text')) {
                                const errorElement = document.createElement('div');
                                errorElement.className = 'error-text text-red-400 text-sm mt-1 flex items-center';
                                errorElement.innerHTML = `
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    Это поле обязательно для заполнения
                                `;
                                this.parentNode.appendChild(errorElement);
                            }
                        }
                    });
                });
            }
                    
            if (privacyCheckbox && privacyError) {
                privacyCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        privacyError.classList.add('hidden');
                    }
                });
            }
            
        });
    </script>
@endsection