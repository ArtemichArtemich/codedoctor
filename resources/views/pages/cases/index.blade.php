@extends('layouts.app')

@section('title', 'Кейсы по разработке, поддержке и развитию сайтов — Code Doctor')
@section('description', 'Примеры проектов по разработке сайтов и веб-сервисов, технической поддержке, интеграциям, автоматизации, аналитике и развитию интернет-магазинов.')

@section('content')

<section class="py-20">
    <div class="container">

        <!-- Заголовок -->
        <div class="max-w-3xl mx-auto text-center mb-12">

            <div class="inline-flex items-center px-4 py-2 bg-accent/10 border border-accent/30 rounded-full mb-6">
                <span class="text-accent font-medium">
                    Реальные проекты
                </span>
            </div>

            <h1 class="text-3xl md:text-4xl font-bold mb-4">
                Кейсы
            </h1>

            <p class="text-text-secondary text-lg">
                Проекты, где нужно было создать решение с нуля,
                разобраться в существующем сайте, добавить новый функционал,
                автоматизировать процессы или регулярно развивать проект.
            </p>

        </div>


        @if($cases->count())

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach($cases as $case)

                    @php
                        $tags = $case->tags;

                        if (is_string($tags)) {
                            $tags = json_decode($tags, true) ?? [];
                        }

                        $tags = is_array($tags) ? $tags : [];

                        $logoText = \Illuminate\Support\Str::upper(
                            \Illuminate\Support\Str::substr(
                                $case->title_short ?: $case->title,
                                0,
                                2
                            )
                        );
                    @endphp


                    <div class="group bg-card rounded-3xl overflow-hidden border border-white/5 hover:border-accent/30 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-accent/10">

                        <!-- Верх карточки -->
                        <div class="bg-gradient-to-br from-accent/20 to-accent2/20 p-8">

                            <div class="flex justify-between items-start mb-6">

                                <!-- Буквы вместо логотипа -->
                                <div class="w-14 h-14 rounded-2xl bg-card/40 border border-white/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">

                                    <span class="text-xl font-bold text-white">
                                        {{ $logoText }}
                                    </span>

                                </div>


                                @if($case->duration)

                                    <div class="text-sm text-white/70">
                                        {{ $case->duration }}
                                    </div>

                                @endif

                            </div>


                            <!-- Категория -->
                            @if($case->category)

                                <div class="text-sm text-accent font-medium mb-3">

                                    @switch($case->category)

                                        @case('ecommerce')
                                            Интернет-магазин
                                            @break

                                        @case('corporate')
                                            Корпоративный сайт
                                            @break

                                        @case('landing')
                                            Лендинг
                                            @break

                                        @case('portal')
                                            Портал
                                            @break

                                        @default
                                            Проект

                                    @endswitch

                                </div>

                            @endif


                            <h2 class="text-xl font-bold text-white">
                                {{ $case->title_short ?: $case->title }}
                            </h2>

                        </div>


                        <!-- Контент -->
                        <div class="p-8">

                            <!-- Задача -->
                            @if($case->task)

                                <p class="text-text-secondary mb-6">
                                    {{ \Illuminate\Support\Str::limit($case->task, 170) }}
                                </p>

                            @endif


                            <!-- Теги -->
                            @if(count($tags) > 0)

                                <div class="flex flex-wrap gap-2 mb-6">

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


                            <!-- Ссылка -->
                            <div class="pt-4 border-t border-white/5">

                                <a href="{{ $case->url }}"
                                   data-goal="case_detail_click"
                                   data-case="{{ $case->slug }}"
                                   class="text-accent hover:text-accent transition text-sm font-medium group-hover:translate-x-1 transition-transform inline-flex items-center gap-1">

                                    Подробнее о проекте

                                    <span class="group-hover:translate-x-0.5 transition-transform">
                                        →
                                    </span>

                                </a>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="bg-card rounded-3xl p-8 text-center border border-white/5">
                <p class="text-text-secondary">
                    Кейсы пока не опубликованы.
                </p>
            </div>

        @endif


        <!-- CTA -->
        <div class="mt-12">

            <div class="bg-card rounded-3xl p-8 border border-white/5 text-center">

                <div class="max-w-2xl mx-auto">

                    <h2 class="text-2xl font-bold mb-4">
                        Есть задача по сайту?
                    </h2>

                    <p class="text-text-secondary text-lg mb-6">
                        Расскажите, что нужно сделать.
                        Если проект уже существует — сначала разберусь в нём.
                        Если его ещё нет — обсудим, как лучше реализовать задачу с нуля.
                    </p>

                    <a href="{{ url('/#contacts') }}"
                       data-goal="project_cta_click"
                       class="inline-block px-8 py-4 bg-accent text-background font-bold rounded-xl hover:bg-accent/90 transition shadow-lg hover:shadow-xl">

                        Обсудить задачу

                    </a>

                </div>

            </div>

        </div>

    </div>
</section>

@endsection