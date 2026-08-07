<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Пожалуйста, укажите ваше имя',
            'name.min' => 'Имя должно содержать минимум 2 символа',
            'name.max' => 'Имя не должно превышать 255 символов',
            'contact.required' => 'Укажите контакт для связи (Telegram, email или телефон)',
            'contact.min' => 'Контакт должен содержать минимум 5 символов',
            'contact.max' => 'Контакт не должен превышать 255 символов',
            'website.url' => 'Укажите корректный URL сайта (начинается с http:// или https://)',
            'website.max' => 'Ссылка на сайт не должна превышать 255 символов',
            'message.required' => 'Опишите вашу задачу',
            'message.min' => 'Описание задачи должно быть не менее 10 символов',
            'message.max' => 'Описание задачи не должно превышать 2000 символов',
            'privacy.required' => 'Необходимо согласиться с политикой конфиденциальности',
            'privacy.accepted' => 'Необходимо согласиться с политикой конфиденциальности',
        ];

        $validated = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'contact' => 'required|string|min:5|max:255',
            'website' => 'nullable|url|max:255',
            'message' => 'required|string|min:10|max:2000',
            'privacy' => 'required|accepted',
        ], $messages);
        
        try {
            // Сохраняем в базу
            $contact = Contact::create([
                'name' => $validated['name'],
                'contact' => $validated['contact'],
                'website' => $validated['website'] ?? null,
                'message' => $validated['message'],
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'privacy_agreed' => true,
            ]);
            
            // 1. Отправляем сообщение боту (боту, не вам)
            $this->sendToTelegram($contact);
            
            // 2. Отправляем письмо только на вашу почту, без replyTo
            Mail::to('web@code-doctor.ru')->send(new ContactFormMail($contact));
            
            return response()->json([
                'success' => true,
                'message' => '✅ Заявка отправлена! Я свяжусь с вами в ближайшее время.'
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Ошибка отправки заявки: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Произошла ошибка при отправке. Пожалуйста, напишите мне напрямую в Telegram.'
            ], 500);
        }
    }
    
    private function sendToTelegram(Contact $contact)
    {
        $botToken = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID'); // ID вашего чата/группы
        
        if (!$botToken || !$chatId) {
            \Log::warning('Telegram bot token or chat id not set');
            return;
        }
        
        $message = "🆕 *Новая заявка с сайта*\n\n";
        $message .= "👤 *Имя:* " . $contact->name . "\n";
        $message .= "📱 *Контакт:* " . $contact->contact . "\n";
        
        if ($contact->website) {
            $message .= "🌐 *Сайт:* " . $contact->website . "\n";
        }
        
        $message .= "📝 *Задача:*\n" . substr($contact->message, 0, 500) . "\n\n";
        $message .= "🕐 " . $contact->created_at->format('d.m.Y H:i');
        
        $url = "https://api.telegram.org/bot{$botToken}/sendMessage";
        
        $data = [
            'chat_id' => $chatId, // Используем chat_id из .env
            'text' => $message,
            'parse_mode' => 'Markdown',
            'disable_web_page_preview' => true,
        ];
        
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->post($url, [
                'json' => $data,
                'timeout' => 5,
            ]);
            
            if ($response->getStatusCode() === 200) {
                \Log::info('Telegram notification sent successfully');
            }
            
        } catch (\Exception $e) {
            \Log::error('Telegram sending failed: ' . $e->getMessage());
        }
    }
}