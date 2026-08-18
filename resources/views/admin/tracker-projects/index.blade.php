@extends('layouts.app')

@section('title', 'Проекты трекера')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Проекты трекера</h1>
        <a href="{{ route('admin.tracker-projects.create') }}" class="btn btn-primary">
            + Создать проект
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Название</th>
                <th>Клиент</th>
                <th>Сайт</th>
                <th>Статус</th>
                <th>Создан</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @forelse($projects as $project)
                <tr>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->client_name ?? '-' }}</td>
                    <td>
                        @if($project->site_url)
                            <a href="{{ $project->site_url }}" target="_blank" rel="noopener noreferrer">{{ $project->site_url }}</a>
                        @else
                            -
                        @endif
                    </td>
                    <td><span class="badge bg-secondary">{{ $project->status_label }}</span></td>
                    <td>{{ $project->created_at->format('d.m.Y') }}</td>
                    <td>
                        <a href="{{ route('admin.tracker-projects.show', $project) }}" class="btn btn-sm btn-info">Просмотр</a>
                        <a href="{{ route('admin.tracker-projects.edit', $project) }}" class="btn btn-sm btn-warning">Редактировать</a>
                        <form action="{{ route('admin.tracker-projects.destroy', $project) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить проект?')">Удалить</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Нет проектов</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $projects->links() }}
</div>
@endsection