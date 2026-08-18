@extends('layouts.app')

@section('title', $trackerProject->title)

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ $trackerProject->title }}</h1>
        <div>
            <a href="{{ route('admin.tracker-projects.edit', $trackerProject) }}" class="btn btn-warning">Редактировать</a>
            <a href="{{ route('admin.tracker-projects.index') }}" class="btn btn-secondary">← Назад</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Статус:</strong> {{ $trackerProject->status_label }}</p>
                    <p><strong>Клиент:</strong> {{ $trackerProject->client_name ?? '-' }}</p>
                    <p><strong>Slug:</strong> {{ $trackerProject->slug ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Сайт:</strong>
                        @if($trackerProject->site_url)
                            <a href="{{ $trackerProject->site_url }}" target="_blank" rel="noopener noreferrer">{{ $trackerProject->site_url }}</a>
                        @else - @endif
                    </p>
                    <p><strong>Репозиторий:</strong>
                        @if($trackerProject->repository_url)
                            <a href="{{ $trackerProject->repository_url }}" target="_blank" rel="noopener noreferrer">{{ $trackerProject->repository_url }}</a>
                        @else - @endif
                    </p>
                    <p><strong>Создан:</strong> {{ $trackerProject->created_at->format('d.m.Y H:i') }}</p>
                </div>
            </div>

            @if($trackerProject->description)
                <hr>
                <p><strong>Описание:</strong></p>
                <p>{{ $trackerProject->description }}</p>
            @endif
        </div>
    </div>
    
    <div class="mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Задачи</h3>
            <a href="{{ route('admin.tracker-projects.tasks.create', $trackerProject) }}" class="btn btn-primary btn-sm">
                + Добавить задачу
            </a>
        </div>

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
</div>
@endsection
