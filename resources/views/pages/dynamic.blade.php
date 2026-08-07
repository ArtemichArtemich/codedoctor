@extends('layouts.app')

@section('title', ($page->meta_title ?? $page->title))
@section('description', $page->meta_description ?? 'Страница ' . $page->title)

@section('content')
<section class="py-20">
    <div class="container max-w-4xl">
        <!-- Хлебные крошки -->
        <nav class="mb-8">
            <a href="{{ url('/') }}" class="text-text-secondary hover:text-accent transition">Главная</a>
            <span class="mx-2 text-text-tertiary">/</span>
            <span class="text-text-primary">{{ $page->title }}</span>
        </nav>
        
        <!-- Заголовок -->
        <h1 class="text-3xl md:text-4xl font-bold mb-8">{{ $page->h1 ?? $page->title }}</h1>
        
        <!-- Контент -->
        <div class="prose prose-invert max-w-none">
            {!! $page->content !!}
        </div>
    </div>
</section>
@endsection