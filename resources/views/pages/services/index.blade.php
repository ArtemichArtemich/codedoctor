@extends('layouts.app')

@section('title', 'Услуги | Техническое сопровождение сайтов — Code Doctor')
@section('description', 'Диагностика, исправление ошибок, доработка OpenCart, поддержка интернет-магазинов, настройка Метрики и интеграций.')

@section('content')
<section class="py-20">
    <div class="container">
        <h1 class="text-3xl md:text-4xl font-bold text-center mb-12">Услуги</h1>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
            <div class="group bg-card rounded-3xl overflow-hidden border border-white/5 hover:border-accent/30 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-accent/10">
                <!-- Верхняя часть с иконкой/изображением -->
                <div class="h-48 bg-gradient-to-br from-accent/20 to-accent2/20 flex items-center justify-center p-6 group-hover:bg-gradient-to-br group-hover:from-accent/25 group-hover:to-accent2/25 transition-all duration-300 relative">
                    @if($service->icon)
                    <div class="w-20 h-20 rounded-2xl bg-card/40 backdrop-blur-sm border border-white/10 flex items-center justify-center overflow-hidden p-3">
                        <img src="{{ asset('storage/' . $service->icon) }}" 
                             alt="{{ $service->title }}"
                             class="w-full h-full object-contain">
                    </div>
                    @elseif($service->image)
                    <div class="w-24 h-24 rounded-2xl overflow-hidden">
                        <img src="{{ asset('storage/' . $service->image) }}" 
                             alt="{{ $service->title }}"
                             class="w-full h-full object-cover">
                    </div>
                    @else
                    <div class="w-20 h-20 rounded-2xl bg-card/40 backdrop-blur-sm border border-white/10 flex items-center justify-center">
                        <span class="text-4xl">⚙️</span>
                    </div>
                    @endif
                </div>
                
                <!-- Контент -->
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2">{{ $service->title }}</h3>
                    
                    @if($service->short_description)
                    <p class="text-text-secondary mb-4 text-sm">
                        {{ Str::limit($service->short_description, 100) }}
                    </p>
                    @endif
                    
                    @if($service->price_from)
                    <div class="mb-4">
                        <span class="text-accent font-bold">{{ $service->price_from }}</span>
                    </div>
                    @endif
                    
                    <div class="flex justify-between items-center">
                        <a href="{{ $service->url }}" 
                            data-goal="service_detail_click" 
                            data-service="{{ $service->slug }}" 
                           class="text-accent hover:text-accent/80 transition text-sm font-medium inline-flex items-center gap-1">
                            Подробнее
                            <span class="group-hover:translate-x-1 transition-transform">→</span>
                        </a>
                        
                        <a href="/#contacts" 
                            data-goal="service_order_click" 
                            data-service="{{ $service->slug }}" 
                           class="text-xs text-text-secondary hover:text-accent transition">
                            Заказать
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- CTA -->
        <div class="text-center mt-12">
            <a href="{{ url('/#contacts') }}"
                data-goal="project_cta_click" 
               class="inline-block px-8 py-4 bg-accent text-background font-bold rounded-xl hover:bg-accent/90 transition shadow-lg hover:shadow-xl">
                Обсудить ваш проект
            </a>
        </div>
    </div>
</section>
@endsection