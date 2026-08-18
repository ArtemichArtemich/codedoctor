@extends('layouts.app')

@section('title', $trackerProject->title)

@section('content')
<div class="container py-8">
    <!-- Заголовок -->
    <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-3 flex-wrap">
                <h1 class="text-3xl md:text-4xl font-bold">{{ $trackerProject->title }}</h1>
                <span class="px-3 py-1 bg-background/50 rounded-lg text-xs font-medium text-text-secondary">
                    {{ $trackerProject->status_label }}
                </span>
            </div>
            <p class="text-text-secondary mt-1">Проект трекера задач</p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('admin.tracker-projects.edit', $trackerProject) }}" 
               class="px-6 py-3 border border-white/10 text-white font-bold rounded-xl hover:border-accent/40 hover:text-accent transition">
                Редактировать
            </a>
            <a href="{{ route('admin.tracker-projects.index') }}" 
               class="px-6 py-3 border border-white/10 text-text-secondary font-bold rounded-xl hover:border-white/20 hover:text-white transition">
                ← Назад
            </a>
        </div>
    </div>

    <!-- Карточка информации -->
    <div class="bg-card p-6 md:p-8 rounded-3xl border border-white/5 mb-8">
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <div class="text-sm text-text-tertiary mb-1">Клиент</div>
                <div class="font-medium">{{ $trackerProject->client_name ?? 'Не указан' }}</div>
            </div>
            <div>
                <div class="text-sm text-text-tertiary mb-1">Slug</div>
                <div class="font-medium">{{ $trackerProject->slug ?? 'Не указан' }}</div>
            </div>
            <div>
                <div class="text-sm text-text-tertiary mb-1">Сайт</div>
                <div>
                    @if($trackerProject->site_url)
                        <a href="{{ $trackerProject->site_url }}" target="_blank" rel="noopener noreferrer" 
                           class="text-accent hover:underline">
                            {{ $trackerProject->site_url }}
                        </a>
                    @else
                        <span class="text-text-tertiary">Не указан</span>
                    @endif
                </div>
            </div>
            <div>
                <div class="text-sm text-text-tertiary mb-1">Репозиторий</div>
                <div>
                    @if($trackerProject->repository_url)
                        <a href="{{ $trackerProject->repository_url }}" target="_blank" rel="noopener noreferrer" 
                           class="text-accent hover:underline">
                            {{ $trackerProject->repository_url }}
                        </a>
                    @else
                        <span class="text-text-tertiary">Не указан</span>
                    @endif
                </div>
            </div>
            <div>
                <div class="text-sm text-text-tertiary mb-1">Создан</div>
                <div class="font-medium">{{ $trackerProject->created_at->format('d.m.Y H:i') }}</div>
            </div>
            <div>
                <div class="text-sm text-text-tertiary mb-1">Статус</div>
                <div class="font-medium">{{ $trackerProject->status_label }}</div>
            </div>
        </div>
        @if($trackerProject->description)
            <div class="mt-6 pt-6 border-t border-white/5">
                <div class="text-sm text-text-tertiary mb-2">Описание</div>
                <p class="text-text-secondary">{{ $trackerProject->description }}</p>
            </div>
        @endif
    </div>

    <!-- Блок задач -->
    <div>
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            <h2 class="text-2xl font-bold">Задачи</h2>
            <a href="{{ route('admin.tracker-projects.tasks.create', $trackerProject) }}" 
               class="inline-flex items-center gap-2 px-6 py-3 bg-accent text-background font-bold rounded-xl hover:bg-accent/90 transition shadow-lg hover:shadow-xl">
                <span>+</span> Добавить задачу
            </a>
        </div>

        <div class="bg-card p-6 md:p-8 rounded-3xl border border-white/5">
            @if($tasks->isEmpty())
                <div class="text-center py-8">
                    <div class="text-3xl mb-3">📝</div>
                    <p class="text-text-secondary">В этом проекте пока нет задач</p>
                    <a href="{{ route('admin.tracker-projects.tasks.create', $trackerProject) }}" 
                       class="inline-block mt-3 text-accent hover:underline">
                        Создать первую задачу →
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
                                        <span class="px-3 py-1 bg-background/50 rounded-lg text-xs font-medium" 
                                              style="color: {{ $task->status?->color ?? 'gray' }};">
                                            {{ $task->status?->label ?? 'Без статуса' }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <span class="px-3 py-1 bg-background/50 rounded-lg text-xs font-medium"
                                              style="color: {{ $task->priority?->color ?? 'gray' }};">
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
</div>
@endsection
