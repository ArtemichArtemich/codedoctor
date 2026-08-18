@extends('layouts.app')

@section('title', 'Задачи проекта')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Задачи проекта «{{ $trackerProject->title }}»</h1>
        <div>
            <a href="{{ route('admin.tracker-projects.tasks.create', $trackerProject) }}" class="btn btn-primary">
                + Добавить задачу
            </a>
            <a href="{{ route('admin.tracker-projects.show', $trackerProject) }}" class="btn btn-secondary">
                ← Назад к проекту
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($tasks->isEmpty())
        <p class="text-muted">В этом проекте пока нет задач.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Статус</th>
                    <th>Приоритет</th>
                    <th>Исполнитель</th>
                    <th>Срок</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td><span class="badge bg-{{ $task->status->color ?? 'secondary' }}">{{ $task->status->label ?? '-' }}</span></td>
                        <td><span class="badge bg-{{ $task->priority->color ?? 'secondary' }}">{{ $task->priority->label ?? '-' }}</span></td>
                        <td>{{ $task->assignedTo->name ?? 'Не назначен' }}</td>
                        <td>{{ $task->due_date ? $task->due_date->format('d.m.Y') : '-' }}</td>
                        <td>
                            <a href="{{ route('admin.tracker-projects.tasks.edit', [$trackerProject, $task]) }}" class="btn btn-sm btn-warning">Редактировать</a>
                            <form action="{{ route('admin.tracker-projects.tasks.destroy', [$trackerProject, $task]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить задачу?')">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
