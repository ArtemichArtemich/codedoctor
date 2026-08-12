@extends('layouts.app')

@section(
    'title',
    $article->meta_title ?: ($article->title . ' | Code Doctor')
)

@section(
    'description',
    $article->meta_description
        ?: ($article->excerpt
            ?: \Illuminate\Support\Str::limit(strip_tags($article->content), 155))
)

@if($article->image)
    @section('og_image', asset('storage/' . $article->image))
@endif

@section('og_type', 'article')

@section('content')

<section class="py-20">

    <div class="container">

        <div class="max-w-4xl mx-auto">

            {{-- Хлебные крошки --}}
            <nav class="mb-8 text-sm">

                <a href="{{ url('/') }}"
                   class="text-text-secondary hover:text-accent transition">
                    Главная
                </a>

                <span class="mx-2 text-text-tertiary">/</span>

                <a href="{{ route('blog.index') }}"
                   class="text-text-secondary hover:text-accent transition">
                    Блог
                </a>

                <span class="mx-2 text-text-tertiary">/</span>

                <span class="text-text-primary">
                    {{ $article->title }}
                </span>

            </nav>

            {{-- Заголовок --}}
            <header class="mb-10">

                <div class="flex flex-wrap items-center gap-3 mb-5">

                    @if($article->category)

                        <span class="px-3 py-1 bg-accent/10 border border-accent/20 text-accent rounded-full text-sm">
                            {{ $article->category_name }}
                        </span>

                    @endif

                    @if($article->published_at)

                        <time
                            datetime="{{ $article->published_at->toDateString() }}"
                            class="text-sm text-text-tertiary"
                        >
                            {{ $article->published_at->format('d.m.Y') }}
                        </time>

                    @endif

                </div>

                <h1 class="text-3xl md:text-5xl font-bold leading-tight mb-6">
                    {{ $article->h1 ?: $article->title }}
                </h1>

                @if($article->excerpt)

                    <p class="text-lg md:text-xl text-text-secondary leading-relaxed">
                        {{ $article->excerpt }}
                    </p>

                @endif

            </header>

            {{-- Обложка --}}
            @if($article->image)

                <div class="mb-10 rounded-3xl overflow-hidden border border-white/10">

                    <img
                        src="{{ asset('storage/' . $article->image) }}"
                        alt="{{ $article->h1 ?: $article->title }}"
                        class="w-full h-auto"
                    >

                </div>

            @endif

            {{-- Статья --}}
            <article class="bg-card rounded-3xl border border-white/5 p-6 md:p-10 mb-10">

                <div class="prose prose-invert prose-lg max-w-none
                            prose-headings:text-white
                            prose-a:text-accent
                            prose-strong:text-white
                            prose-code:text-accent">

                    {!! $article->content !!}

                </div>

            </article>

            {{-- Теги --}}
            @if(is_array($article->tags) && count($article->tags) > 0)

                <div class="flex flex-wrap gap-2 mb-12">

                    @foreach($article->tags as $tag)

                        <span class="px-3 py-2 bg-card border border-white/5 rounded-xl text-sm text-text-secondary">
                            #{{ $tag }}
                        </span>

                    @endforeach

                </div>

            @endif

            {{-- CTA --}}
            <div class="bg-card border border-accent/20 rounded-3xl p-8 mb-12">

                <h2 class="text-2xl font-bold mb-3">
                    Есть похожая задача?
                </h2>

                <p class="text-text-secondary mb-6">
                    Опишите ситуацию своими словами. Посмотрю, в чём проблема,
                    могу ли помочь и какой вариант решения будет разумнее.
                </p>

                <a
                    href="{{ url('/#contacts') }}"
                    data-goal="article_cta_click"
                    data-article="{{ $article->slug }}"
                    class="inline-block px-8 py-3 bg-accent text-background font-bold rounded-xl hover:bg-accent/90 transition"
                >
                    Обсудить задачу
                </a>

            </div>

            {{-- Связанные статьи --}}
            @if($relatedArticles->count() > 0)

                <div class="border-t border-white/10 pt-10">

                    <h2 class="text-2xl font-bold mb-6">
                        Ещё по теме
                    </h2>

                    <div class="grid md:grid-cols-3 gap-5">

                        @foreach($relatedArticles as $relatedArticle)

                            <a
                                href="{{ route('blog.show', $relatedArticle->slug) }}"
                                class="block bg-card rounded-2xl border border-white/5 hover:border-accent/30 p-5 transition"
                            >

                                <div class="flex flex-wrap items-center gap-2 mb-3">

                                    @if($relatedArticle->category)

                                        <span class="text-xs text-accent">
                                            {{ $relatedArticle->category_name }}
                                        </span>

                                    @endif

                                    @if($relatedArticle->published_at)

                                        <span class="text-xs text-text-tertiary">
                                            {{ $relatedArticle->published_at->format('d.m.Y') }}
                                        </span>

                                    @endif

                                </div>

                                <h3 class="font-bold leading-snug">
                                    {{ $relatedArticle->title }}
                                </h3>

                            </a>

                        @endforeach

                    </div>

                </div>

            @endif

            {{-- Назад в блог --}}
            <div class="mt-12">

                <a
                    href="{{ route('blog.index') }}"
                    class="text-text-secondary hover:text-accent transition"
                >
                    ← Все статьи
                </a>

            </div>

        </div>

    </div>

</section>

{{-- Schema.org --}}
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Article',

    'headline' => $article->h1 ?: $article->title,

    'description' => $article->meta_description
        ?: ($article->excerpt
            ?: \Illuminate\Support\Str::limit(strip_tags($article->content), 155)),

    'datePublished' => $article->published_at
        ? $article->published_at->toIso8601String()
        : null,

    'dateModified' => $article->updated_at
        ? $article->updated_at->toIso8601String()
        : null,

    'mainEntityOfPage' => [
        '@type' => 'WebPage',
        '@id' => route('blog.show', $article->slug),
    ],

    'author' => [
        '@type' => 'Person',
        'name' => 'Артём',
    ],

    'publisher' => [
        '@type' => 'Organization',
        'name' => 'Code Doctor',
        'url' => url('/'),
    ],

    'image' => $article->image
        ? asset('storage/' . $article->image)
        : null,

], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    if (window.cdAnalytics?.reachGoal) {

        window.cdAnalytics.reachGoal('article_view', {
            article: @json($article->slug),
            title: @json($article->title),
            category: @json($article->category),
            page: window.location.href
        });

    }

});
</script>

@endsection