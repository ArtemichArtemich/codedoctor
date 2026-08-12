@extends('layouts.app')

@section('title', ($service->meta_title ?? $service->title) . ' | Code Doctor')

@section(
    'description',
    \Illuminate\Support\Str::limit(
        $service->meta_description
        ?? $service->short_description
        ?? strip_tags($service->description),
        155
    )
)

@section('content')

<section class="py-20">

    <div class="container">

        <!-- Хлебные крошки -->
        <div class="mb-8">

            <nav class="flex" aria-label="Breadcrumb">

                <ol class="inline-flex items-center space-x-1 md:space-x-3">

                    <li class="inline-flex items-center">

                        <a href="/"
                           class="inline-flex items-center text-sm text-text-secondary hover:text-accent">

                            Главная

                        </a>

                    </li>

                    <li>
                        <span class="text-text-tertiary">
                            /
                        </span>
                    </li>

                    <li>

                        <a href="{{ route('services.index') }}"
                           class="text-sm text-text-secondary hover:text-accent">

                            Услуги

                        </a>

                    </li>

                    <li>
                        <span class="text-text-tertiary">
                            /
                        </span>
                    </li>

                    <li>

                        <span class="text-sm text-text-primary">
                            {{ $service->title }}
                        </span>

                    </li>

                </ol>

            </nav>

        </div>


        <!-- Первый экран -->
        <div class="mb-12">

            <div class="inline-flex items-center px-4 py-2 bg-accent/10 border border-accent/30 rounded-full mb-6">
                <span class="text-accent font-medium">
                    Услуга
                </span>
            </div>

            <h1 class="text-3xl md:text-4xl font-bold mb-6 max-w-4xl">
                {{ $service->h1 ?? $service->title }}
            </h1>


            @if($service->short_description)

                <p class="text-xl text-text-secondary max-w-3xl mb-6">
                    {{ $service->short_description }}
                </p>

            @endif


            <div class="flex flex-wrap gap-4">

                @if($service->price_from)

                    <div class="bg-card p-4 rounded-xl border border-white/5">

                        <div class="text-sm text-text-secondary mb-1">
                            Стоимость
                        </div>

                        <div class="text-xl font-bold text-accent">
                            {{ $service->price_from }}
                        </div>

                    </div>

                @endif


                <a href="/#contacts"
                   data-goal="service_cta_click"
                   data-service="{{ $service->slug }}"
                   class="inline-block px-8 py-4 bg-accent text-background font-bold rounded-xl hover:bg-accent/90 transition">

                    Обсудить задачу

                </a>

            </div>

        </div>


        <!-- Галерея -->
        @if(is_array($service->images) && count($service->images) > 0)

            <div class="mb-12">

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                    @foreach($service->images as $image)

                        <div class="relative group cursor-pointer"
                             onclick="openModal('{{ asset('storage/' . $image) }}')">

                            <img src="{{ asset('storage/' . $image) }}"
                                 alt="{{ $service->title }}"
                                 class="w-full h-48 object-cover rounded-2xl border border-white/10 group-hover:border-accent/50 transition-all duration-300">

                            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl flex items-center justify-center">

                                <span class="text-white text-sm">
                                    Увеличить
                                </span>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        @endif


        <!-- Основное описание -->
        @if($service->description)

            <div class="max-w-4xl mb-12">

                <h2 class="text-2xl font-bold mb-6">
                    О задаче
                </h2>

                <div class="bg-card p-8 rounded-2xl border border-white/5">

                    <div class="text-text-secondary leading-relaxed">
                        {!! nl2br(e($service->description)) !!}
                    </div>

                </div>

            </div>

        @endif


        <!-- Полное содержание -->
        @if($service->content)

            <div class="max-w-4xl mb-12">

                <h2 class="text-2xl font-bold mb-6">
                    Что входит в работу
                </h2>

                <div class="bg-card p-8 rounded-2xl border border-white/5">

                    <div class="text-text-secondary leading-relaxed">
                        {!! nl2br(e($service->content)) !!}
                    </div>

                </div>

            </div>

        @endif


        <!-- Особенности -->
        @if(is_array($service->features) && count($service->features) > 0)

            <div class="mb-12">

                <h2 class="text-2xl font-bold mb-8">
                    Что можно сделать
                </h2>


                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @foreach($service->features as $feature)

                        <div class="bg-card p-6 rounded-2xl border border-white/5">

                            <div class="w-8 h-8 rounded-lg bg-accent/10 flex items-center justify-center mb-4">

                                <span class="text-accent font-bold">
                                    ✓
                                </span>

                            </div>

                            <h3 class="text-lg font-bold mb-2">
                                {{ $feature['title'] ?? '' }}
                            </h3>

                            <p class="text-sm text-text-secondary">
                                {{ $feature['description'] ?? '' }}
                            </p>

                        </div>

                    @endforeach

                </div>

            </div>

        @endif


        <!-- Связанные кейсы -->
        @if(isset($relatedCases) && $relatedCases->count() > 0)

            <div class="mb-12">

                <h2 class="text-2xl font-bold mb-8">
                    Примеры проектов
                </h2>


                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @foreach($relatedCases as $relatedCase)

                        <div class="bg-card p-6 rounded-2xl border border-white/5">

                            <h3 class="text-xl font-bold mb-3">
                                {{ $relatedCase->title_short ?: $relatedCase->title }}
                            </h3>


                            @if($relatedCase->task)

                                <p class="text-sm text-text-secondary mb-4">
                                    {{ \Illuminate\Support\Str::limit($relatedCase->task, 140) }}
                                </p>

                            @endif


                            <a href="{{ route('cases.show', $relatedCase->slug) }}"
                               data-goal="related_case_click"
                               data-case="{{ $relatedCase->slug }}"
                               data-service="{{ $service->slug }}"
                               class="text-accent text-sm font-medium">

                                Посмотреть кейс →

                            </a>

                        </div>

                    @endforeach

                </div>

            </div>

        @endif


        <!-- Технологии -->
        @if(is_array($service->technologies) && count($service->technologies) > 0)

            <div class="mb-12">

                <h2 class="text-2xl font-bold mb-6">
                    Технологии
                </h2>

                <div class="flex flex-wrap gap-2">

                    @foreach($service->technologies as $tech)

                        <span class="px-3 py-2 bg-card border border-white/5 text-text-secondary rounded-xl text-sm">
                            {{ $tech }}
                        </span>

                    @endforeach

                </div>

            </div>

        @endif


        <!-- FAQ -->
        @if(is_array($service->faq) && count($service->faq) > 0)

            <div class="max-w-4xl mb-12">

                <h2 class="text-2xl font-bold mb-8">
                    Частые вопросы
                </h2>


                <div class="space-y-4">

                    @foreach($service->faq as $item)

                        <div class="bg-card p-6 rounded-2xl border border-white/5">

                            <h3 class="font-bold mb-3">
                                {{ $item['question'] ?? '' }}
                            </h3>

                            <p class="text-text-secondary">
                                {{ $item['answer'] ?? '' }}
                            </p>

                        </div>

                    @endforeach

                </div>

            </div>

        @endif


        <!-- CTA -->
        <div class="bg-card p-8 rounded-3xl border border-white/5 mb-12">

            <div class="max-w-3xl">

                <h2 class="text-2xl font-bold mb-4">
                    Есть задача?
                </h2>

                <p class="text-text-secondary text-lg mb-6">
                    Опишите ситуацию своими словами.
                    Посмотрю, могу ли помочь и какой вариант решения будет разумнее.
                </p>

                <a href="/#contacts"
                   data-goal="service_cta_click"
                   data-service="{{ $service->slug }}"
                   class="inline-block px-8 py-4 bg-accent text-background font-bold rounded-xl hover:bg-accent/90 transition">

                    Обсудить задачу

                </a>

            </div>

        </div>


        <!-- Другие услуги -->
        <div>

            <h2 class="text-2xl font-bold mb-6">
                Другие услуги
            </h2>


            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach($servicesMenu as $otherService)

                    @if($otherService->slug !== $service->slug)

                        <a href="{{ route('services.show', $otherService->slug) }}"
                           data-goal="other_service_click"
                           data-service="{{ $otherService->slug }}"
                           class="bg-card p-6 rounded-2xl border border-white/5 hover:border-accent/30 transition">

                            <div class="font-bold mb-2">
                                {{ $otherService->title }}
                            </div>

                            @if($otherService->short_description)

                                <div class="text-sm text-text-secondary">
                                    {{ \Illuminate\Support\Str::limit($otherService->short_description, 100) }}
                                </div>

                            @endif

                        </a>

                    @endif

                @endforeach

            </div>

        </div>

    </div>

</section>


<!-- Модальное окно -->
<div id="imageModal"
     class="fixed inset-0 bg-black/90 z-50 hidden items-center justify-center"
     onclick="closeModal()">

    <div class="relative max-w-5xl max-h-[90vh] mx-4">

        <img id="modalImage"
             src=""
             alt=""
             class="w-full h-full object-contain">

        <button onclick="closeModal()"
                class="absolute top-4 right-4 text-white bg-black/50 rounded-full p-2 hover:bg-black/70 transition">

            <svg class="w-6 h-6"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M6 18L18 6M6 6l12 12">
                </path>

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