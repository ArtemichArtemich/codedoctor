@extends('layouts.app')

@section('title', 'Доработка, диагностика и поддержка сайтов — Code Doctor')
@section('description', 'Помогаю разобраться с сайтом: исправляю ошибки, дорабатываю функциональность, интеграции и автоматизацию, работаю с аналитикой, SEO и техническими задачами.')

@section('content')

    <!-- HERO -->
    <section class="relative overflow-hidden py-6 md:py-16 z-10">
        <div class="container">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <!-- Текст -->
                <div>
                    <div class="inline-flex items-center px-4 py-2 bg-accent/10 border border-accent/30 rounded-full mb-6">
                        <span class="text-accent font-medium">Сайты, интернет-магазины и веб-проекты</span>
                    </div>
                    
                    <h1 class="text-3xl md:text-5xl font-bold mb-6 leading-tight">
                        Помогаю разобраться с сайтом, исправить проблемы и развивать его дальше
                    </h1>
                    
                    <p class="text-l text-text-secondary mb-10 max-w-xl">
                        Исправляю ошибки, дорабатываю существующие сайты и интернет-магазины,
                        подключаю сервисы и автоматизацию, помогаю с аналитикой, SEO и другими задачами вокруг сайта.
                        Если проект старый, чужой или непонятно устроен — сначала разберусь, что в нём происходит.
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
                                Обсудить задачу
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
                    <span class="text-accent font-medium">С чем можно обратиться</span>
                </div>

                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    С какими задачами обращаются
                </h2>

                <p class="text-text-secondary text-lg">
                    Не обязательно заранее понимать, где именно проблема — в коде, настройках, аналитике, структуре сайта или интеграциях.
                    Сначала разберусь в ситуации и помогу определить, что имеет смысл делать дальше.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-4 max-w-4xl mx-auto">
                @php
                    $problems = [
                        'Сайт сломался, работает нестабильно или после обновления появились ошибки.',
                        'Не работает корзина, оплата, доставка, формы, заявки или другие важные функции.',
                        'Нужно доработать существующий сайт под новые задачи бизнеса.',
                        'Старый разработчик пропал, а в чужом проекте нужно разобраться и продолжить работу.',
                        'Нужно сделать новый сайт или веб-сервис с нуля.',
                        'Реклама работает, но непонятно, откуда приходят заявки и что происходит на сайте.',
                        'Нужно понять, что улучшать в первую очередь: техническую часть, SEO, структуру, контент или аналитику.',
                        'Нужно связать сайт с CRM, 1С, оплатой, доставкой или другими сервисами.',
                        'Нужен человек, который будет регулярно заниматься сайтом, доработками и возникающими задачами.',
                        'Есть идея или бизнес-задача, но непонятно, как лучше реализовать её на сайте.'
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

                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    Помогаю решать задачи вокруг сайта
                </h2>

                <p class="text-text-secondary text-lg max-w-2xl mx-auto">
                    От срочного исправления ошибки до доработки существующего проекта,
                    создания нового сервиса, интеграций и регулярного сопровождения.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- 1. Диагностика сайта -->
                <div class="group bg-card p-8 rounded-3xl border border-white/5 hover:border-accent/30 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-accent/10">
                    <div class="w-14 h-14 rounded-2xl bg-accent/10 flex items-center justify-center mb-6 group-hover:bg-accent/20 transition">
                        <span class="text-2xl">🔍</span>
                    </div>

                    <h3 class="text-xl font-bold mb-3">
                        Диагностика сайта
                    </h3>

                    <p class="text-text-secondary text-sm mb-4">
                        Если непонятно, где проблема и с чего начинать — сначала разберусь в проекте.
                    </p>

                    <ul class="text-sm text-text-secondary space-y-2 mb-6">
                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Ошибки, скорость и важные функции сайта</span>
                        </li>

                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Структура проекта и технические риски</span>
                        </li>

                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Понятный список проблем и приоритетов</span>
                        </li>
                    </ul>

                    <div class="pt-4 border-t border-white/5 flex justify-between items-center">
                        <span class="text-accent font-bold">от 5 000 ₽</span>

                        <a href="#contacts"
                        data-goal="diagnostic_cta_click"
                        class="text-sm text-text-secondary hover:text-accent transition">
                            Обсудить →
                        </a>
                    </div>
                </div>

                <!-- 2. Срочная помощь -->
                <div class="group bg-card p-8 rounded-3xl border border-white/5 hover:border-accent/30 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-accent/10">
                    <div class="w-14 h-14 rounded-2xl bg-accent/10 flex items-center justify-center mb-6 group-hover:bg-accent/20 transition">
                        <span class="text-2xl">⚡</span>
                    </div>

                    <h3 class="text-xl font-bold mb-3">
                        Срочная помощь сайту
                    </h3>

                    <p class="text-text-secondary text-sm mb-4">
                        Когда что-то перестало работать и проблему нужно найти и исправить.
                    </p>

                    <ul class="text-sm text-text-secondary space-y-2 mb-6">
                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Сайт не открывается или показывает ошибку</span>
                        </li>

                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Не работают заявки, формы, корзина или оплата</span>
                        </li>

                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Проблемы после обновления или чужой доработки</span>
                        </li>
                    </ul>

                    <div class="pt-4 border-t border-white/5 flex justify-between items-center">
                        <span class="text-accent font-bold">от 5 000 ₽</span>

                        <a href="#contacts"
                        data-goal="urgent_help_cta_click"
                        class="text-sm text-text-secondary hover:text-accent transition">
                            Обсудить →
                        </a>
                    </div>
                </div>

                <!-- 3. Доработка сайта -->
                <div class="group bg-card p-8 rounded-3xl border border-white/5 hover:border-accent/30 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-accent/10">
                    <div class="w-14 h-14 rounded-2xl bg-accent/10 flex items-center justify-center mb-6 group-hover:bg-accent/20 transition">
                        <span class="text-2xl">🛠️</span>
                    </div>

                    <h3 class="text-xl font-bold mb-3">
                        Доработка сайта и интернет-магазина
                    </h3>

                    <p class="text-text-secondary text-sm mb-4">
                        Добавлю нужный функционал или изменю существующий проект под новые задачи.
                    </p>

                    <ul class="text-sm text-text-secondary space-y-2 mb-6">
                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Каталог, формы, личный кабинет, корзина</span>
                        </li>

                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Изменение логики и бизнес-процессов</span>
                        </li>

                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Разбор и аккуратная работа с чужим кодом</span>
                        </li>
                    </ul>

                    <div class="pt-4 border-t border-white/5 flex justify-between items-center">
                        <span class="text-accent font-bold">от 15 000 ₽</span>

                        <a href="#contacts"
                        data-goal="development_cta_click"
                        class="text-sm text-text-secondary hover:text-accent transition">
                            Обсудить →
                        </a>
                    </div>
                </div>

                <!-- 4. Создание нового проекта -->
                <div class="group bg-card p-8 rounded-3xl border border-white/5 hover:border-accent/30 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-accent/10">
                    <div class="w-14 h-14 rounded-2xl bg-accent/10 flex items-center justify-center mb-6 group-hover:bg-accent/20 transition">
                        <span class="text-2xl">🚀</span>
                    </div>

                    <h3 class="text-xl font-bold mb-3">
                        Создание сайта или веб-сервиса
                    </h3>

                    <p class="text-text-secondary text-sm mb-4">
                        Если проекта ещё нет или старый проще заменить — можно сделать новое решение с нуля.
                    </p>

                    <ul class="text-sm text-text-secondary space-y-2 mb-6">
                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Сайты и интернет-магазины</span>
                        </li>

                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Личные кабинеты и внутренние системы</span>
                        </li>

                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Небольшие веб-сервисы под конкретную задачу</span>
                        </li>
                    </ul>

                    <div class="pt-4 border-t border-white/5 flex justify-between items-center">
                        <span class="text-accent font-bold">по оценке</span>

                        <a href="#contacts"
                        data-goal="new_project_cta_click"
                        class="text-sm text-text-secondary hover:text-accent transition">
                            Обсудить →
                        </a>
                    </div>
                </div>

                <!-- 5. Интеграции -->
                <div class="group bg-card p-8 rounded-3xl border border-white/5 hover:border-accent/30 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-accent/10">
                    <div class="w-14 h-14 rounded-2xl bg-accent/10 flex items-center justify-center mb-6 group-hover:bg-accent/20 transition">
                        <span class="text-2xl">🔗</span>
                    </div>

                    <h3 class="text-xl font-bold mb-3">
                        Интеграции и автоматизация
                    </h3>

                    <p class="text-text-secondary text-sm mb-4">
                        Свяжу сайт с другими системами и помогу убрать лишнюю ручную работу.
                    </p>

                    <ul class="text-sm text-text-secondary space-y-2 mb-6">
                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>CRM, 1С, оплата и доставка</span>
                        </li>

                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Внешние API и сервисы</span>
                        </li>

                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Автоматизация регулярных операций</span>
                        </li>
                    </ul>

                    <div class="pt-4 border-t border-white/5 flex justify-between items-center">
                        <span class="text-accent font-bold">от 20 000 ₽</span>

                        <a href="#contacts"
                        data-goal="integration_cta_click"
                        class="text-sm text-text-secondary hover:text-accent transition">
                            Обсудить →
                        </a>
                    </div>
                </div>

                <!-- 6. Сопровождение -->
                <div class="group bg-card p-8 rounded-3xl border border-white/5 hover:border-accent/30 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-accent/10">
                    <div class="w-14 h-14 rounded-2xl bg-accent/10 flex items-center justify-center mb-6 group-hover:bg-accent/20 transition">
                        <span class="text-2xl">🛡️</span>
                    </div>

                    <h3 class="text-xl font-bold mb-3">
                        Сопровождение и развитие сайта
                    </h3>

                    <p class="text-text-secondary text-sm mb-4">
                        Для проектов, которым регулярно нужны доработки, контроль и помощь специалиста.
                    </p>

                    <ul class="text-sm text-text-secondary space-y-2 mb-6">
                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Регулярные задачи и исправления</span>
                        </li>

                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Небольшие и крупные доработки</span>
                        </li>

                        <li class="flex items-start gap-2">
                            <span class="text-accent mt-0.5">→</span>
                            <span>Не нужно искать нового исполнителя под каждую задачу</span>
                        </li>
                    </ul>

                    <div class="pt-4 border-t border-white/5 flex justify-between items-center">
                        <span class="text-accent font-bold">от 15 000 ₽/мес</span>

                        <a href="#contacts"
                        data-goal="maintenance_cta_click"
                        class="text-sm text-text-secondary hover:text-accent transition">
                            Обсудить →
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Смежные задачи -->
    <section class="py-20 bg-card/30">
        <div class="container">

            <div class="max-w-3xl mx-auto text-center mb-12">
                <div class="inline-flex items-center px-4 py-2 bg-accent/10 border border-accent/30 rounded-full mb-6">
                    <span class="text-accent font-medium">Не только разработка</span>
                </div>

                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    Могу помочь и со смежными задачами
                </h2>

                <p class="text-text-secondary text-lg">
                    Иногда сайт технически работает, но проблема находится в аналитике,
                    SEO, структуре страниц или в том, как настроена реклама.
                    В таких случаях могу посмотреть на проект шире и помочь найти слабое место.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-5xl mx-auto">

                <!-- SEO -->
                <div class="bg-card p-6 rounded-2xl border border-white/5">
                    <div class="text-2xl mb-4">🔎</div>

                    <h3 class="font-bold text-lg mb-2">
                        SEO и структура сайта
                    </h3>

                    <p class="text-sm text-text-secondary">
                        Технические ошибки, метатеги, страницы, структура,
                        внутренняя перелинковка и базовая работа с семантикой.
                    </p>
                </div>

                <!-- Аналитика -->
                <div class="bg-card p-6 rounded-2xl border border-white/5">
                    <div class="text-2xl mb-4">📊</div>

                    <h3 class="font-bold text-lg mb-2">
                        Метрика и аналитика
                    </h3>

                    <p class="text-sm text-text-secondary">
                        Цели, события, заявки, заказы, e-commerce и проверка того,
                        правильно ли вообще собираются данные.
                    </p>
                </div>

                <!-- Реклама -->
                <div class="bg-card p-6 rounded-2xl border border-white/5">
                    <div class="text-2xl mb-4">📣</div>

                    <h3 class="font-bold text-lg mb-2">
                        Реклама и посадочные страницы
                    </h3>

                    <p class="text-sm text-text-secondary">
                        Могу посмотреть рекламный трафик, посадочные страницы,
                        связку объявлений с сайтом и базовые проблемы настройки.
                    </p>
                </div>

                <!-- Контент -->
                <div class="bg-card p-6 rounded-2xl border border-white/5">
                    <div class="text-2xl mb-4">✍️</div>

                    <h3 class="font-bold text-lg mb-2">
                        Контент и подача информации
                    </h3>

                    <p class="text-sm text-text-secondary">
                        Структура страниц, тексты, понятность предложения
                        и то, насколько сайт отвечает на вопросы клиента.
                    </p>
                </div>

                <!-- Данные -->
                <div class="bg-card p-6 rounded-2xl border border-white/5">
                    <div class="text-2xl mb-4">🧩</div>

                    <h3 class="font-bold text-lg mb-2">
                        Данные и отчёты
                    </h3>

                    <p class="text-sm text-text-secondary">
                        Помогу собрать данные из сайта или других систем,
                        привести их в порядок и получить понятный отчёт.
                    </p>
                </div>

                <!-- Общая диагностика -->
                <div class="bg-card p-6 rounded-2xl border border-white/5">
                    <div class="text-2xl mb-4">🧭</div>

                    <h3 class="font-bold text-lg mb-2">
                        Что улучшать в первую очередь
                    </h3>

                    <p class="text-sm text-text-secondary">
                        Если проблем много, помогу разделить их на критичные,
                        важные и те, которые можно спокойно отложить.
                    </p>
                </div>

            </div>

            <div class="max-w-3xl mx-auto mt-10 text-center">
                <p class="text-sm text-text-tertiary">
                    Это дополнительные направления, а не попытка заменить профильного SEO-специалиста,
                    маркетолога или аналитика там, где нужна глубокая узкая экспертиза.
                </p>
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

            <div class="max-w-3xl mx-auto text-center mb-12">
                <div class="inline-flex items-center px-4 py-2 bg-accent/10 border border-accent/30 rounded-full mb-6">
                    <span class="text-accent font-medium">Реальные проекты</span>
                </div>

                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    Кейсы
                </h2>

                <p class="text-text-secondary text-lg">
                    Примеры проектов, где нужно было разобраться в существующей системе,
                    исправить проблемы, добавить новый функционал или создать решение с нуля.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach($cases as $case)

                    <article
                        class="group bg-card rounded-3xl overflow-hidden border border-white/5
                            hover:border-accent/30 transition-all duration-300
                            hover:-translate-y-2 hover:shadow-2xl hover:shadow-accent/10"
                    >

                        <!-- Верхняя часть -->
                        <div class="h-52 bg-gradient-to-br from-accent/20 to-accent2/10
                                    flex flex-col items-center justify-center p-6">

                            <div class="w-20 h-20 rounded-2xl bg-card/40 backdrop-blur-sm
                                        border border-white/10 flex items-center justify-center mb-4
                                        group-hover:scale-110 transition-transform duration-300">

                                <span class="text-2xl font-bold text-white">
                                    {{ Str::upper(Str::substr($case->title_short ?: $case->title, 0, 2)) }}
                                </span>

                            </div>

                            <h3 class="text-xl font-bold text-center text-white">
                                {{ $case->title_short ?: $case->title }}
                            </h3>

                            @if($case->duration)
                                <div class="text-sm text-white/60 mt-2">
                                    {{ $case->duration }}
                                </div>
                            @endif

                        </div>

                        <!-- Содержание -->
                        <div class="p-6">

                            <!-- Задача -->
                            @if($case->task)
                                <div class="mb-5">
                                    <div class="text-xs uppercase tracking-wide text-text-tertiary mb-2">
                                        Задача
                                    </div>

                                    <p class="text-text-secondary text-sm leading-relaxed">
                                        {{ Str::limit($case->task, 145) }}
                                    </p>
                                </div>
                            @endif

                            <!-- Результат -->
                            @if($case->result)
                                <div class="mb-5">
                                    <div class="text-xs uppercase tracking-wide text-text-tertiary mb-2">
                                        Результат
                                    </div>

                                    <p class="text-text-secondary text-sm leading-relaxed">
                                        {{ Str::limit($case->result, 145) }}
                                    </p>
                                </div>
                            @endif

                            <!-- Теги -->
                            @if(is_array($case->tags) && count($case->tags) > 0)
                                <div class="flex flex-wrap gap-2 mb-5">

                                    @foreach(array_slice($case->tags, 0, 3) as $tag)
                                        <span class="px-3 py-1 bg-background/50 rounded-lg text-xs text-text-tertiary">
                                            {{ $tag }}
                                        </span>
                                    @endforeach

                                    @if(count($case->tags) > 3)
                                        <span class="px-3 py-1 bg-background/50 rounded-lg text-xs text-text-tertiary">
                                            +{{ count($case->tags) - 3 }}
                                        </span>
                                    @endif

                                </div>
                            @endif

                            <!-- Сайт проекта -->
                            @if($case->website)
                                <div class="mb-5">
                                    <a
                                        href="{{ $case->website }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="inline-flex items-center gap-2 text-sm text-text-secondary hover:text-accent transition"
                                    >
                                        Посмотреть проект
                                        <span>↗</span>
                                    </a>
                                </div>
                            @endif

                            <div class="flex justify-end items-center pt-4 border-t border-white/5">

                                <a
                                    href="{{ url('/cases/' . $case->slug) }}"
                                    data-goal="case_detail_click"
                                    class="text-accent text-sm font-medium inline-flex items-center gap-1
                                        group-hover:translate-x-1 transition-transform"
                                >
                                    Подробнее
                                    <span>→</span>
                                </a>

                            </div>

                        </div>

                    </article>

                @endforeach

            </div>

            <div class="text-center mt-12 flex flex-wrap justify-center gap-3">

                <a
                    href="{{ url('/cases') }}"
                    class="inline-block px-8 py-4 border border-white/10 rounded-xl
                        hover:border-accent/40 hover:text-accent transition"
                >
                    Все кейсы
                </a>

                <a
                    href="#contacts"
                    data-goal="project_cta_click"
                    class="inline-block px-8 py-4 bg-accent text-background font-bold rounded-xl
                        hover:bg-accent/90 transition shadow-lg hover:shadow-xl"
                >
                    Обсудить задачу
                </a>

            </div>

        </div>
    </section>

    <!-- Стоимость -->
    <section id="prices" class="py-20 bg-card/30">
        <div class="container">

            <div class="text-center mb-12">

                <div class="inline-flex items-center px-4 py-2 bg-accent/10 border border-accent/30 rounded-full mb-6">
                    <span class="text-accent font-medium">
                        Ориентиры по стоимости
                    </span>
                </div>

                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    Стоимость
                </h2>

                <p class="text-text-secondary text-lg max-w-2xl mx-auto">
                    Итоговая цена зависит от состояния проекта и объёма работы.
                    Ниже — ориентиры, чтобы заранее понимать порядок стоимости.
                </p>

            </div>


            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">


                <!-- 1. Диагностика -->
                <div class="bg-card p-6 rounded-2xl border border-white/5 hover:border-accent/30 transition-all duration-300 hover:-translate-y-1">

                    <div class="flex items-center justify-between mb-4">
                        <span class="text-3xl">🔍</span>
                        <span class="text-accent font-bold text-2xl">
                            от 5 000 ₽
                        </span>
                    </div>

                    <h3 class="text-xl font-bold mb-2">
                        Диагностика сайта
                    </h3>

                    <p class="text-text-secondary text-sm mb-4">
                        Разберусь в проекте, найду основные проблемы и определю,
                        что имеет смысл исправлять в первую очередь.
                    </p>

                    <p class="text-text-tertiary text-xs">
                        Подходит, если пока непонятно, где именно проблема
                    </p>

                </div>


                <!-- 2. Срочная помощь -->
                <div class="bg-card p-6 rounded-2xl border border-white/5 hover:border-accent/30 transition-all duration-300 hover:-translate-y-1">

                    <div class="flex items-center justify-between mb-4">
                        <span class="text-3xl">⚡</span>
                        <span class="text-accent font-bold text-2xl">
                            от 5 000 ₽
                        </span>
                    </div>

                    <h3 class="text-xl font-bold mb-2">
                        Срочная помощь сайту
                    </h3>

                    <p class="text-text-secondary text-sm mb-4">
                        Поиск и исправление ошибок, из-за которых сайт
                        или отдельные важные функции перестали работать.
                    </p>

                    <p class="text-text-tertiary text-xs">
                        Ошибки, формы, заявки, корзина, оплата и другие сбои
                    </p>

                </div>


                <!-- 3. Доработка -->
                <div class="bg-card p-6 rounded-2xl border border-white/5 hover:border-accent/30 transition-all duration-300 hover:-translate-y-1">

                    <div class="flex items-center justify-between mb-4">
                        <span class="text-3xl">🛠️</span>
                        <span class="text-accent font-bold text-2xl">
                            от 15 000 ₽
                        </span>
                    </div>

                    <h3 class="text-xl font-bold mb-2">
                        Доработка сайта
                    </h3>

                    <p class="text-text-secondary text-sm mb-4">
                        Новый функционал, изменение существующей логики,
                        интерфейса, каталога, форм или других частей проекта.
                    </p>

                    <p class="text-text-tertiary text-xs">
                        Стоимость зависит от количества и сложности доработок
                    </p>

                </div>


                <!-- 4. Интеграции -->
                <div class="bg-card p-6 rounded-2xl border border-white/5 hover:border-accent/30 transition-all duration-300 hover:-translate-y-1">

                    <div class="flex items-center justify-between mb-4">
                        <span class="text-3xl">🔗</span>
                        <span class="text-accent font-bold text-2xl">
                            от 20 000 ₽
                        </span>
                    </div>

                    <h3 class="text-xl font-bold mb-2">
                        Интеграции и автоматизация
                    </h3>

                    <p class="text-text-secondary text-sm mb-4">
                        CRM, 1С, оплата, доставка, внешние API
                        и автоматизация ручных операций.
                    </p>

                    <p class="text-text-tertiary text-xs">
                        Простые и сложные интеграции оцениваются отдельно
                    </p>

                </div>


                <!-- 5. Создание проекта -->
                <div class="bg-card p-6 rounded-2xl border border-white/5 hover:border-accent/30 transition-all duration-300 hover:-translate-y-1">

                    <div class="flex items-center justify-between mb-4">
                        <span class="text-3xl">🚀</span>
                        <span class="text-accent font-bold text-xl">
                            По оценке
                        </span>
                    </div>

                    <h3 class="text-xl font-bold mb-2">
                        Сайт или веб-сервис с нуля
                    </h3>

                    <p class="text-text-secondary text-sm mb-4">
                        Проектирование и разработка нового сайта,
                        интернет-магазина или веб-сервиса под задачу бизнеса.
                    </p>

                    <p class="text-text-tertiary text-xs">
                        Сначала определяем задачи и объём проекта
                    </p>

                </div>


                <!-- 6. Сопровождение -->
                <div class="bg-card p-6 rounded-2xl border border-white/5 hover:border-accent/30 transition-all duration-300 hover:-translate-y-1">

                    <div class="flex items-center justify-between mb-4">
                        <span class="text-3xl">🛡️</span>

                        <span class="text-accent font-bold text-2xl">
                            от 15 000 ₽
                            <span class="text-sm">/мес</span>
                        </span>
                    </div>

                    <h3 class="text-xl font-bold mb-2">
                        Сопровождение и развитие
                    </h3>

                    <p class="text-text-secondary text-sm mb-4">
                        Регулярные исправления, доработки и помощь с сайтом
                        без поиска нового исполнителя под каждую задачу.
                    </p>

                    <p class="text-text-tertiary text-xs">
                        Формат и объём работы согласовываются заранее
                    </p>

                </div>

            </div>


            <div class="text-center mt-12">

                <p class="text-text-tertiary text-sm mb-6">
                    Если задача нестандартная — сначала разберёмся,
                    что именно нужно сделать, после этого смогу назвать стоимость.
                </p>

                <a href="#contacts"
                data-goal="custom_task_cta_click"
                class="inline-block px-8 py-4 bg-accent text-background font-bold rounded-xl hover:bg-accent/90 transition shadow-lg hover:shadow-xl">

                    Описать задачу

                </a>

            </div>

        </div>
    </section>
    
    <!-- Как я работаю -->
    <section id="process" class="py-20">
        <div class="container">

            <div class="text-center mb-12">

                <div class="inline-flex items-center px-4 py-2 bg-accent/10 border border-accent/30 rounded-full mb-6">
                    <span class="text-accent font-medium">
                        Понятный процесс
                    </span>
                </div>

                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    Как я работаю
                </h2>

                <p class="text-text-secondary text-lg max-w-2xl mx-auto">
                    Сначала разбираюсь в задаче и проекте, затем согласовываем решение,
                    стоимость и порядок работы. Дальше вы понимаете, что происходит на каждом этапе.
                </p>

            </div>


            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Шаг 1 -->
                <div class="bg-card p-6 rounded-2xl border border-white/5">

                    <div class="w-8 h-8 rounded-full bg-accent text-background flex items-center justify-center mb-4 font-bold">
                        1
                    </div>

                    <h3 class="text-xl font-bold mb-3">
                        Разбираюсь в задаче
                    </h3>

                    <p class="text-text-secondary">
                        Уточняю, что нужно получить в итоге, смотрю существующий проект
                        и задаю вопросы, если без них нельзя правильно оценить работу.
                    </p>

                </div>


                <!-- Шаг 2 -->
                <div class="bg-card p-6 rounded-2xl border border-white/5">

                    <div class="w-8 h-8 rounded-full bg-accent text-background flex items-center justify-center mb-4 font-bold">
                        2
                    </div>

                    <h3 class="text-xl font-bold mb-3">
                        Предлагаю решение
                    </h3>

                    <p class="text-text-secondary">
                        Объясняю, что имеет смысл сделать, какие есть варианты
                        и где можно обойтись без лишней разработки.
                    </p>

                </div>


                <!-- Шаг 3 -->
                <div class="bg-card p-6 rounded-2xl border border-white/5">

                    <div class="w-8 h-8 rounded-full bg-accent text-background flex items-center justify-center mb-4 font-bold">
                        3
                    </div>

                    <h3 class="text-xl font-bold mb-3">
                        Согласовываем работу
                    </h3>

                    <p class="text-text-secondary">
                        Определяем объём, стоимость, сроки и порядок оплаты.
                        Для крупных задач работу можно разделить на несколько этапов.
                    </p>

                </div>


                <!-- Шаг 4 -->
                <div class="bg-card p-6 rounded-2xl border border-white/5">

                    <div class="w-8 h-8 rounded-full bg-accent text-background flex items-center justify-center mb-4 font-bold">
                        4
                    </div>

                    <h3 class="text-xl font-bold mb-3">
                        Делаю и тестирую
                    </h3>

                    <p class="text-text-secondary">
                        Выполняю работу, проверяю результат и по ходу сообщаю
                        о важных изменениях, вопросах или найденных проблемах.
                    </p>

                </div>


                <!-- Шаг 5 -->
                <div class="bg-card p-6 rounded-2xl border border-white/5">

                    <div class="w-8 h-8 rounded-full bg-accent text-background flex items-center justify-center mb-4 font-bold">
                        5
                    </div>

                    <h3 class="text-xl font-bold mb-3">
                        Проверяем результат
                    </h3>

                    <p class="text-text-secondary">
                        Показываю, что сделано, проверяем работу на реальном проекте
                        и при необходимости вносим согласованные корректировки.
                    </p>

                </div>


                <!-- Шаг 6 -->
                <div class="bg-card p-6 rounded-2xl border border-white/5">

                    <div class="w-8 h-8 rounded-full bg-accent text-background flex items-center justify-center mb-4 font-bold">
                        6
                    </div>

                    <h3 class="text-xl font-bold mb-3">
                        Продолжаем при необходимости
                    </h3>

                    <p class="text-text-secondary">
                        После завершения задачи можно обращаться с новыми доработками
                        или перейти на регулярное сопровождение проекта.
                    </p>

                </div>

            </div>

        </div>
    </section>
    
    <!-- С чем работаю -->
    <section class="py-20">
        <div class="container">

            <div class="text-center mb-12">

                <div class="inline-flex items-center px-4 py-2 bg-accent/10 border border-accent/30 rounded-full mb-6">
                    <span class="text-accent font-medium">
                        Техническая база
                    </span>
                </div>

                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    С какими проектами и технологиями работаю
                </h2>

                <p class="text-text-secondary text-lg max-w-2xl mx-auto">
                    Основной опыт — PHP-проекты и интернет-магазины.
                    При работе с существующим сайтом важнее не конкретная CMS,
                    а возможность разобраться в его устройстве и аккуратно продолжить развитие.
                </p>

            </div>


            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">

                <!-- Основной стек -->
                <div class="bg-card p-6 rounded-2xl border border-white/5">

                    <div class="text-3xl mb-4">
                        🧩
                    </div>

                    <h3 class="text-xl font-bold mb-3">
                        Основной стек
                    </h3>

                    <p class="text-text-secondary mb-4">
                        Технологии, с которыми работаю наиболее уверенно.
                    </p>

                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-background/50 rounded-lg text-sm text-text-secondary">PHP</span>
                        <span class="px-3 py-1 bg-background/50 rounded-lg text-sm text-text-secondary">MySQL</span>
                        <span class="px-3 py-1 bg-background/50 rounded-lg text-sm text-text-secondary">JavaScript</span>
                        <span class="px-3 py-1 bg-background/50 rounded-lg text-sm text-text-secondary">HTML / CSS</span>
                    </div>

                </div>


                <!-- CMS и проекты -->
                <div class="bg-card p-6 rounded-2xl border border-white/5">

                    <div class="text-3xl mb-4">
                        🛒
                    </div>

                    <h3 class="text-xl font-bold mb-3">
                        CMS и существующие проекты
                    </h3>

                    <p class="text-text-secondary mb-4">
                        Могу работать как с хорошо знакомыми системами,
                        так и разбираться в уже существующем проекте.
                    </p>

                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-background/50 rounded-lg text-sm text-text-secondary">OpenCart</span>
                        <span class="px-3 py-1 bg-background/50 rounded-lg text-sm text-text-secondary">MODX</span>
                        <span class="px-3 py-1 bg-background/50 rounded-lg text-sm text-text-secondary">WordPress</span>
                        <span class="px-3 py-1 bg-background/50 rounded-lg text-sm text-text-secondary">Самописные сайты</span>
                    </div>

                </div>


                <!-- Frameworks -->
                <div class="bg-card p-6 rounded-2xl border border-white/5">

                    <div class="text-3xl mb-4">
                        ⚙️
                    </div>

                    <h3 class="text-xl font-bold mb-3">
                        Фреймворки и современные проекты
                    </h3>

                    <p class="text-text-secondary mb-4">
                        Есть опыт и понимание проектов на современных
                        backend- и frontend-инструментах.
                    </p>

                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-background/50 rounded-lg text-sm text-text-secondary">Laravel</span>
                        <span class="px-3 py-1 bg-background/50 rounded-lg text-sm text-text-secondary">Vue</span>
                        <span class="px-3 py-1 bg-background/50 rounded-lg text-sm text-text-secondary">Tailwind</span>
                        <span class="px-3 py-1 bg-background/50 rounded-lg text-sm text-text-secondary">Git</span>
                    </div>

                </div>


                <!-- Интеграции -->
                <div class="bg-card p-6 rounded-2xl border border-white/5">

                    <div class="text-3xl mb-4">
                        🔌
                    </div>

                    <h3 class="text-xl font-bold mb-3">
                        Интеграции
                    </h3>

                    <p class="text-text-secondary mb-4">
                        Связь сайта с внешними системами и сервисами.
                    </p>

                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-background/50 rounded-lg text-sm text-text-secondary">REST API</span>
                        <span class="px-3 py-1 bg-background/50 rounded-lg text-sm text-text-secondary">1С</span>
                        <span class="px-3 py-1 bg-background/50 rounded-lg text-sm text-text-secondary">CRM</span>
                        <span class="px-3 py-1 bg-background/50 rounded-lg text-sm text-text-secondary">Оплата</span>
                        <span class="px-3 py-1 bg-background/50 rounded-lg text-sm text-text-secondary">Доставка</span>
                    </div>

                </div>


                <!-- Сервер -->
                <div class="bg-card p-6 rounded-2xl border border-white/5">

                    <div class="text-3xl mb-4">
                        🖥️
                    </div>

                    <h3 class="text-xl font-bold mb-3">
                        Серверная часть
                    </h3>

                    <p class="text-text-secondary mb-4">
                        Могу работать не только с кодом сайта,
                        но и с его окружением.
                    </p>

                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-background/50 rounded-lg text-sm text-text-secondary">Linux</span>
                        <span class="px-3 py-1 bg-background/50 rounded-lg text-sm text-text-secondary">Nginx</span>
                        <span class="px-3 py-1 bg-background/50 rounded-lg text-sm text-text-secondary">PHP-FPM</span>
                        <span class="px-3 py-1 bg-background/50 rounded-lg text-sm text-text-secondary">MySQL</span>
                    </div>

                </div>


                <!-- Аналитика -->
                <div class="bg-card p-6 rounded-2xl border border-white/5">

                    <div class="text-3xl mb-4">
                        📊
                    </div>

                    <h3 class="text-xl font-bold mb-3">
                        Аналитика и данные
                    </h3>

                    <p class="text-text-secondary mb-4">
                        Техническая настройка аналитики и работа с данными сайта.
                    </p>

                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-background/50 rounded-lg text-sm text-text-secondary">Яндекс.Метрика</span>
                        <span class="px-3 py-1 bg-background/50 rounded-lg text-sm text-text-secondary">E-commerce</span>
                        <span class="px-3 py-1 bg-background/50 rounded-lg text-sm text-text-secondary">Excel / CSV</span>
                        <span class="px-3 py-1 bg-background/50 rounded-lg text-sm text-text-secondary">Python</span>
                    </div>

                </div>

            </div>

        </div>
    </section>

    @include('components.brands-carousel')
    
    <!-- Контакты -->
    <section id="contacts" class="py-20 bg-card/30">
        <div class="container">

            <div class="text-center mb-12">

                <div class="inline-flex items-center px-4 py-2 bg-accent/10 border border-accent/30 rounded-full mb-6">
                    <span class="text-accent font-medium">
                        Обсудить задачу
                    </span>
                </div>

                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    Расскажите, что нужно сделать
                </h2>

                <p class="text-center text-text-secondary text-lg max-w-2xl mx-auto">
                    Можно описать проблему своими словами.
                    Не обязательно заранее понимать, какая технология нужна и как именно её решать.
                </p>

            </div>


            <div class="grid md:grid-cols-2 gap-12 max-w-6xl mx-auto">

                <!-- Форма -->
                <div class="bg-card p-8 rounded-3xl border border-white/5">

                    <form id="contact-form" class="space-y-6" novalidate>

                        @csrf

                        <div>
                            <label class="block text-text-secondary mb-2">
                                Имя *
                            </label>

                            <input type="text"
                                name="name"
                                required
                                minlength="2"
                                maxlength="255"
                                class="w-full px-4 py-3 bg-background border border-white/10 rounded-xl text-white placeholder:text-text-tertiary focus:outline-none focus:border-accent2 transition"
                                placeholder="Ваше имя">

                            <div class="text-xs text-text-tertiary mt-1">
                                Минимум 2 символа
                            </div>
                        </div>


                        <div>
                            <label class="block text-text-secondary mb-2">
                                Как с вами связаться *
                            </label>

                            <input type="text"
                                name="contact"
                                required
                                minlength="5"
                                maxlength="255"
                                class="w-full px-4 py-3 bg-background border border-white/10 rounded-xl text-white placeholder:text-text-tertiary focus:outline-none focus:border-accent2 transition"
                                placeholder="Telegram, email или телефон">

                            <div class="text-xs text-text-tertiary mt-1">
                                Например: @username, email@example.com или +79991234567
                            </div>
                        </div>


                        <div>
                            <label class="block text-text-secondary mb-2">
                                Ссылка на сайт
                            </label>

                            <input type="url"
                                name="website"
                                pattern="https?://.+"
                                maxlength="255"
                                class="w-full px-4 py-3 bg-background border border-white/10 rounded-xl text-white placeholder:text-text-tertiary focus:outline-none focus:border-accent2 transition"
                                placeholder="https://ваш-сайт.ru">

                            <div class="text-xs text-text-tertiary mt-1">
                                Если сайт уже существует
                            </div>
                        </div>


                        <div>
                            <label class="block text-text-secondary mb-2">
                                Что нужно сделать *
                            </label>

                            <textarea rows="5"
                                    name="message"
                                    required
                                    minlength="10"
                                    maxlength="2000"
                                    class="w-full px-4 py-3 bg-background border border-white/10 rounded-xl text-white placeholder:text-text-tertiary focus:outline-none focus:border-accent2 transition"
                                    placeholder="Опишите задачу, проблему или желаемый результат"></textarea>

                            <div class="text-xs text-text-tertiary mt-1">
                                Можно написать в свободной форме
                            </div>
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

                                    <a href="/policy"
                                    target="_blank"
                                    class="text-accent hover:underline">
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

                            Отправить задачу

                        </button>


                        <p class="text-center text-text-secondary text-sm">
                            Обычно отвечаю в течение рабочего дня
                        </p>

                    </form>

                </div>


                <!-- Правая колонка -->
                <div class="space-y-8">

                    <!-- Контакты -->
                    <div class="bg-card p-8 rounded-3xl border border-white/5">

                        <h3 class="text-xl font-bold mb-6">
                            Можно написать напрямую
                        </h3>

                        <div class="space-y-4">

                            <a href="https://t.me/artem_fullstack"
                            target="_blank"
                            data-goal="telegram_click"
                            class="flex items-center space-x-3 text-text-secondary hover:text-accent2 transition">

                                <span class="text-2xl">📱</span>

                                <div>
                                    <div class="font-bold text-text-primary">
                                        Telegram
                                    </div>

                                    <div class="text-sm">
                                        @artem_fullstack
                                    </div>
                                </div>

                            </a>


                            <a href="mailto:web@code-doctor.ru"
                            data-goal="email_click"
                            class="flex items-center space-x-3 text-text-secondary hover:text-accent2 transition">

                                <span class="text-2xl">✉️</span>

                                <div>
                                    <div class="font-bold text-text-primary">
                                        Email
                                    </div>

                                    <div class="text-sm">
                                        web@code-doctor.ru
                                    </div>
                                </div>

                            </a>

                        </div>

                    </div>


                    <!-- Что можно прислать -->
                    <div class="bg-card p-8 rounded-3xl border border-white/5">

                        <h3 class="text-xl font-bold mb-6">
                            Что желательно указать
                        </h3>

                        <div class="space-y-4">

                            <div class="flex items-start space-x-3">
                                <span class="text-accent text-xl">→</span>

                                <span class="text-text-secondary">
                                    Ссылку на сайт, если проект уже существует
                                </span>
                            </div>


                            <div class="flex items-start space-x-3">
                                <span class="text-accent text-xl">→</span>

                                <span class="text-text-secondary">
                                    Что сейчас не работает или что хотите изменить
                                </span>
                            </div>


                            <div class="flex items-start space-x-3">
                                <span class="text-accent text-xl">→</span>

                                <span class="text-text-secondary">
                                    Какой результат хотите получить
                                </span>
                            </div>


                            <div class="flex items-start space-x-3">
                                <span class="text-accent text-xl">→</span>

                                <span class="text-text-secondary">
                                    Если задача срочная — просто укажите это в сообщении
                                </span>
                            </div>

                        </div>

                    </div>


                    <!-- Как начинается работа -->
                    <div class="bg-card p-8 rounded-3xl border border-white/5">

                        <h3 class="text-xl font-bold mb-4">
                            Что будет дальше
                        </h3>

                        <p class="text-text-secondary">
                            Сначала посмотрю задачу и задам вопросы, если чего-то не хватает.
                            После этого смогу сказать, могу ли помочь, что лучше сделать
                            и какой порядок стоимости ожидать.
                        </p>

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