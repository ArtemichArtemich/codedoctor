@extends('layouts.app')

@section('title', 'Результат проверки OpenCart‑сайта — ' . parse_url($url, PHP_URL_HOST) . ' | Code Doctor')
@section('description', 'Полный технический аудит интернет-магазина: PHP, SSL, безопасность, скорость, ошибки JS, открытые пути. Отчёт с рекомендациями.')

@section('content')
<div class="min-h-screen bg-background py-6 md:py16">
    <div class="container py-8 md:py-12">
        <!-- Навигация -->
        <div class="mb-8">
            <a href="{{ route('diagnostic.form') }}" 
               class="inline-flex items-center text-text-secondary hover:text-accent transition gap-2 group">
                <span class="transform group-hover:-translate-x-1 transition">←</span>
                <span>Проверить другой сайт</span>
            </a>
        </div>

        <!-- Хедер результата -->
        <div class="relative overflow-hidden mb-8">
            <div class="absolute inset-0 bg-gradient-to-r from-accent/5 via-transparent to-accent2/5 rounded-3xl blur-3xl"></div>
            <div class="relative bg-card/30 backdrop-blur-sm border border-white/5 rounded-3xl p-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <div class="inline-flex items-center px-4 py-2 bg-accent/10 border border-accent/30 rounded-full mb-4">
                            <span class="text-accent font-medium text-sm">Результат диагностики</span>
                        </div>
                        <h1 class="text-2xl md:text-3xl font-bold mb-2 break-all">
                            {{ parse_url($url, PHP_URL_HOST) }}
                        </h1>
                        <p class="text-text-secondary">{{ $url }}</p>
                    </div>
                    <div class="flex flex-col items-end">
                        <div class="px-4 py-2 bg-card rounded-xl border border-white/5">
                            <span class="text-sm text-text-secondary">Проверка от</span>
                            <span class="ml-2 font-medium">{{ now()->format('d.m.Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Общий скоринг -->
        @php
            $score = collect($checks)->filter(fn($c) => $c['status'] === 'good')->count();
            $total = count($checks);
            $percent = round(($score / $total) * 100);
        @endphp
        
        <div class="grid lg:grid-cols-3 gap-6 mb-8">
            <div class="lg:col-span-2">
                <div class="bg-card/30 backdrop-blur-sm border border-white/5 rounded-3xl p-6 h-full">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-accent/10 flex items-center justify-center">
                            <span class="text-2xl">🏥</span>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold">Общее состояние сайта</h2>
                            <p class="text-sm text-text-secondary">На основе {{ $total }} проверок</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-6">
                        <div class="relative">
                            <svg class="w-24 h-24">
                                <circle class="text-white/5" stroke-width="8" stroke="currentColor" fill="transparent" r="40" cx="48" cy="48"/>
                                <circle class="text-accent" stroke-width="8" stroke="currentColor" fill="transparent" r="40" cx="48" cy="48"
                                        stroke-dasharray="251.2" 
                                        stroke-dashoffset="{{ 251.2 - (251.2 * $percent / 100) }}"
                                        stroke-linecap="round"/>
                            </svg>
                            <span class="absolute inset-0 flex items-center justify-center text-2xl font-bold">{{ $percent }}%</span>
                        </div>
                        
                        <div class="space-y-1">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                <span class="text-sm">Отлично: {{ collect($checks)->where('status', 'good')->count() }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                                <span class="text-sm">Внимание: {{ collect($checks)->where('status', 'warning')->count() }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                <span class="text-sm">Критично: {{ collect($checks)->where('status', 'bad')->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div>
                <div class="bg-gradient-to-br from-accent/20 via-card to-accent2/20 border border-accent/30 rounded-3xl p-6 h-full">
                    <h3 class="font-bold mb-3">Следующий шаг</h3>
                    <p class="text-sm text-text-secondary mb-4">Получите полный аудит с автоматическими исправлениями прямо в админке</p>
                    <a href="#" 
                       class="inline-flex items-center justify-center w-full px-6 py-3 bg-accent text-background font-bold rounded-xl hover:bg-accent/90 transition shadow-lg hover:shadow-xl">
                        Установить модуль
                    </a>
                </div>
            </div>
        </div>

        <!-- Детальные проверки -->
        <div class="grid md:grid-cols-2 gap-6 mb-8">
            @foreach($checks as $key => $check)
                @php
                    $icons = [
                        'php_version' => '🐘',
                        'ssl' => '🔒',
                        'compression' => '🗜️',
                        'security_headers' => '🛡️',
                        'exposed_paths' => '🚪',
                        'viewport' => '📱',
                    ];
                    
                    $statusConfig = [
                        'good' => ['bg-green-500/10', 'border-green-500/30', 'text-green-500', '✓'],
                        'warning' => ['bg-yellow-500/10', 'border-yellow-500/30', 'text-yellow-500', '⚠'],
                        'bad' => ['bg-red-500/10', 'border-red-500/30', 'text-red-500', '✗'],
                        'error' => ['bg-gray-500/10', 'border-gray-500/30', 'text-gray-500', '?'],
                        'unknown' => ['bg-gray-500/10', 'border-gray-500/30', 'text-gray-500', '?'],
                    ];
                    $status = $statusConfig[$check['status']] ?? $statusConfig['unknown'];
                @endphp

                <div class="group bg-card/30 backdrop-blur-sm border border-white/5 hover:border-accent/30 rounded-3xl p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl hover:shadow-accent/10">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-2xl {{ $status[0] }} border {{ $status[1] }} flex items-center justify-center text-2xl">
                            {{ $icons[$key] ?? '🔍' }}
                        </div>
                        
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="font-bold">
                                    {{ [
                                        'php_version' => 'Версия PHP',
                                        'ssl' => 'SSL-сертификат',
                                        'compression' => 'Сжатие данных',
                                        'security_headers' => 'Заголовки безопасности',
                                        'exposed_paths' => 'Открытые директории',
                                        'viewport' => 'Адаптация под мобильные',
                                    ][$key] ?? $key }}
                                </h3>
                                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $status[0] }} {{ $status[2] }} border {{ $status[1] }}">
                                    {{ $status[3] }} {{ $check['value'] }}
                                </span>
                            </div>
                            
                            @if(!empty($check['message']))
                                <p class="text-sm text-text-secondary mb-3">{{ $check['message'] }}</p>
                            @endif
                            
                            @if(!empty($check['details']))
                                <details class="text-sm">
                                    <summary class="text-accent cursor-pointer hover:opacity-80 inline-flex items-center gap-1">
                                        Подробнее
                                        <span class="transform group-open:rotate-180 transition">▼</span>
                                    </summary>
                                    <div class="mt-3 p-4 bg-card rounded-xl border border-white/5">
                                        @if(is_array($check['details']))
                                            <ul class="space-y-1">
                                                @foreach($check['details'] as $detail)
                                                    <li class="text-text-secondary flex items-start gap-2">
                                                        <span class="text-accent">—</span>
                                                        <span>{{ $detail }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p class="text-text-secondary">{{ $check['details'] }}</p>
                                        @endif
                                        
                                        @if($key === 'security_headers' && is_array($check['details']))
                                            <div class="mt-3 pt-3 border-t border-white/5">
                                                <span class="text-xs font-medium text-accent">Установленные заголовки:</span>
                                                <ul class="mt-2 space-y-1">
                                                    @foreach($check['details'] as $header => $value)
                                                        <li class="text-xs text-text-secondary flex items-start gap-2">
                                                            <span class="text-green-500">✓</span>
                                                            <span class="font-mono">{{ $header }}: {{ $value }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                @if(count($check['details']) < 3)
                                                    <div class="mt-3 text-xs text-text-secondary">
                                                        <span class="text-yellow-500">⚠</span> Рекомендуется добавить: 
                                                        @if(!isset($check['details']['x-frame-options'])) X-Frame-Options, @endif
                                                        @if(!isset($check['details']['x-xss-protection'])) X-XSS-Protection, @endif
                                                        @if(!isset($check['details']['x-content-type-options'])) X-Content-Type-Options @endif
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </details>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Расширенные проверки (новые) -->
        <div class="bg-card/30 backdrop-blur-sm border border-white/5 rounded-3xl p-8 mb-8">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-12 h-12 rounded-2xl bg-accent/10 flex items-center justify-center">
                    <span class="text-2xl">🚀</span>
                </div>
                <div>
                    <h2 class="text-xl font-bold">Расширенная диагностика</h2>
                    <p class="text-sm text-text-secondary">Установите модуль для полного анализа</p>
                </div>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="p-4 bg-card/50 rounded-xl border border-white/5">
                    <span class="text-2xl mb-2 block">⚡</span>
                    <h3 class="font-bold text-sm mb-1">Скорость загрузки</h3>
                    <p class="text-xs text-text-secondary">LCP, FID, CLS метрики</p>
                </div>
                <div class="p-4 bg-card/50 rounded-xl border border-white/5">
                    <span class="text-2xl mb-2 block">🔄</span>
                    <h3 class="font-bold text-sm mb-1">Кэширование</h3>
                    <p class="text-xs text-text-secondary">Настройки Redis, файлового кэша</p>
                </div>
                <div class="p-4 bg-card/50 rounded-xl border border-white/5">
                    <span class="text-2xl mb-2 block">📦</span>
                    <h3 class="font-bold text-sm mb-1">База данных</h3>
                    <p class="text-xs text-text-secondary">Оптимизация таблиц, дубли</p>
                </div>
                <div class="p-4 bg-card/50 rounded-xl border border-white/5">
                    <span class="text-2xl mb-2 block">🔌</span>
                    <h3 class="font-bold text-sm mb-1">Модули</h3>
                    <p class="text-xs text-text-secondary">Конфликты OCmod, vQmod</p>
                </div>
            </div>
        </div>

        <!-- Блок поддержки -->
        <div class="relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-accent/10 via-accent2/10 to-accent/10 rounded-3xl blur-3xl"></div>
            <div class="relative bg-card/30 backdrop-blur-sm border border-white/5 rounded-3xl p-8 text-center md:text-left">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                    <div>
                        <h3 class="text-2xl font-bold mb-2">Нужна помощь с исправлением?</h3>
                        <p class="text-text-secondary">Я занимаюсь доработкой и поддержкой OpenCart-проектов более 12 лет</p>
                    </div>
                    <div class="flex gap-4">
                        <a href="{{ url('/') }}#contacts" 
                           class="inline-flex items-center px-6 py-3 bg-accent text-background font-bold rounded-xl hover:bg-accent/90 transition shadow-lg whitespace-nowrap">
                            Заказать доработку
                        </a>
                        <a href="{{ url('/') }}#cases" 
                           class="inline-flex items-center px-6 py-3 border-2 border-white/20 text-white font-bold rounded-xl hover:border-accent hover:bg-accent/10 transition whitespace-nowrap">
                            Кейсы →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection