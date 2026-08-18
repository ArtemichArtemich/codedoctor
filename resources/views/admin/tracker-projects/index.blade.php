@extends('layouts.app')

@section('title', 'Проекты трекера')

@section('content')
<div class="container py-8">
    <!-- Заголовок -->
    <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold">Проекты трекера</h1>
            <p class="text-text-secondary mt-1">Управление проектами и задачами</p>
        </div>
        <a href="{{ route('admin.tracker-projects.create') }}" 
           class="inline-flex items-center gap-2 px-6 py-3 bg-accent text-background font-bold rounded-xl hover:bg-accent/90 transition shadow-lg hover:shadow-xl">
            <span>+</span> Создать проект
        </a>
    </div>

    <!-- Flash-сообщения -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-accent/10 border border-accent/30 rounded-xl text-accent">
            {{ session('success') }}
        </div>
    @endif

    <!-- Карточка со списком -->
    <div class="bg-card p-6 md:p-8 rounded-3xl border border-white/5">
        @if($projects->isEmpty())
            <div class="text-center py-12">
                <div class="text-4xl mb-4">📋</div>
                <h3 class="text-xl font-bold mb-2">Пока нет проектов</h3>
                <p class="text-text-secondary">Создайте первый проект для управления задачами</p>
                <a href="{{ route('admin.tracker-projects.create') }}" 
                   class="inline-block mt-4 px-6 py-3 bg-accent text-background font-bold rounded-xl hover:bg-accent/90 transition">
                    + Создать проект
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-white/5">
                            <th class="text-left py-3 px-4 text-text-tertiary font-medium">Название</th>
                            <th class="text-left py-3 px-4 text-text-tertiary font-medium">Клиент</th>
                            <th class="text-left py-3 px-4 text-text-tertiary font-medium">Сайт</th>
                            <th class="text-left py-3 px-4 text-text-tertiary font-medium">Статус</th>
                            <th class="text-left py-3 px-4 text-text-tertiary font-medium">Задач</th>
                            <th class="text-right py-3 px-4 text-text-tertiary font-medium">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                            <tr class="border-b border-white/5 hover:bg-white/5 transition">
                                <td class="py-3 px-4 font-medium">
                                    <a href="{{ route('admin.tracker-projects.show', $project) }}" 
                                       class="hover:text-accent transition">
                                        {{ $project->title }}
                                    </a>
                                </td>
                                <td class="py-3 px-4 text-text-secondary">{{ $project->client_name ?? '-' }}</td>
                                <td class="py-3 px-4">
                                    @if($project->site_url)
                                        <a href="{{ $project->site_url }}" target="_blank" rel="noopener noreferrer" 
                                           class="text-text-secondary hover:text-accent transition text-sm">
                                            {{ Str::limit($project->site_url, 30) }}
                                        </a>
                                    @else
                                        <span class="text-text-tertiary text-sm">-</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    <span class="px-3 py-1 bg-background/50 rounded-lg text-xs font-medium text-text-secondary">
                                        {{ $project->status_label }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-text-secondary">
                                    {{ $project->tasks->count() }}
                                </td>
                                <td class="py-3 px-4 text-right">
                                    <div class="flex items-center justify-end gap-2 flex-wrap">
                                        <a href="{{ route('admin.tracker-projects.show', $project) }}" 
                                           class="px-3 py-1.5 text-sm bg-background/30 rounded-lg hover:bg-accent/20 transition text-text-secondary hover:text-accent">
                                            Просмотр
                                        </a>
                                        <a href="{{ route('admin.tracker-projects.edit', $project) }}" 
                                           class="px-3 py-1.5 text-sm bg-background/30 rounded-lg hover:bg-accent/20 transition text-text-secondary hover:text-accent">
                                            Редактировать
                                        </a>
                                        <form action="{{ route('admin.tracker-projects.destroy', $project) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="px-3 py-1.5 text-sm bg-background/30 rounded-lg hover:bg-red-500/20 transition text-text-secondary hover:text-red-400"
                                                    onclick="return confirm('Удалить проект «{{ $project->title }}»? Все задачи будут удалены.')">
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
            <div class="mt-6">
                {{ $projects->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
