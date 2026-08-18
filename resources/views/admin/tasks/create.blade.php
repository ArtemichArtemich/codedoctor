@extends('layouts.app')

@section('title', 'Новая задача')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Новая задача в проекте «{{ $trackerProject->title }}»</h1>
        <a href="{{ route('admin.tracker-projects.show', $trackerProject) }}" class="btn btn-secondary">← Назад к проекту</a>
    </div>

    <form action="{{ route('admin.tracker-projects.tasks.store', $trackerProject) }}" method="POST">
        @csrf
        @include('admin.tasks._form')
        <button type="submit" class="btn btn-success">Создать задачу</button>
    </form>
</div>
@endsection