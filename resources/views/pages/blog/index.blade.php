@extends('layouts.app')

@section('title', 'Блог о разработке, сайтах и интернет-магазинах | Code Doctor')

@section(
    'description',
    'Практические разборы разработки, диагностики сайтов, интернет-магазинов, SEO, автоматизации и собственных инструментов Code Doctor.'
)

@section('content')

<section class="py-20">

    <div class="container">

        {{-- Хлебные крошки --}}
        <nav class="mb-8 text-sm">

            <a
                href="{{ url('/') }}"
                class="text-text-secondary hover:text-accent transition"
            >
                Главная
            </a>

            <span class="mx-2 text-text-tertiary">/</span>

            <span class="text-text-primary">
                Блог
            </span>

        </nav>


        {{-- Заголовок --}}
        <div class="max-w-3xl mb-12">

            <div class="inline-flex items-center px-4 py-2 bg-accent/10 border border-accent/30 rounded-full mb-5">

                <span class="text-accent font-medium">
                    Блог Code Doctor
                </span>

            </div>

            <h1 class="text-3xl md:text-5xl font-bold mb-5">
                Практика работы с сайтами и веб-проектами
            </h1>

            <p class="text-lg text-text-secondary leading-relaxed">
                Разбираю реальные задачи из разработки и сопровождения сайтов:
                ошибки, интернет-магазины, интеграции, автоматизацию, SEO,
                аналитику и собственные инструменты.
            </p>

        </div>


        @if($articles->count() > 0)

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach($articles as $article)

                    <article
                        class="group bg-card rounded-3xl overflow-hidden border border-white/5
                               hover:border-accent/30 transition-all duration-300
                               hover:-translate-y-2 hover:shadow-2xl hover:shadow-accent/10"
                    >

                        {{-- Обложка --}}
                        <a
                            href="{{ route('blog.show', $article->slug) }}"
                            class="block"
                            aria-label="Читать статью: {{ $article->title }}"
                        >

                            @if($article->image)

                                <div class="overflow-hidden bg-background">

                                    <img
                                        src="{{ \Illuminate\Support\Facades\Storage::url($article->image) }}"
                                        alt="{{ $article->h1 ?: $article->title }}"
                                        loading="lazy"
                                        decoding="async"
                                        class="w-full h-auto"
                                    >

                                </div>

                            @else

                                <div class="h-56 bg-gradient-to-br from-accent/20 to-accent2/20
                                            flex items-center justify-center">

                                    <div class="w-16 h-16 rounded-2xl bg-card/50 border border-white/10
                                                flex items-center justify-center text-3xl">
                                        📝
                                    </div>

                                </div>

                            @endif

                        </a>


                        <div class="p-6">

                            {{-- Категория + дата --}}
                            <div class="flex flex-wrap items-center gap-3 mb-4">

                                @if($article->category)

                                    <span class="px-3 py-1 bg-accent/10 text-accent rounded-full text-xs font-medium">
                                        {{ $article->category_name }}
                                    </span>

                                @endif


                                @if($article->published_at)

                                    <time
                                        datetime="{{ $article->published_at->toDateString() }}"
                                        class="text-xs text-text-tertiary"
                                    >
                                        {{ $article->published_at->format('d.m.Y') }}
                                    </time>

                                @endif

                            </div>


                            {{-- Название --}}
                            <h2 class="text-xl font-bold mb-3 leading-snug">

                                <a
                                    href="{{ route('blog.show', $article->slug) }}"
                                    class="hover:text-accent transition"
                                >
                                    {{ $article->title }}
                                </a>

                            </h2>


                            {{-- Анонс --}}
                            @if($article->excerpt)

                                <p class="text-text-secondary text-sm leading-relaxed mb-5">
                                    {{ $article->excerpt }}
                                </p>

                            @endif


                            {{-- Теги --}}
                            @if(is_array($article->tags) && count($article->tags) > 0)

                                <div class="flex flex-wrap gap-2 mb-5">

                                    @foreach(array_slice($article->tags, 0, 3) as $tag)

                                        <span class="px-2 py-1 bg-background/50 rounded-lg text-xs text-text-tertiary">
                                            {{ $tag }}
                                        </span>

                                    @endforeach

                                </div>

                            @endif


                            {{-- Ссылка --}}
                            <div class="pt-4 border-t border-white/5">

                                <a
                                    href="{{ route('blog.show', $article->slug) }}"
                                    class="text-accent text-sm font-medium inline-flex items-center gap-2
                                           group-hover:translate-x-1 transition-transform"
                                >
                                    Читать статью
                                    <span>→</span>
                                </a>

                            </div>

                        </div>

                    </article>

                @endforeach

            </div>


            {{-- Пагинация --}}
            @if($articles->hasPages())

                <div class="mt-12">
                    {{ $articles->links() }}
                </div>

            @endif


        @else

            <div class="bg-card rounded-3xl border border-white/5 p-10 text-center">

                <h2 class="text-xl font-bold mb-3">
                    Статей пока нет
                </h2>

                <p class="text-text-secondary">
                    Здесь будут практические разборы задач, кейсы, заметки и инструменты для работы с сайтами.
                </p>

            </div>

        @endif

    </div>

</section>

@endsection