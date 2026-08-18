@extends('layouts.app')

@section('title', 'Новая задача')

@section('content')
<div class="container py-8">
    <!-- Заголовок -->
    <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold">Новая задача</h1>
            <p class="text-text-secondary mt-1">Проект: {{ $trackerProject->title }}</p>
        </div>
        <a href="{{ route('admin.tracker-projects.show', $trackerProject) }}" 
           class="inline-flex items-center gap-2 px-6 py-3 border border-white/10 text-white font-bold rounded-xl hover:border-accent/40 hover:text-accent transition">
            ← Назад к проекту
        </a>
    </div>

    <!-- Форма в карточке -->
    <div class="bg-card p-6 md:p-8 rounded-3xl border border-white/5">
        <form action="{{ route('admin.tracker-projects.tasks.store', $trackerProject) }}" method="POST">
            @csrf
            @include('admin.tasks._form')
            <div class="flex flex-wrap items-center gap-4 mt-6 pt-6 border-t border-white/5">
                <button type="submit" class="px-8 py-4 bg-accent text-background font-bold rounded-xl hover:bg-accent/90 transition shadow-lg hover:shadow-xl">
                    Создать задачу
                </button>
                <a href="{{ route('admin.tracker-projects.show', $trackerProject) }}" 
                   class="px-8 py-4 border border-white/10 text-text-secondary font-bold rounded-xl hover:border-white/20 hover:text-white transition">
                    Отмена
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
