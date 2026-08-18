@extends('layouts.app')

@section('title', 'Задачи проекта')

@section('content')
<div class="container py-8">
    <!-- Заголовок -->
    <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold">Задачи проекта</h1>
            <p class="text-text-secondary mt-1">{{ $trackerProject->title }}</p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('admin.tracker-projects.tasks.create', $trackerProject) }}" 
               class="inline-flex items-center gap-2 px-6 py-3 bg-accent text-background font-bold rounded-xl hover:bg-accent/90 transition shadow-lg hover:shadow-xl">
                <span>+</span> Добавить задачу
            </a>
            <a href="{{ route('admin.tracker-projects.show', $trackerProject) }}" 
               class="px-6 py-3 border border-white/10 text-text-secondary font-bold rounded-xl hover:border-white/20 hover:text-white transition">
                ← Назад к проекту
            </a>
        </div>
    </div>

    <!-- Flash-сообщения -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-accent/10 border border-accent/30 rounded-xl text-accent">
            {{ session('success') }}
        </div>
    @endif

    <!-- Карточка со списком -->
    <div class="bg-card p-6 md:p-8 rounded-3xl border border-white/5">
        @if($tasks->isEmpty())
            <div class="text-center py-12">
                <div class="text-4xl mb-4">📝</div>
                <h3 class="text-xl font-bold mb-2">Нет задач</h3>
                <p class="text-text-secondary">Создайте первую задачу в этом проекте</p>
                <a href="{{ route('admin.tracker-projects.tasks.create', $trackerProject) }}" 
                   class="inline-block mt-4 px-6 py-3 bg-accent text-background font-bold rounded-xl hover:bg-accent/90 transition">
                    + Создать задачу
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-white/5">
                            <th class="text-left py-3 px-4 text-text-tertiary font-medium">Название</th>
                            <th class="text-left py-3 px-4 text-text-tertiary font-medium">Статус</th>
                            <th class="text-left py-3 px-4 text-text-tertiary font-medium">Приоритет</th>
                            <th class="text-left py-3 px-4 text-text-tertiary font-medium">Исполнитель</th>
                            <th class="text-left py-3 px-4 text-text-tertiary font-medium">Срок</th>
                            <th class="text-right py-3 px-4 text-text-tertiary font-medium">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr class="border-b border-white/5 hover:bg-white/5 transition">
                                <td class="py-3 px-4 font-medium">{{ $task->title }}</td>
                                <td class="py-3 px-4">
                                    <span class="px-3 py-1 bg-background/50 rounded-lg text-xs font-medium">
                                        {{ $task->status?->label ?? 'Без статуса' }}
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="px-3 py-1 bg-background/50 rounded-lg text-xs font-medium">
                                        {{ $task->priority?->label ?? 'Без приоритета' }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-text-secondary">{{ $task->assignedTo?->name ?? 'Не назначен' }}</td>
                                <td class="py-3 px-4 text-text-secondary">{{ $task->due_date ? $task->due_date->format('d.m.Y') : '-' }}</td>
                                <td class="py-3 px-4 text-right">
                                    <div class="flex items-center justify-end gap-2 flex-wrap">
                                        <a href="{{ route('admin.tracker-projects.tasks.edit', [$trackerProject, $task]) }}" 
                                           class="px-3 py-1.5 text-sm bg-background/30 rounded-lg hover:bg-accent/20 transition text-text-secondary hover:text-accent">
                                            Редактировать
                                        </a>
                                        <form action="{{ route('admin.tracker-projects.tasks.destroy', [$trackerProject, $task]) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="px-3 py-1.5 text-sm bg-background/30 rounded-lg hover:bg-red-500/20 transition text-text-secondary hover:text-red-400"
                                                    onclick="return confirm('Удалить задачу «{{ $task->title }}»?')">
                                                Удалить
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
