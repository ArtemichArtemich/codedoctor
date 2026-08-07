@extends('layouts.admin')

@section('title', 'Просмотр заявки')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-4">
        <a href="{{ route('admin.contacts.index') }}" class="text-blue-600 hover:underline">← Назад к списку</a>
    </div>
    
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold">Заявка #{{ $contact->id }}</h2>
        </div>
        
        <div class="p-6">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Имя</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $contact->name }}</dd>
                </div>
                
                <div>
                    <dt class="text-sm font-medium text-gray-500">Контакт</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $contact->contact }}</dd>
                </div>
                
                @if($contact->website)
                <div>
                    <dt class="text-sm font-medium text-gray-500">Сайт</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        <a href="{{ $contact->website }}" target="_blank" class="text-blue-600 hover:underline">
                            {{ $contact->website }}
                        </a>
                    </dd>
                </div>
                @endif
                
                <div>
                    <dt class="text-sm font-medium text-gray-500">IP адрес</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $contact->ip_address ?? 'Не указан' }}</dd>
                </div>
                
                <div>
                    <dt class="text-sm font-medium text-gray-500">User Agent</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $contact->user_agent ?? 'Не указан' }}</dd>
                </div>
                
                <div>
                    <dt class="text-sm font-medium text-gray-500">Дата создания</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $contact->created_at->format('d.m.Y H:i:s') }}</dd>
                </div>
                
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Сообщение</dt>
                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $contact->message }}</dd>
                </div>
            </dl>
        </div>
        
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Удалить заявку?')">
                    Удалить заявку
                </button>
            </form>
        </div>
    </div>
</div>
@endsection