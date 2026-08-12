<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- SEO -->
    <title>@yield('title', 'Разработка, доработка и поддержка сайтов — Code Doctor')</title>

    <meta
        name="description"
        content="@yield('description', 'Диагностика, разработка, доработка и сопровождение сайтов и интернет-магазинов. Интеграции, автоматизация, аналитика и работа с веб-проектами.')"
    >

    <!-- Icons -->
    <link rel="icon" type="image/png" href="/favicon.png">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <!-- Open Graph -->
    <meta
        property="og:title"
        content="@yield('title', 'Разработка, доработка и поддержка сайтов — Code Doctor')"
    >

    <meta
        property="og:description"
        content="@yield('description', 'Диагностика, разработка, доработка и сопровождение сайтов и интернет-магазинов. Интеграции, автоматизация, аналитика и работа с веб-проектами.')"
    >

    <meta
        property="og:image"
        content="@yield('og_image', url('/og-image.png'))"
    >

    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <meta
        property="og:image:alt"
        content="@yield('title', 'Разработка, доработка и поддержка сайтов — Code Doctor')"
    >

    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Code Doctor">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">

    <meta
        name="twitter:title"
        content="@yield('title', 'Разработка, доработка и поддержка сайтов — Code Doctor')"
    >

    <meta
        name="twitter:description"
        content="@yield('description', 'Диагностика, разработка, доработка и сопровождение сайтов и интернет-магазинов. Интеграции, автоматизация, аналитика и работа с веб-проектами.')"
    >

    <meta
        name="twitter:image"
        content="@yield('og_image', url('/og-image.png'))"
    >

    <meta
        name="twitter:image:alt"
        content="@yield('title', 'Разработка, доработка и поддержка сайтов — Code Doctor')"
    >

    <!-- Предзагрузка шрифтов -->
    <link
        rel="preload"
        href="{{ Vite::asset('resources/fonts/inter-regular.woff2') }}"
        as="font"
        type="font/woff2"
        crossorigin
    >

    <link
        rel="preload"
        href="{{ Vite::asset('resources/fonts/inter-bold.woff2') }}"
        as="font"
        type="font/woff2"
        crossorigin
    >

    <!-- CSS -->
    @vite(['resources/css/app.css'])

    <style>
        html {
            scroll-behavior: smooth;
            background-color: #0F1714;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            background-color: #0F1714;
            color: #FFFFFF;
            margin: 0;
            min-height: 100vh;
        }

        .fonts-loaded body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
        }
    </style>

</head>

<body class="font-sans bg-background text-text-primary">

    @php
        $servicesMenu = App\Models\Service::where('is_active', true)
            ->orderBy('sort')
            ->get();
    @endphp


    <!-- Preloader -->
    @include('components.preloader')


    <!-- Навигация -->
    <nav class="sticky top-0 z-50 bg-card/90 backdrop-blur-sm border-b border-white/10">

        <div class="container py-4">

            <div class="flex items-center justify-between">

                <!-- Logo -->
                <a href="/" class="flex items-center space-x-3 hover:opacity-90 transition">

                    <img
                        src="/images/favicon.webp"
                        alt="Code Doctor"
                        loading="eager"
                        width="80"
                        height="100"
                        class="w-10 md:w-20 object-contain"
                        decoding="async"
                    >

                    <div class="hidden sm:block">

                        <div class="font-semibold">
                            Code Doctor
                        </div>

                        <div class="text-sm text-text-secondary">
                            диагностика, разработка и развитие сайтов
                        </div>

                    </div>

                </a>


                <!-- Desktop -->
                <div class="hidden md:flex items-center space-x-8">

                    <!-- Услуги -->
                    <div class="relative group">

                        <button
                            class="flex items-center space-x-1 text-text-secondary hover:text-white transition"
                            type="button"
                        >

                            <span>Услуги</span>

                            <svg
                                class="w-4 h-4 transition-transform group-hover:rotate-180"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                ></path>
                            </svg>

                        </button>


                        <div
                            class="absolute top-full left-0 mt-2 w-72 bg-card rounded-2xl border border-white/10 shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform -translate-y-2 group-hover:translate-y-0 z-50"
                        >

                            <div class="p-2 max-h-96 overflow-y-auto">


                                <!-- Все услуги -->
                                <a
                                    href="{{ route('services.index') }}"
                                    class="flex items-center space-x-3 p-3 rounded-xl hover:bg-white/5 transition"
                                >

                                    <div class="w-8 h-8 rounded-lg bg-accent/10 flex items-center justify-center flex-shrink-0">
                                        <span class="text-accent text-xl">→</span>
                                    </div>

                                    <div>
                                        <div class="font-medium">
                                            Все услуги
                                        </div>

                                        <div class="text-xs text-text-secondary">
                                            Все направления работы
                                        </div>
                                    </div>

                                </a>


                                @foreach($servicesMenu as $menuService)

                                    <a
                                        href="{{ route('services.show', $menuService->slug) }}"
                                        data-goal="service_menu_click"
                                        data-service="{{ $menuService->slug }}"
                                        class="flex items-center space-x-3 p-3 rounded-xl hover:bg-white/5 transition"
                                    >

                                        <div class="w-8 h-8 rounded-lg bg-accent/10 flex items-center justify-center flex-shrink-0">

                                            @if($menuService->icon === 'opencart')

                                                @include('components.icons.opencart', ['class' => 'w-4 h-4'])

                                            @elseif($menuService->icon === 'lightning')

                                                @include('components.icons.lightning', ['class' => 'w-4 h-4'])

                                            @elseif($menuService->icon === 'tools')

                                                @include('components.icons.tools', ['class' => 'w-4 h-4'])

                                            @elseif($menuService->icon === 'shield')

                                                @include('components.icons.shield', ['class' => 'w-4 h-4'])

                                            @else

                                                <span class="text-accent text-xl">
                                                    {{ $menuService->icon_emoji ?? '🔧' }}
                                                </span>

                                            @endif

                                        </div>


                                        <div>

                                            <div class="font-medium">
                                                {{ $menuService->title }}
                                            </div>

                                            <div class="text-xs text-text-secondary line-clamp-1">
                                                {{ $menuService->short_description ?? 'Подробнее →' }}
                                            </div>

                                        </div>

                                    </a>

                                @endforeach

                            </div>

                        </div>

                    </div>


                    <a
                        href="{{ route('cases') }}"
                        data-goal="cases_click"
                        class="text-text-secondary hover:text-white transition whitespace-nowrap"
                    >
                        Кейсы
                    </a>


                    <a
                        href="{{ route('blog.index') }}"
                        class="text-text-secondary hover:text-white transition whitespace-nowrap"
                    >
                        Блог
                    </a>


                    <a
                        href="{{ url('/') }}#prices"
                        class="text-text-secondary hover:text-white transition whitespace-nowrap"
                    >
                        Стоимость
                    </a>


                    <a
                        href="{{ url('/') }}#contacts"
                        data-goal="contacts_click"
                        class="text-text-secondary hover:text-white transition whitespace-nowrap"
                    >
                        Контакты
                    </a>


                    <a
                        href="{{ url('/') }}#contacts"
                        data-goal="header_cta_click"
                        class="px-6 py-2 bg-accent text-background font-semibold rounded-xl hover:bg-accent/90 transition inline-block whitespace-nowrap"
                    >
                        Обсудить задачу
                    </a>

                </div>


                <!-- Мобильная кнопка -->
                <button
                    id="mobile-menu-button"
                    class="md:hidden p-2 z-50 relative"
                    type="button"
                    aria-label="Открыть меню"
                >

                    <svg
                        id="menu-icon"
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        ></path>
                    </svg>


                    <svg
                        id="close-icon"
                        class="w-6 h-6 hidden"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        ></path>
                    </svg>

                </button>

            </div>


            <!-- Mobile menu -->
            <div
                id="mobile-menu"
                class="md:hidden hidden fixed inset-0 top-[73px] bg-card z-40 overflow-y-auto h-screen"
            >

                <div class="container py-4 pb-32">

                    <div class="space-y-3">

                        <div class="pt-4 space-y-3 max-h-[80vh] overflow-y-auto">


                            <div class="text-text-tertiary text-sm font-medium px-1">
                                Навигация
                            </div>


                            <a
                                href="{{ route('services.index') }}"
                                class="block py-2 px-3 text-text-secondary hover:text-white transition hover:bg-white/5 rounded-lg"
                            >
                                Услуги
                            </a>


                            <a
                                href="{{ route('cases') }}"
                                data-goal="cases_click"
                                class="block py-2 px-3 text-text-secondary hover:text-white transition hover:bg-white/5 rounded-lg"
                            >
                                Кейсы
                            </a>


                            <a
                                href="{{ route('blog.index') }}"
                                class="block py-2 px-3 text-text-secondary hover:text-white transition hover:bg-white/5 rounded-lg"
                            >
                                Блог
                            </a>


                            <a
                                href="{{ url('/') }}#prices"
                                class="block py-2 px-3 text-text-secondary hover:text-white transition hover:bg-white/5 rounded-lg"
                            >
                                Стоимость
                            </a>


                            <a
                                href="{{ url('/') }}#process"
                                class="block py-2 px-3 text-text-secondary hover:text-white transition hover:bg-white/5 rounded-lg"
                            >
                                Как работаю
                            </a>


                            <div class="text-text-tertiary text-sm font-medium px-1 mt-4">
                                Все услуги
                            </div>


                            @foreach($servicesMenu as $menuService)

                                <a
                                    href="{{ route('services.show', $menuService->slug) }}"
                                    data-goal="service_menu_click"
                                    data-service="{{ $menuService->slug }}"
                                    class="block py-2 px-3 text-text-secondary hover:text-accent transition hover:bg-white/5 rounded-lg"
                                >
                                    {{ $menuService->title }}
                                </a>

                            @endforeach


                            <div class="text-text-tertiary text-sm font-medium px-1 mt-4">
                                Связь
                            </div>


                            <a
                                href="{{ url('/') }}#contacts"
                                data-goal="contacts_click"
                                class="block py-2 px-3 text-text-secondary hover:text-white transition hover:bg-white/5 rounded-lg"
                            >
                                Контакты
                            </a>


                            <a
                                href="{{ url('/') }}#contacts"
                                data-goal="header_cta_click"
                                class="w-full py-3 bg-accent text-background font-semibold rounded-xl hover:bg-accent/90 transition mt-2 inline-block text-center"
                            >
                                Обсудить задачу
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </nav>


    @yield('content')


    <!-- Footer -->
    <footer class="bg-card pt-4 pb-12">

        <div class="container">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">


                <!-- Code Doctor -->
                <div>

                    <h3 class="text-lg font-bold mb-4">
                        Code Doctor
                    </h3>


                    <p class="text-text-secondary text-sm mb-4 leading-relaxed">
                        Диагностика, разработка, доработка и сопровождение сайтов
                        и интернет-магазинов. Помогаю исправлять проблемы,
                        добавлять функционал и развивать веб-проекты.
                        Работаю с 2015 года.
                    </p>


                    <div class="flex space-x-4">

                        <a
                            href="https://t.me/artem_fullstack"
                            target="_blank"
                            rel="noopener noreferrer"
                            data-goal="telegram_click"
                            class="text-text-secondary hover:text-accent transition"
                            aria-label="Telegram"
                        >

                            <svg
                                class="w-5 h-5"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19-.14.75-.42 1-.68 1.03-.58.05-1.02-.38-1.58-.75-.88-.58-1.38-.94-2.23-1.5-.99-.65-.35-1.01.22-1.59.15-.15 2.71-2.48 2.76-2.69a.2.2 0 00-.05-.18c-.06-.05-.14-.03-.21-.02-.09.02-1.49.95-4.22 2.79-.4.27-.76.41-1.08.4-.36-.01-1.04-.2-1.55-.37-.63-.2-1.12-.31-1.08-.66.02-.18.27-.36.74-.55 2.92-1.27 4.86-2.11 5.83-2.51 2.78-1.16 3.35-1.36 3.73-1.36.08 0 .27.02.39.12.1.08.13.19.14.27-.01.06.01.24 0 .38z"/>
                            </svg>

                        </a>

                    </div>

                </div>


                <!-- Услуги -->
                <div>

                    <h3 class="text-lg font-bold mb-4">
                        Услуги
                    </h3>


                    <ul class="space-y-2">

                        @foreach($servicesMenu as $footerService)

                            <li>

                                <a
                                    href="{{ route('services.show', $footerService->slug) }}"
                                    class="text-text-secondary hover:text-accent transition text-sm"
                                >
                                    {{ $footerService->title }}
                                </a>

                            </li>

                        @endforeach

                    </ul>

                </div>


                <!-- Навигация -->
                <div>

                    <h3 class="text-lg font-bold mb-4">
                        Навигация
                    </h3>


                    <ul class="space-y-2">

                        <li>
                            <a
                                href="{{ route('services.index') }}"
                                class="text-text-secondary hover:text-accent transition text-sm"
                            >
                                Услуги
                            </a>
                        </li>


                        <li>
                            <a
                                href="{{ route('cases') }}"
                                data-goal="cases_click"
                                class="text-text-secondary hover:text-accent transition text-sm"
                            >
                                Кейсы
                            </a>
                        </li>


                        <li>
                            <a
                                href="{{ route('blog.index') }}"
                                class="text-text-secondary hover:text-accent transition text-sm"
                            >
                                Блог
                            </a>
                        </li>


                        <li>
                            <a
                                href="{{ url('/') }}#prices"
                                class="text-text-secondary hover:text-accent transition text-sm"
                            >
                                Стоимость
                            </a>
                        </li>


                        <li>
                            <a
                                href="{{ url('/') }}#process"
                                class="text-text-secondary hover:text-accent transition text-sm"
                            >
                                Как работаю
                            </a>
                        </li>


                        <li>
                            <a
                                href="{{ url('/') }}#contacts"
                                data-goal="contacts_click"
                                class="text-text-secondary hover:text-accent transition text-sm"
                            >
                                Контакты
                            </a>
                        </li>


                        <li>
                            <a
                                href="{{ route('policy') }}"
                                class="text-text-secondary hover:text-accent transition text-sm"
                            >
                                Политика конфиденциальности
                            </a>
                        </li>

                    </ul>

                </div>


                <!-- Контакты -->
                <div>

                    <h3 class="text-lg font-bold mb-4">
                        Контакты
                    </h3>


                    <ul class="space-y-3">

                        <li>

                            <a
                                href="mailto:web@code-doctor.ru"
                                data-goal="email_click"
                                class="text-text-secondary hover:text-accent transition text-sm flex items-center gap-2"
                            >

                                <svg
                                    class="w-4 h-4 flex-shrink-0"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                    ></path>
                                </svg>

                                <span>
                                    web@code-doctor.ru
                                </span>

                            </a>

                        </li>


                        <li>

                            <a
                                href="https://t.me/artem_fullstack"
                                target="_blank"
                                rel="noopener noreferrer"
                                data-goal="telegram_click"
                                class="text-text-secondary hover:text-accent transition text-sm flex items-center gap-2"
                            >

                                <svg
                                    class="w-4 h-4 flex-shrink-0"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19-.14.75-.42 1-.68 1.03-.58.05-1.02-.38-1.58-.75-.88-.58-1.38-.94-2.23-1.5-.99-.65-.35-1.01.22-1.59.15-.15 2.71-2.48 2.76-2.69a.2.2 0 00-.05-.18c-.06-.05-.14-.03-.21-.02-.09.02-1.49.95-4.22 2.79-.4.27-.76.41-1.08.4-.36-.01-1.04-.2-1.55-.37-.63-.2-1.12-.31-1.08-.66.02-.18.27-.36.74-.55 2.92-1.27 4.86-2.11 5.83-2.51 2.78-1.16 3.35-1.36 3.73-1.36.08 0 .27.02.39.12.1.08.13.19.14.27-.01.06.01.24 0 .38z"/>
                                </svg>

                                <span>
                                    @artem_fullstack
                                </span>

                            </a>

                        </li>

                    </ul>


                    <div class="mt-6 p-3 bg-background/50 rounded-xl">

                        <p class="text-xs text-text-secondary">
                            Работаю по договору. Обычно отвечаю в течение рабочего дня.
                        </p>

                    </div>

                </div>

            </div>


            <div class="pt-8 border-t border-white/10 text-center text-text-secondary text-sm">

                <p>
                    © {{ date('Y') }} Code Doctor — разработка, доработка и поддержка сайтов.
                </p>

            </div>

        </div>

    </footer>


    <!-- Cookie Consent -->
    @include('components.cookie-consent')


    <!-- Analytics -->
    <script>
        window.CODE_DOCTOR_ANALYTICS = {
            yandexMetrikaId: 106522615,
            googleAnalyticsId: 'G-520ZBJL5C9',
            debug: false,
            ecommerce: false
        };
    </script>


    @vite(['resources/js/app.js'])


    <script>
        setTimeout(() => {
            const script = document.createElement('script');
            script.src = '{{ Vite::asset("resources/js/deferred.js") }}';
            script.async = true;
            document.body.appendChild(script);
        }, 2000);
    </script>

</body>
</html>