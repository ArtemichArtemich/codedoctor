@extends('layouts.app')

@section('title', 'Создать проект')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Создать проект</h1>
        <a href="{{ route('admin.tracker-projects.index') }}" class="btn btn-secondary">← Назад к списку</a>
    </div>

    <form action="{{ route('admin.tracker-projects.store') }}" method="POST">
        @csrf
        @include('admin.tracker-projects._form')
        <button type="submit" class="btn btn-success">Создать</button>
    </form>
</div>
@endsection