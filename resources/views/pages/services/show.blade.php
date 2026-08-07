@extends('layouts.app')

@section('title', ($service->meta_title ?? $service->title) . ' | Услуги')
@section('description', \Illuminate\Support\Str::limit($service->meta_description ?? $service->short_description ?? strip_tags($service->description), 155))

@section('content')
<section class="py-12 md:py-20">
    <div class="container">
        <!-- Хлебные крошки -->
        <div class="mb-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="/" class="inline-flex items-center text-sm text-text-secondary hover:text-accent">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Главная
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-text-tertiary" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('services.index') }}" class="ml-1 text-sm text-text-secondary hover:text-accent">Услуги</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-text-tertiary" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm text-text-primary font-medium">{{ $service->h1 ?? $service->title }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        
        <!-- Заголовок с иконкой -->
        <div class="mb-12 flex items-center gap-4">
            @if($service->icon)
            <div class="w-16 h-16 rounded-2xl bg-card/40 backdrop-blur-sm border border-white/10 flex items-center justify-center overflow-hidden p-3">
                <img src="{{ asset('storage/' . $service->icon) }}" 
                     alt="{{ $service->title }}"
                     class="w-full h-full object-contain">
            </div>
            @endif
            <div>
                <h1 class="text-4xl md:text-5xl font-bold">{{ $service->h1 ?? $service->title }}</h1>
                @if($service->short_description)
                <p class="text-xl text-text-secondary max-w-3xl mt-4">
                    {{ $service->short_description }}
                </p>
                @endif
            </div>
        </div>
        
        <!-- Галерея изображений -->
        @if(isset($service->images) && is_array($service->images) && count($service->images) > 0)
        <div class="mb-12">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($service->images as $image)
                <div class="relative group cursor-pointer" onclick="openModal('{{ asset('storage/' . $image) }}')">
                    <img src="{{ asset('storage/' . $image) }}" 
                         alt="{{ $service->title }}"
                         class="w-full h-48 object-cover rounded-2xl border border-white/10 group-hover:border-accent/50 transition-all duration-300">
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl flex items-center justify-center">
                        <span class="text-white text-sm">Увеличить</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Основной контент -->
            <div class="lg:col-span-2">
                <div class="space-y-8">
                    <!-- Основное изображение и описание -->
                    <div class="bg-card rounded-2xl p-8">
                        @if($service->image)
                        <div class="mb-6 rounded-xl overflow-hidden">
                            <img src="{{ asset('storage/' . $service->image) }}" 
                                 alt="{{ $service->title }}"
                                 class="w-full h-auto">
                        </div>
                        @endif
                        
                        @if($service->description)
                        <div class="prose prose-invert max-w-none">
                            {!! $service->description !!}
                        </div>
                        @endif
                    </div>
                    
                    <!-- Полное содержание -->
                    @if($service->content)
                    <div class="bg-card rounded-2xl p-8">
                        <div class="prose prose-invert max-w-none">
                            {!! $service->content !!}
                        </div>
                    </div>
                    @endif
                    
                    <!-- Особенности -->
                    @if(isset($service->features) && is_array($service->features) && count($service->features) > 0)
                    <div class="bg-card rounded-2xl p-8">
                        <h2 class="text-2xl font-bold mb-6">Особенности</h2>
                        <div class="grid md:grid-cols-2 gap-6">
                            @foreach($service->features as $feature)
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 rounded-lg bg-accent/10 flex items-center justify-center flex-shrink-0">
                                    <span class="text-accent font-bold">✓</span>
                                </div>
                                <div>
                                    <h3 class="font-bold mb-1">{{ $feature['title'] ?? '' }}</h3>
                                    <p class="text-sm text-text-secondary">{{ $feature['description'] ?? '' }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    <!-- FAQ -->
                    @if(isset($service->faq) && is_array($service->faq) && count($service->faq) > 0)
                    <div class="bg-card rounded-2xl p-8">
                        <h2 class="text-2xl font-bold mb-6">Частые вопросы</h2>
                        <div class="space-y-4">
                            @foreach($service->faq as $item)
                            <div class="border-b border-white/10 last:border-0 pb-4 last:pb-0">
                                <h3 class="font-bold mb-2">{{ $item['question'] ?? '' }}</h3>
                                <p class="text-text-secondary">{{ $item['answer'] ?? '' }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Сайдбар -->
            <div>
                <div class="bg-card rounded-2xl p-6 mb-6 sticky top-6">
                    <h3 class="text-xl font-bold mb-4">Заказать услугу</h3>
                    
                    @if($service->price_from)
                    <div class="mb-4 p-4 bg-background/50 rounded-xl">
                        <span class="text-text-secondary text-sm">Стоимость от</span>
                        <div class="text-2xl font-bold text-accent">{{ $service->price_from }}</div>
                    </div>
                    @endif
                    
                    <p class="text-text-secondary mb-4">
                        Опишите вашу задачу, и я предложу оптимальное решение
                    </p>
                    <a href="/#contacts" 
                        data-goal="service_cta_click" 
                        data-service="{{ $service->slug }}" 
                       class="block w-full py-3 bg-accent text-background font-bold rounded-xl hover:bg-accent/90 transition text-center">
                        Обсудить проект
                    </a>
                </div>
                
                <!-- Технологии -->
                @if(isset($service->technologies) && is_array($service->technologies) && count($service->technologies) > 0)
                <div class="bg-card rounded-2xl p-6 mb-6">
                    <h3 class="text-xl font-bold mb-4">Технологии</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($service->technologies as $tech)
                        <span class="px-3 py-1 bg-background text-text-secondary rounded-full text-sm">
                            {{ $tech }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <!-- Связанные кейсы -->
                @if(isset($service->cases) && is_array($service->cases) && count($service->cases) > 0)
                <div class="bg-card rounded-2xl p-6 mb-6">
                    <h3 class="text-xl font-bold mb-4">Примеры работ</h3>
                    <ul class="space-y-3">
                        @foreach($service->cases as $caseSlug)
                        <li>
                            <a href="/cases/{{ $caseSlug }}" 
                                data-goal="related_case_click" 
                                data-case="{{ $caseSlug }}" 
                                data-service="{{ $service->slug }}" 
                               class="text-accent hover:underline block py-1">
                                {{ $caseSlug }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <!-- Другие услуги -->
                <div class="bg-card rounded-2xl p-6">
                    <h3 class="text-xl font-bold mb-4">Другие услуги</h3>
                    <ul class="space-y-2">
                        @foreach($servicesMenu as $otherService)
                            @if($otherService->slug !== $service->slug)
                            <li>
                                <a href="{{ route('services.show', $otherService->slug) }}" 
                                    data-goal="other_service_click" 
                                    data-service="{{ $otherService->slug }}" 
                                class="text-text-secondary hover:text-accent transition block py-2">
                                    {{ $otherService->title }}
                                </a>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Модальное окно для просмотра изображений -->
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
        window.cdAnalytics.reachGoal('service_view', {
            service: @json($service->slug),
            title: @json($service->title),
            page: window.location.href
        });
    }
});
</script>
@endsection