@extends('layouts.app')

@section('title', 'Редактировать проект')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Редактировать проект</h1>
        <a href="{{ route('admin.tracker-projects.index') }}" class="btn btn-secondary">← Назад к списку</a>
    </div>

    <form action="{{ route('admin.tracker-projects.update', $trackerProject) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.tracker-projects._form', ['project' => $trackerProject])
        <button type="submit" class="btn btn-success">Обновить</button>
    </form>
</div>
@endsection