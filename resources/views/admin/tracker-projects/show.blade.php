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
        <h3>Задачи</h3>
        <p class="text-muted">Список задач появится на следующем этапе.</p>
    </div>
</div>
@endsection
