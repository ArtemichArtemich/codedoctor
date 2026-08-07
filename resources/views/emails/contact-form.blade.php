<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Новая заявка с сайта</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        .info { background: #fff; border: 1px solid #dee2e6; border-radius: 8px; padding: 20px; }
        .label { font-weight: bold; color: #495057; }
        .value { margin-bottom: 15px; }
        .message { background: #e9ecef; padding: 15px; border-radius: 5px; white-space: pre-wrap; }
        .footer { margin-top: 30px; padding-top: 20px; border-top: 1px solid #dee2e6; font-size: 12px; color: #6c757d; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>📧 Новая заявка с сайта Code-Doctor.ru</h2>
            <p>Дата: {{ $contact->created_at->format('d.m.Y H:i') }}</p>
        </div>
        
        <div class="info">
            <div class="value">
                <div class="label">👤 Имя:</div>
                <div>{{ $contact->name }}</div>
            </div>
            
            <div class="value">
                <div class="label">📱 Контакт:</div>
                <div>{{ $contact->contact }}</div>
            </div>
            
            @if($contact->website)
            <div class="value">
                <div class="label">🌐 Сайт:</div>
                <div><a href="{{ $contact->website }}" target="_blank">{{ $contact->website }}</a></div>
            </div>
            @endif
            
            <div class="value">
                <div class="label">📝 Описание задачи:</div>
                <div class="message">{{ $contact->message }}</div>
            </div>
            
            <div class="value">
                <div class="label">📊 Техническая информация:</div>
                <div>IP: {{ $contact->ip_address }}</div>
                <div>Время: {{ $contact->created_at->format('d.m.Y H:i') }}</div>
            </div>
        </div>
        
        <div class="footer">
            <p>Это письмо отправлено автоматически с формы обратной связи сайта Code-Doctor.ru</p>
            <p>Не отвечайте на это письмо. Для связи используйте контакт клиента, указанный выше.</p>
        </div>
    </div>
</body>
</html>