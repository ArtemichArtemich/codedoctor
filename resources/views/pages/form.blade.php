@extends('layouts.app')

@section('title', 'Диагностика OpenCart‑сайта — Аудит здоровья интернет‑магазина | Code Doctor')
@section('description', 'Бесплатная проверка OpenCart‑сайта: версия PHP, SSL, сжатие, заголовки безопасности, открытые пути. Отчёт за 30 секунд.')

@section('content')
<div class="max-w-3xl mx-auto py-12 px-4">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-accent">Диагностика OpenCart-сайта</h1>
        <p class="text-gray-600 mt-2">Проверьте техническое здоровье интернет-магазина за 30 секунд</p>
    </div>

    <div class="bg-card rounded-xl shadow-md p-6 md:p-8">
        <form method="POST" action="{{ route('diagnostic.analyze') }}" class="space-y-4">
            @csrf
            
            <div>
                <label class="block text-text-secondary mb-2">URL сайта</label>
                <input 
                    type="url" 
                    name="url" 
                    required 
                    placeholder="https://example.com"
                    class="w-full px-4 py-3 bg-background border border-white/10 rounded-xl text-white placeholder:text-text-tertiary focus:outline-none focus:border-accent2 transition border-red-500 border-2"
                    value="{{ old('url') }}"
                >
                @error('url')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full py-4 bg-accent text-background font-bold rounded-xl hover:bg-accent/90 transition shadow-lg hover:shadow-xl">
                Запустить проверку
            </button>
        </form>
    </div>

    <div class="mt-8 text-sm text-gray-500">
        ⚡ Проверяем: версию PHP, SSL, сжатие, заголовки безопасности, открытые пути и адаптацию
    </div>
</div>
@endsection