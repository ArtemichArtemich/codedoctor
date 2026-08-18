@extends('layouts.app')

@section('title', 'Редактировать задачу')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Редактировать задачу «{{ $task->title }}»</h1>
        <a href="{{ route('admin.tracker-projects.show', $trackerProject) }}" class="btn btn-secondary">← Назад к проекту</a>
    </div>

    <form action="{{ route('admin.tracker-projects.tasks.update', [$trackerProject, $task]) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.tasks._form', ['task' => $task])
        <button type="submit" class="btn btn-success">Обновить задачу</button>
    </form>
</div>
@endsection
