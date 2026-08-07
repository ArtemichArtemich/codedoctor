@props([
    'src', 
    'alt' => '', 
    'class' => '', 
    'lazy' => true,
    'width' => null,
    'height' => null,
    'priority' => false,
    'sizes' => '100vw',
])

@php
    $baseName = pathinfo($src, PATHINFO_FILENAME);
    $directory = dirname($src);
    $ext = pathinfo($src, PATHINFO_EXTENSION);

    // Путь к оригинальному изображению через Vite
    $originalPath = Vite::asset("resources/images/{$src}");

    // Ищем WebP файл
    $webpPath = "images/{$directory}/{$baseName}.webp";
    $webpExists = file_exists(public_path($webpPath));
    
    // Определяем loading атрибут
    $loadingAttr = $lazy ? 'lazy' : 'eager';
    
    // Определяем fetchpriority
    $fetchPriority = $priority ? 'fetchpriority="high"' : '';
@endphp

@if($webpExists)
    <picture>
        <!-- WebP из public -->
        <source 
            srcset="{{ asset($webpPath) }}" 
            type="image/webp"
            sizes="{{ $sizes }}"
        >
        <!-- Оригинал из Vite -->
        <source 
            srcset="{{ $originalPath }}" 
            type="image/{{ $ext === 'jpg' ? 'jpeg' : $ext }}"
            sizes="{{ $sizes }}"
        >
        <!-- Fallback -->
        <img 
            src="{{ $originalPath }}"
            alt="{{ $alt }}"
            loading="{{ $loadingAttr }}"
            {!! $fetchPriority !!}
            @if($width) width="{{ $width }}" @endif
            @if($height) height="{{ $height }}" @endif
            class="{{ $class }}"
            decoding="async"
            {{ $attributes }}
        >
    </picture>
@else
    <!-- Только оригинал -->
    <img 
        src="{{ $originalPath }}"
        alt="{{ $alt }}"
        loading="{{ $loadingAttr }}"
        {!! $fetchPriority !!}
        @if($width) width="{{ $width }}" @endif
        @if($height) height="{{ $height }}" @endif
        class="{{ $class }}"
        decoding="async"
        {{ $attributes }}
    >
@endif