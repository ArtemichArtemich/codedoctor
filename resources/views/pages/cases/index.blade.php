@extends('layouts.app')

@section('title', 'Кейсы | Техническое сопровождение сайтов — Code Doctor')
@section('description', 'Кейсы по технической поддержке, доработке OpenCart, исправлению ошибок, интеграциям и развитию интернет-магазинов.')

@section('content')
<section class="py-20">
    <div class="container">
        <h1 class="text-3xl md:text-4xl font-bold text-center mb-12">Кейсы</h1>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($cases as $case)
            @php
                // Подготовка тегов
                $tags = $case->tags;
                if (is_string($tags)) {
                    $tags = json_decode($tags, true) ?? [];
                }
                $tags = is_array($tags) ? $tags : [];
                
                // Логотип или заглушка
                $logoText = $case->logo_text ?? substr($case->title_short ?? $case->title, 0, 2);
            @endphp
            <div class="group bg-card rounded-3xl overflow-hidden border border-white/5 hover:border-accent/30 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-accent/10">
                <!-- Верхняя часть с логотипом -->
                <div class="h-60 bg-gradient-to-br from-accent/20 to-accent2/20 flex flex-col items-center justify-center p-6 group-hover:bg-gradient-to-br group-hover:from-accent/25 group-hover:to-accent2/25 transition-all duration-300 relative">
                    
                    @if($case->logo)
                        <!-- Если есть логотип - показываем его -->
                        <div class="w-20 h-20 rounded-2xl bg-card/40 backdrop-blur-sm border border-white/10 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300 overflow-hidden p-2">
                            <img src="{{ asset('storage/' . $case->logo) }}" 
                                 alt="{{ $case->title }}"
                                 class="w-full h-full object-contain">
                        </div>
                    @else
                        <!-- Если нет логотипа - показываем буквы -->
                        <div class="w-20 h-20 rounded-2xl bg-card/40 backdrop-blur-sm border border-white/10 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <span class="text-3xl font-bold text-white">{{ $logoText }}</span>
                        </div>
                    @endif
                    
                    <!-- Название проекта -->
                    <h3 class="text-xl font-bold text-center mb-2 text-white">{{ $case->title_short ?? $case->title }}</h3>
                    
                    <!-- Длительность -->
                    @if($case->duration)
                    <div class="text-sm text-white/70">{{ $case->duration }}</div>
                    @endif
                    
                    <!-- Бейдж сложности -->
                    @if($case->complexity)
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-card/80 backdrop-blur-sm rounded-full text-xs font-medium border border-white/10">
                            @switch($case->complexity)
                                @case('low') Низкая @break
                                @case('medium') Средняя @break
                                @case('high') Высокая @break
                                @default {{ $case->complexity }}
                            @endswitch
                        </span>
                    </div>
                    @endif
                </div>
                
                <!-- Контент кейса -->
                <div class="p-6">
                    <!-- Теги/технологии -->
                    @if(count($tags) > 0)
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach(array_slice($tags, 0, 3) as $tag)
                        <span class="px-3 py-1 bg-background/50 rounded-lg text-xs text-text-secondary">
                            {{ $tag }}
                        </span>
                        @endforeach
                        @if(count($tags) > 3)
                        <span class="px-3 py-1 bg-background/50 rounded-lg text-xs text-text-secondary">
                            +{{ count($tags) - 3 }}
                        </span>
                        @endif
                    </div>
                    @endif
                    
                    <!-- Описание задачи -->
                    <p class="text-text-secondary mb-4 text-sm">
                        {{ Str::limit($case->task ?: $case->description ?: 'Краткое описание проекта и выполненных работ.', 120) }}
                    </p>
                    
                    <!-- Кнопка смотреть сайт (только для реальных проектов) -->
                    @if($case->website && $case->website !== '#')
                    <div class="mb-4">
                        <a href="{{ $case->website }}" 
                           target="_blank"
                            data-goal="case_website_click" 
                            data-case="{{ $case->slug }}" 
                           rel="noopener noreferrer"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-background border border-white/10 rounded-lg hover:border-accent/50 hover:bg-accent/5 transition-all text-sm group/btn">
                            <span>Посмотреть сайт</span>
                            <span class="group-hover/btn:translate-x-0.5 transition-transform">↗</span>
                        </a>
                    </div>
                    @endif
                    
                    <!-- Цена и ссылка -->
                    <div class="flex justify-between items-center pt-4 border-t border-white/5">
                        @if($case->price)
                            <span class="text-accent font-bold">{{ $case->price }}</span>
                        @else
                            <span class="text-text-tertiary text-sm">Индивидуально</span>
                        @endif

                        <a href="{{ $case->url }}"
                        data-goal="case_detail_click"
                        data-case="{{ $case->slug }}"
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
            <a href="{{ url('/#contacts') }}" data-goal="project_cta_click" 
               class="inline-block px-8 py-4 bg-accent text-background font-bold rounded-xl hover:bg-accent/90 transition shadow-lg hover:shadow-xl">
                Обсудить ваш проект
            </a>
        </div>
    </div>
</section>
@endsection