@extends('layouts.app')

@section('title', ($case->meta_title ?? $case->title ?? 'Кейс') . ' | Code Doctor')
@section('description', \Illuminate\Support\Str::limit($case->meta_description ?? $case->task ?? $case->result ?? 'Описание кейса Code Doctor.', 155))

@section('content')
<section class="py-20">
    <div class="container">
        <!-- Хлебные крошки -->
        <nav class="mb-8">
            <a href="{{ url('/') }}" class="text-text-secondary hover:text-accent transition">Главная</a>
            <span class="mx-2 text-text-tertiary">/</span>
            <a href="{{ route('cases') }}" class="text-text-secondary hover:text-accent transition">Кейсы</a>
            <span class="mx-2 text-text-tertiary">/</span>
            <span class="text-text-primary">{{ $case->title ?? 'Кейс' }}</span>
        </nav>
        
        <!-- Заголовок с логотипом -->
        <div class="mb-12 flex items-center gap-6">
            @if($case->logo)
            <div class="w-24 h-24 rounded-2xl bg-card/40 backdrop-blur-sm border border-white/10 flex items-center justify-center overflow-hidden p-3">
                <img src="{{ asset('storage/' . $case->logo) }}" 
                     alt="{{ $case->title }}"
                     class="w-full h-full object-contain"
                     style="background-color: {{ $case->logo_color ?? 'transparent' }}">
            </div>
            @endif
            <div>
                <div class="inline-flex items-center px-4 py-2 bg-accent/10 border border-accent/30 rounded-full mb-4">
                    <span class="text-accent font-medium">Кейс</span>
                </div>
                <h1 class="text-3xl md:text-4xl font-bold">{{ $case->title ?? 'Кейс' }}</h1>
            </div>
        </div>
        
        <!-- Галерея изображений (НОВОЕ) -->
        @if(isset($case->images) && is_array($case->images) && count($case->images) > 0)
        <div class="mb-12">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($case->images as $image)
                <div class="relative group cursor-pointer" onclick="openModal('{{ asset('storage/' . $image) }}')">
                    <img src="{{ asset('storage/' . $image) }}" 
                         alt="{{ $case->title }}"
                         class="w-full h-48 object-cover rounded-2xl border border-white/10 group-hover:border-accent/50 transition-all duration-300">
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl flex items-center justify-center">
                        <span class="text-white text-sm">Увеличить</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        
        <!-- Информация о клиенте (НОВОЕ) -->
        @if($case->client || $case->website)
        <div class="mb-8 p-6 bg-card rounded-3xl">
            <h3 class="text-lg font-bold mb-4">О клиенте</h3>
            <div class="grid md:grid-cols-2 gap-4">
                @if($case->client)
                <div>
                    <span class="text-text-secondary text-sm">Клиент:</span>
                    <div class="font-medium">{{ $case->client }}</div>
                </div>
                @endif
                @if($case->website && $case->website !== '#')
                <div>
                    <span class="text-text-secondary text-sm">Сайт:</span>
                    <div>
                        <a href="{{ $case->website }}" 
                           target="_blank" 
                           rel="noopener noreferrer"
                            data-goal="case_website_click" 
                            data-case="{{ $case->slug }}" 
                           class="text-accent hover:underline inline-flex items-center gap-1">
                            {{ str_replace(['https://', 'http://'], '', $case->website) }}
                            <span>↗</span>
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endif
        
        <div class="grid md:grid-cols-3 gap-8 items-start">
            <!-- Основной контент -->
            <div class="md:col-span-2">
                <div class="bg-card rounded-3xl p-8 space-y-8">
                    <!-- Задача -->
                    @if(isset($case->task))
                    <div>
                        <h2 class="text-2xl font-bold mb-4 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-accent/10 flex items-center justify-center mr-3">🎯</span>
                            Задача
                        </h2>
                        <div class="text-text-secondary leading-relaxed">
                            {{ $case->task }}
                        </div>
                    </div>
                    @endif
                    
                    <!-- Решение -->
                    @if(isset($case->solution_text) || (isset($case->solution_list) && count($case->solution_list) > 0))
                    <div>
                        <h2 class="text-2xl font-bold mb-4 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-accent/10 flex items-center justify-center mr-3">⚙️</span>
                            Решение
                        </h2>
                        <div class="text-text-secondary leading-relaxed space-y-4">
                            @if(isset($case->solution_text))
                            <p class="mb-4">{{ $case->solution_text }}</p>
                            @endif
                            
                            @if(isset($case->solution_list) && is_array($case->solution_list) && count($case->solution_list) > 0)
                            <ul class="space-y-4">
                                @foreach($case->solution_list as $item)
                                <li class="flex flex-col">
                                    @if(is_array($item))
                                        @if(isset($item['step']))
                                        <div class="font-bold text-accent mb-1">{{ $item['step'] }}</div>
                                        @endif
                                        @if(isset($item['description']))
                                        <div class="text-text-secondary">{{ $item['description'] }}</div>
                                        @endif
                                    @else
                                        <div class="flex items-start">
                                            <span class="text-accent mr-2">•</span>
                                            <span class="text-text-secondary">{{ $item }}</span>
                                        </div>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                    </div>
                    @endif
                    
                    <!-- Ключевые результаты (results) - НОВОЕ -->
                    @if(isset($case->results) && is_array($case->results) && count($case->results) > 0)
                    <div>
                        <h2 class="text-2xl font-bold mb-4 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-accent/10 flex items-center justify-center mr-3">📊</span>
                            Ключевые результаты
                        </h2>
                        <div class="grid grid-cols-2 gap-4">
                            @foreach($case->results as $key => $value)
                            <div class="bg-background/50 rounded-xl p-4">
                                <div class="text-sm text-text-secondary mb-1">{{ $key }}</div>
                                <div class="text-xl font-bold text-accent">{{ $value }}</div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    <!-- Результат -->
                    @if(isset($case->result))
                    <div>
                        <h2 class="text-2xl font-bold mb-4 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-accent/10 flex items-center justify-center mr-3">📈</span>
                            Результат
                        </h2>
                        <div class="text-text-secondary leading-relaxed">
                            {{ $case->result }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Сайдбар -->
            <div>
                <div class="bg-card rounded-3xl p-6 space-y-6 sticky top-24">
                    <!-- Детали -->
                    <div>
                        <h3 class="text-lg font-bold mb-4">Детали проекта</h3>
                        <div class="space-y-3">
                            @if(isset($case->price))
                            <div class="flex justify-between">
                                <span class="text-text-secondary">Стоимость:</span>
                                <span class="font-bold">{{ $case->price }}</span>
                            </div>
                            @endif
                            
                            @if(isset($case->duration))
                            <div class="flex justify-between">
                                <span class="text-text-secondary">Срок:</span>
                                <span>{{ $case->duration }}</span>
                            </div>
                            @endif
                            
                            @if(isset($case->complexity))
                            <div class="flex justify-between">
                                <span class="text-text-secondary">Сложность:</span>
                                <span>
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
                    </div>
                    
                    <!-- Детали проекта (details) - НОВОЕ -->
                    @if(isset($case->details) && is_array($case->details) && count($case->details) > 0)
                    <div>
                        <h3 class="text-lg font-bold mb-4">Характеристики</h3>
                        <div class="space-y-2">
                            @foreach($case->details as $key => $value)
                            <div class="text-sm">
                                <span class="text-text-secondary">{{ $key }}:</span>
                                <span class="ml-2">{{ $value }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    <!-- Технологии -->
                    @if(isset($case->technologies) && is_array($case->technologies) && count($case->technologies) > 0)
                    <div>
                        <h3 class="text-lg font-bold mb-4">Технологии</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($case->technologies as $tech)
                            <span class="px-3 py-1 bg-background text-text-secondary rounded-full text-sm">
                                {{ is_array($tech) ? (isset($tech['name']) ? $tech['name'] : json_encode($tech)) : $tech }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    <!-- Теги -->
                    @php
                        $tags = [];

                        if (isset($case->tags)) {
                            if (is_array($case->tags)) {
                                $tags = $case->tags;
                            } elseif (is_string($case->tags)) {
                                $decodedTags = json_decode($case->tags, true);
                                $tags = is_array($decodedTags)
                                    ? $decodedTags
                                    : array_map('trim', explode(',', $case->tags));
                            }
                        }
                    @endphp
                    @if(!empty($tags))
                    <div>
                        <h3 class="text-lg font-bold mb-4">Теги</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($tags as $tag)
                            <span class="px-3 py-1 bg-background/50 text-text-secondary rounded-full text-xs">
                                {{ $tag }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    <!-- CTA -->
                    <div class="pt-6 border-t border-white/10">
                        <p class="text-text-secondary mb-4">Есть похожая задача?</p>
                        <a href="{{ url('/#contacts') }}" 
                            data-goal="case_cta_click" 
                            data-case="{{ $case->slug }}" 
                           class="block w-full py-3 bg-accent text-background font-semibold rounded-xl text-center hover:bg-accent/90 transition">
                            Обсудить проект
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Навигация -->
        @if(isset($prevCase) || isset($nextCase))
        <div class="mt-12 pt-8 border-t border-white/10">
            <div class="flex justify-between">
                @if(isset($prevCase))
                <a href="{{ route('cases.show', $prevCase->slug) }}" 
                    data-goal="case_prev_click" 
                    data-case="{{ $prevCase->slug }}" 
                   class="flex items-center text-accent hover:text-accent/80 transition">
                    ← {{ $prevCase->title_short ?? 'Предыдущий' }}
                </a>
                @else
                <div></div>
                @endif
                
                <a href="{{ route('cases') }}" data-goal="cases_back_click" class="text-text-secondary hover:text-accent transition">
                    Все кейсы
                </a>
                
                @if(isset($nextCase))
                <a href="{{ route('cases.show', $nextCase->slug) }}" 
                    data-goal="case_next_click" 
                    data-case="{{ $nextCase->slug }}" 
                   class="flex items-center text-accent hover:text-accent/80 transition">
                    {{ $nextCase->title_short ?? 'Следующий' }} →
                </a>
                @else
                <div></div>
                @endif
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Модальное окно для просмотра изображений (НОВОЕ) -->
<div id="imageModal" class="fixed inset-0 bg-black/90 z-50 hidden items-center justify-center" onclick="closeModal()">
    <div class="relative max-w-5xl max-h-[90vh] mx-4">
        <img id="modalImage" src="" alt="" class="w-full h-full object-contain">
        <button onclick="closeModal()" class="absolute top-4 right-4 text-white bg-black/50 rounded-full p-2 hover:bg-black/70 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
</div>

<script>
function openModal(src) {
    document.getElementById('modalImage').src = src;
    document.getElementById('imageModal').classList.remove('hidden');
    document.getElementById('imageModal').classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('imageModal').classList.add('hidden');
    document.getElementById('imageModal').classList.remove('flex');
    document.body.style.overflow = '';
}
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (window.cdAnalytics?.reachGoal) {
        window.cdAnalytics.reachGoal('case_view', {
            case: @json($case->slug),
            title: @json($case->title),
            page: window.location.href
        });
    }
});
</script>
@endsection