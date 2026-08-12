<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
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


        /*
         * Сначала сохраняем заявку.
         *
         * Если БД недоступна — возвращаем ошибку.
         * Если Telegram или почта не работают —
         * заявка всё равно останется в админке.
         */
        try {

            $contact = Contact::create([
                'name' => $validated['name'],
                'contact' => $validated['contact'],
                'website' => $validated['website'] ?? null,
                'message' => $validated['message'],

                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),

                'privacy_agreed' => true,
            ]);

        } catch (\Throwable $e) {

            Log::error('Не удалось сохранить заявку', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Произошла ошибка при отправке. Пожалуйста, напишите мне напрямую в Telegram.',
            ], 500);
        }


        /*
         * Telegram
         *
         * Ошибка Telegram не должна превращать
         * уже сохранённую заявку в ошибку для пользователя.
         */
        try {

            $this->sendToTelegram($contact);

        } catch (\Throwable $e) {

            Log::error('Ошибка уведомления Telegram', [
                'contact_id' => $contact->id,
                'error' => $e->getMessage(),
            ]);
        }


        /*
         * Email
         *
         * Та же логика: заявка уже сохранена,
         * поэтому сбой почты только логируем.
         */
        try {

            Mail::to('web@code-doctor.ru')
                ->send(new ContactFormMail($contact));

        } catch (\Throwable $e) {

            Log::error('Ошибка отправки email о заявке', [
                'contact_id' => $contact->id,
                'error' => $e->getMessage(),
            ]);
        }


        return response()->json([
            'success' => true,
            'message' => 'Заявка отправлена. Я свяжусь с вами в ближайшее время.',
        ]);
    }


    private function sendToTelegram(Contact $contact): void
    {
        $botToken = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');


        if (!$botToken || !$chatId) {

            Log::warning('Telegram bot token or chat id not set');

            return;
        }


        $message = "Новая заявка с сайта\n\n";

        $message .= "Имя: {$contact->name}\n";

        $message .= "Контакт: {$contact->contact}\n";


        if ($contact->website) {
            $message .= "Сайт: {$contact->website}\n";
        }


        $message .= "\nЗадача:\n";
        $message .= mb_substr($contact->message, 0, 1000);

        $message .= "\n\n";
        $message .= $contact->created_at->format('d.m.Y H:i');


        $response = Http::timeout(5)
            ->post(
                "https://api.telegram.org/bot{$botToken}/sendMessage",
                [
                    'chat_id' => $chatId,
                    'text' => $message,
                    'disable_web_page_preview' => true,
                ]
            );


        if ($response->failed()) {

            Log::error('Telegram API returned error', [
                'contact_id' => $contact->id,
                'status' => $response->status(),
                'response' => $response->body(),
            ]);

            return;
        }


        Log::info('Telegram notification sent', [
            'contact_id' => $contact->id,
        ]);
    }
}