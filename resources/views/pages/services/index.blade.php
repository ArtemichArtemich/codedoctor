@extends('layouts.app')

@section('title', 'Услуги по разработке, доработке и поддержке сайтов — Code Doctor')
@section('description', 'Диагностика, исправление ошибок, доработка и создание сайтов, интеграции, автоматизация и техническое сопровождение веб-проектов.')

@section('content')

<section class="py-20">
    <div class="container">

        <!-- Заголовок -->
        <div class="text-center mb-12">

            <div class="inline-flex items-center px-4 py-2 bg-accent/10 border border-accent/30 rounded-full mb-6">
                <span class="text-accent font-medium">
                    Направления работы
                </span>
            </div>

            <h1 class="text-3xl md:text-4xl font-bold mb-4">
                Услуги
            </h1>

            <p class="text-text-secondary text-lg max-w-2xl mx-auto">
                Можно прийти как с конкретной задачей, так и с ситуацией,
                когда непонятно, что именно нужно исправить или доработать.
            </p>

        </div>


        @if($services->count())

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach($services as $service)

                    <div class="group bg-card rounded-3xl border border-white/5 p-8 hover:border-accent/30 transition-all duration-300 hover:-translate-y-1">

                        <!-- Иконка -->
                        <div class="w-14 h-14 rounded-2xl bg-accent/10 flex items-center justify-center mb-6">

                            @if($service->icon)

                                <img
                                    src="{{ asset('storage/' . $service->icon) }}"
                                    alt="{{ $service->title }}"
                                    class="w-8 h-8 object-contain"
                                >

                            @else

                                <span class="text-2xl">
                                    ⚙️
                                </span>

                            @endif

                        </div>


                        <!-- Заголовок -->
                        <h2 class="text-xl font-bold mb-3">
                            {{ $service->title }}
                        </h2>


                        <!-- Описание -->
                        @if($service->short_description)

                            <p class="text-text-secondary mb-6 text-sm">
                                {{ Str::limit($service->short_description, 150) }}
                            </p>

                        @endif


                        <!-- Цена -->
                        @if($service->price_from)

                            <div class="mb-6">
                                <span class="text-text-tertiary text-sm">
                                    от
                                </span>

                                <span class="text-accent font-bold">
                                    {{ $service->price_from }}
                                </span>
                            </div>

                        @endif


                        <!-- Подробнее -->
                        <div class="pt-4 border-t border-white/5">

                            <a
                                href="{{ $service->url }}"
                                data-goal="service_detail_click"
                                data-service="{{ $service->slug }}"
                                class="text-accent hover:text-accent transition text-sm font-medium inline-flex items-center gap-1"
                            >
                                Подробнее

                                <span class="group-hover:translate-x-1 transition-transform">
                                    →
                                </span>
                            </a>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="bg-card p-8 rounded-3xl border border-white/5 text-center">
                <p class="text-text-secondary">
                    Услуги пока не опубликованы.
                </p>
            </div>

        @endif


        <!-- CTA -->
        <div class="text-center mt-12">

            <p class="text-text-secondary mb-6">
                Не нашли подходящую услугу или не уверены, что именно нужно?
            </p>

            <a
                href="{{ url('/#contacts') }}"
                data-goal="project_cta_click"
                class="inline-block px-8 py-4 bg-accent text-background font-bold rounded-xl hover:bg-accent/90 transition shadow-lg hover:shadow-xl"
            >
                Описать задачу
            </a>

        </div>

    </div>
</section>

@endsection