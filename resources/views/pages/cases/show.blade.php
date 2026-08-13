@extends('layouts.app')

@section('title', ($case->meta_title ?? $case->title ?? 'Кейс') . ' | Code Doctor')
@section('description', \Illuminate\Support\Str::limit(
$case->meta_description ?? $case->task ?? $case->result ?? 'Описание кейса Code Doctor.',
155
))

@section('content')

<section class="py-12 md:py-16">
    <div class="container">

        <!-- Хлебные крошки -->
        <nav class="mb-10 text-sm">
            <a href="{{ url('/') }}"
                class="text-text-secondary hover:text-accent transition">
                Главная
            </a>

            <span class="mx-2 text-text-tertiary">/</span>

            <a href="{{ route('cases') }}"
                class="text-text-secondary hover:text-accent transition">
                Кейсы
            </a>

            <span class="mx-2 text-text-tertiary">/</span>

            <span class="text-text-primary">
                {{ $case->title_short ?: $case->title }}
            </span>
        </nav>


        <!-- HERO -->
        <div class="max-w-5xl mb-10">

            <div class="flex flex-wrap items-center gap-3 mb-5">

                <span class="inline-flex items-center px-4 py-2
                             bg-accent/10 border border-accent/30
                             rounded-full text-accent text-sm font-medium">
                    Кейс
                </span>

                @if($case->duration)
                <span class="text-text-secondary text-sm">
                    {{ $case->duration }}
                </span>
                @endif

            </div>

            <h1 class="text-3xl md:text-4xl lg:text-5xl
                       font-bold leading-tight mb-6">
                {{ $case->title }}
            </h1>


            <!-- Клиент / сайт -->
            <div class="flex flex-wrap gap-6 mb-8 text-sm">

                @if($case->client)
                <div>
                    <span class="text-text-tertiary">Клиент:</span>
                    <span class="ml-2 font-medium">{{ $case->client }}</span>
                </div>
                @endif

                @if($case->website && $case->website !== '#')
                <div>
                    <span class="text-text-tertiary">Сайт:</span>

                    <a href="{{ $case->website }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        data-goal="case_website_click"
                        data-case="{{ $case->slug }}"
                        class="ml-2 text-accent hover:underline">

                        {{ preg_replace('#^https?://#', '', rtrim($case->website, '/')) }}
                        ↗

                    </a>
                </div>
                @endif

            </div>


            <!-- Все технологии -->
            @if(is_array($case->technologies) && count($case->technologies) > 0)

            <div class="flex flex-wrap gap-2">

                @foreach($case->technologies as $tech)

                <span class="px-3 py-2
                                     bg-card border border-white/5
                                     rounded-lg text-sm text-text-secondary">

                    {{ is_array($tech)
                                ? ($tech['name'] ?? '')
                                : $tech
                            }}

                </span>

                @endforeach

            </div>

            @endif

        </div>


        <!-- Галерея -->
        @if(is_array($case->images) && count($case->images) > 0)

        <div class="mb-10">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                @foreach($case->images as $image)

                <button
                    type="button"
                    class="relative group block w-full"
                    onclick="openModal('{{ asset('storage/' . $image) }}')"
                    aria-label="Открыть изображение проекта">

                    <img
                        src="{{ asset('storage/' . $image) }}"
                        alt="{{ $case->title }}"
                        class="w-full h-52 object-cover
                                       rounded-2xl border border-white/10
                                       group-hover:border-accent/40 transition
                                       cursor-zoom-in">

                </button>

                @endforeach

            </div>

        </div>

        @endif


        <!-- ЗАДАЧА -->
        @if($case->task)

        <section class="mb-10">

            <div class="max-w-4xl">

                <h2 class="text-2xl md:text-3xl font-bold mb-6">
                    Задача
                </h2>

                <div class="bg-card border border-white/5
                                rounded-3xl p-6 md:p-8">

                    <p class="text-base md:text-lg
                                  text-text-secondary
                                  leading-relaxed">
                        {{ $case->task }}
                    </p>

                </div>

            </div>

        </section>

        @endif


        <!-- ЧТО БЫЛО СДЕЛАНО -->
        @if(
        $case->solution_text ||
        (is_array($case->solution_list) && count($case->solution_list) > 0)
        )

        <section class="mb-10">

            <div class="max-w-4xl mb-8">

                <h2 class="text-2xl md:text-3xl font-bold mb-10">
                    Что было сделано
                </h2>

                @if($case->solution_text)

                <div class="text-base md:text-lg
                                    text-text-secondary
                                    leading-relaxed">

                    {!! $case->solution_text !!}

                </div>

                @endif

            </div>


            @if(is_array($case->solution_list) && count($case->solution_list) > 0)

            <div class="grid md:grid-cols-2 gap-8 md:gap-8">

                @foreach($case->solution_list as $index => $item)

                <div class="bg-card border border-white/5
                                        rounded-2xl p-6 md:p-8">

                    <div class="text-sm font-bold
                                            text-accent mb-4">
                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                    </div>


                    @if(is_array($item))

                    @if(!empty($item['step']))

                    <h3 class="text-lg md:text-xl
                                                   font-bold mb-3">
                        {{ $item['step'] }}
                    </h3>

                    @endif


                    @if(!empty($item['description']))

                    <p class="text-text-secondary
                                                  leading-relaxed">
                        {{ $item['description'] }}
                    </p>

                    @endif

                    @else

                    <p class="text-text-secondary
                                              leading-relaxed">
                        {{ $item }}
                    </p>

                    @endif

                </div>

                @endforeach

            </div>

            @endif

        </section>

        @endif


        <!-- РЕЗУЛЬТАТЫ -->
        @if(is_array($case->results) && count($case->results) > 0)

        <section class="mb-10">

            <h2 class="text-2xl md:text-3xl font-bold mb-10">
                Результаты
            </h2>


            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">

                @foreach($case->results as $key => $value)

                <div class="bg-card border border-white/5
                                rounded-2xl p-8 md:p-8">

                    <div class="text-xl font-bold
                                        text-accent mb-3">
                        {{ $value }}
                    </div>

                    <div class="text-base
                                        text-text-secondary
                                        leading-relaxed">
                        {{ $key }}
                    </div>

                </div>

                @endforeach

            </div>

        </section>

        @endif


        <!-- ИТОГ -->
        @if($case->result)

        <section class="mb-10">

            <h2 class="text-2xl md:text-3xl font-bold mb-10">
                Итог
            </h2>

            <div class="max-w-5xl bg-card
                            border border-accent/20
                            rounded-3xl p-6 md:p-8">

                <p class="text-base md:text-lg
                              text-text-primary
                              leading-relaxed">
                    {{ $case->result }}
                </p>

            </div>

        </section>

        @endif


        <!-- ТЕХНОЛОГИИ -->
        @if(is_array($case->technologies) && count($case->technologies) > 0)

        <section class="mb-10">

            <h2 class="text-2xl md:text-3xl font-bold mb-10">
                Технологии
            </h2>

            <div class="flex flex-wrap gap-2">

                @foreach($case->technologies as $tech)

                <span class="px-4 py-2
                                     bg-card border border-white/5
                                     rounded-xl
                                     text-sm text-text-secondary">

                    {{ is_array($tech)
                                ? ($tech['name'] ?? '')
                                : $tech
                            }}

                </span>

                @endforeach

            </div>

        </section>

        @endif


        <!-- CTA -->
        <section class="mb-10">

            <div class="bg-card border border-white/5
                        rounded-3xl p-8">

                <div class="max-w-3xl">

                    <h2 class="text-2xl md:text-3xl font-bold mb-5">
                        Есть похожая задача?
                    </h2>

                    <p class="text-text-secondary
                            text-base md:text-lg
                            leading-relaxed mb-8">
                        Расскажите, что происходит с вашим проектом.
                        Разберусь в ситуации и предложу варианты решения.
                    </p>

                    <div class="pt-2">

                        <a href="{{ url('/#contacts') }}"
                            data-goal="case_cta_click"
                            data-case="{{ $case->slug }}"
                            class="inline-flex items-center justify-center
                                px-8 py-4
                                bg-accent text-background
                                font-bold rounded-xl
                                hover:bg-accent/90 transition">

                            Обсудить задачу

                        </a>

                    </div>

                </div>

            </div>

        </section>


        <!-- Навигация между кейсами -->
        <div class="pt-8 border-t border-white/10">

            <div class="grid md:grid-cols-3 gap-6 items-center">

                <div>

                    @if($prevCase)

                    <a href="{{ route('cases.show', $prevCase->slug) }}"
                        data-goal="case_prev_click"
                        data-case="{{ $prevCase->slug }}"
                        class="group">

                        <div class="text-sm text-text-tertiary mb-1">
                            ← Предыдущий
                        </div>

                        <div class="font-medium group-hover:text-accent transition">
                            {{ $prevCase->title_short ?: $prevCase->title }}
                        </div>

                    </a>

                    @endif

                </div>


                <div class="text-center">

                    <a href="{{ route('cases') }}"
                        data-goal="cases_back_click"
                        class="text-text-secondary hover:text-accent transition">
                        Все кейсы
                    </a>

                </div>


                <div class="md:text-right">

                    @if($nextCase)

                    <a href="{{ route('cases.show', $nextCase->slug) }}"
                        data-goal="case_next_click"
                        data-case="{{ $nextCase->slug }}"
                        class="group">

                        <div class="text-sm text-text-tertiary mb-1">
                            Следующий →
                        </div>

                        <div class="font-medium group-hover:text-accent transition">
                            {{ $nextCase->title_short ?: $nextCase->title }}
                        </div>

                    </a>

                    @endif

                </div>

            </div>

        </div>

    </div>
</section>


<!-- Модальное окно -->
<div
    id="imageModal"
    class="fixed inset-0 bg-black/90 hidden"
    style="z-index: 100;"
    onclick="closeModal()">

    <div
        class="w-full h-full overflow-auto"
        onclick="event.stopPropagation()">

        <div class="relative max-w-6xl mx-auto p-4 md:p-8">

            <img
                id="modalImage"
                src=""
                alt=""
                class="w-full h-auto rounded-2xl">

        </div>

    </div>


    <button
        type="button"
        onclick="closeModal()"
        class="fixed top-4 right-4 w-10 h-10 bg-black/80
               border border-white/20 rounded-full text-white
               flex items-center justify-center hover:bg-black transition"
        style="z-index: 110;"
        aria-label="Закрыть изображение">

        <svg
            class="w-5 h-5"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12"></path>
        </svg>

    </button>

</div>


<script>
    function openModal(src) {
        const modal = document.getElementById('imageModal');
        const image = document.getElementById('modalImage');

        image.src = src;

        modal.classList.remove('hidden');

        document.body.style.overflow = 'hidden';

        const scrollContainer = modal.querySelector('.overflow-auto');

        if (scrollContainer) {
            scrollContainer.scrollTop = 0;
        }
    }

    function closeModal() {
        const modal = document.getElementById('imageModal');
        const image = document.getElementById('modalImage');

        modal.classList.add('hidden');

        image.src = '';

        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeModal();
        }
    });
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