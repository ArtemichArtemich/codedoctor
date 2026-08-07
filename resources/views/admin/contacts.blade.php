<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заявки с сайта</title>
    <style>
        body { font-family: sans-serif; padding: 20px; background: #f5f5f5; }
        .contact { background: white; padding: 15px; margin-bottom: 10px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .contact h3 { margin-top: 0; color: #333; }
        .contact p { margin: 5px 0; color: #666; }
        .empty { text-align: center; padding: 40px; color: #999; }
    </style>
</head>
<body>
    <h1>Заявки с сайта ({{ $contacts->count() }})</h1>
    
    @if($contacts->isEmpty())
        <div class="empty">Нет заявок</div>
    @else
        @foreach($contacts as $contact)
            <div class="contact">
                <h3>📩 Заявка #{{ $contact->id }}</h3>
                <p><strong>Имя:</strong> {{ $contact->name }}</p>
                <p><strong>Контакты:</strong> {{ $contact->contact }}</p>
                @if($contact->website)
                    <p><strong>Сайт:</strong> <a href="{{ $contact->website }}" target="_blank">{{ $contact->website }}</a></p>
                @endif
                <p><strong>Сообщение:</strong> {{ $contact->message }}</p>
                <p><strong>Дата:</strong> {{ $contact->created_at->format('d.m.Y H:i') }}</p>
                <p><strong>IP:</strong> {{ $contact->ip_address }}</p>
            </div>
        @endforeach
    @endif
    
    <div style="margin-top: 20px;">
        <a href="{{ url('/') }}">← На главную</a>
    </div>
</body>
</html>