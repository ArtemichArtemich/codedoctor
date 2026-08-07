@extends('layouts.app')

@section('title', 'Политика cookies | Code Doctor')
@section('description', 'Политика использования файлов cookies на сайте Code Doctor.')

@section('content')
<section class="py-20">
    <div class="container max-w-4xl">
        <h1 class="text-3xl md:text-4xl font-bold mb-8">Политика использования файлов cookies</h1>
        
        <div class="bg-card rounded-3xl p-8 space-y-6">
            <div>
                <h2 class="text-xl font-bold mb-3">1. Что такое cookies?</h2>
                <p class="text-text-secondary">
                    Cookies (куки) — это небольшие текстовые файлы, которые сохраняются на вашем устройстве 
                    (компьютере, смартфоне, планшете) при посещении веб-сайтов. Они помогают сайтам запоминать 
                    информацию о ваших посещениях и настройках, что улучшает удобство использования.
                </p>
            </div>
            
            <div>
                <h2 class="text-xl font-bold mb-3">2. Какие cookies использует сайт code-doctor.ru?</h2>
                <p class="text-text-secondary mb-3">На нашем сайте используются следующие типы cookies:</p>
                <ul class="text-text-secondary space-y-3">
                    <li>
                        <strong>1. Технические (необходимые) cookies:</strong>
                        <ul class="ml-4 mt-1 space-y-1 text-text-secondary/80">
                            <li>— Сессионные cookies для работы контактной формы</li>
                            <li>— Cookies защиты от CSRF-атак</li>
                            <li>— Cookies для сохранения настроек безопасности</li>
                            <li><em>Цель:</em> обеспечение базовой функциональности сайта, защита от спама и атак</li>
                        </ul>
                    </li>
                    
                    <li>
                        <strong>2. Аналитические cookies (анонимные):</strong>
                        <ul class="ml-4 mt-1 space-y-1 text-text-secondary/80">
                            <li>— Яндекс.Метрика (анонимизированные данные)</li>
                            <li>— Google Analytics (анонимизированные данные)</li>
                            <li><em>Цель:</em> анализ посещаемости, понимание поведения пользователей, улучшение сайта</li>
                            <li><em>Важно:</em> эти cookies не идентифицируют личность, используются в обезличенном виде</li>
                        </ul>
                    </li>
                    
                    <li>
                        <strong>3. Функциональные cookies:</strong>
                        <ul class="ml-4 mt-1 space-y-1 text-text-secondary/80">
                            <li>— Запоминание состояния аккордеонов FAQ</li>
                            <li>— Сохранение настроек отображения (если таковые будут добавлены)</li>
                            <li><em>Цель:</em> улучшение пользовательского опыта</li>
                        </ul>
                    </li>
                </ul>
            </div>
            
            <div>
                <h2 class="text-xl font-bold mb-3">3. Что НЕ отслеживается через cookies?</h2>
                <p class="text-text-secondary">На нашем сайте <strong>НЕ используются</strong>:</p>
                <ul class="text-text-secondary space-y-2 mt-2 ml-4">
                    <li>— Рекламные cookies (retargeting, поведенческая реклама)</li>
                    <li>— Cookies социальных сетей (Facebook, VK, Twitter виджеты)</li>
                    <li>— Cookies для отслеживания между сайтами</li>
                    <li>— Cookies, собирающие чувствительную информацию</li>
                    <li>— Cookies для создания профилей пользователей</li>
                </ul>
            </div>
            
            <div>
                <h2 class="text-xl font-bold mb-3">4. Сроки хранения cookies</h2>
                <ul class="text-text-secondary space-y-2">
                    <li><strong>Сессионные cookies:</strong> удаляются после закрытия браузера</li>
                    <li><strong>Постоянные cookies:</strong> хранятся от 1 дня до 2 лет (аналитические системы)</li>
                    <li><strong>Технические cookies:</strong> обычно до 24 часов или до завершения сессии</li>
                </ul>
            </div>
            
            <div>
                <h2 class="text-xl font-bold mb-3">5. Как управлять cookies?</h2>
                <p class="text-text-secondary mb-3">Вы можете контролировать использование cookies несколькими способами:</p>
                
                <div class="space-y-4">
                    <div>
                        <h3 class="font-bold mb-2 text-accent">5.1. Через настройки браузера:</h3>
                        <ul class="text-text-secondary space-y-1 ml-4">
                            <li><strong>Google Chrome:</strong> Настройки → Конфиденциальность и безопасность → Файлы cookie</li>
                            <li><strong>Mozilla Firefox:</strong> Настройки → Приватность и защита → Куки и данные сайтов</li>
                            <li><strong>Safari:</strong> Настройки → Конфиденциальность → Управление данными сайтов</li>
                            <li><strong>Opera:</strong> Настройки → Конфиденциальность и безопасность → Файлы cookie</li>
                        </ul>
                    </div>
                    
                    <div>
                        <h3 class="font-bold mb-2 text-accent">5.2. Через инструменты отказа:</h3>
                        <ul class="text-text-secondary space-y-1 ml-4">
                            <li><strong>Google Analytics:</strong> <a href="https://tools.google.com/dlpage/gaoptout" class="text-accent hover:underline" target="_blank" rel="noopener noreferrer">Инструмент отключения</a></li>
                            <li><strong>Яндекс.Метрика:</strong> <a href="https://yandex.ru/support/metrica/general/opt-out.html" class="text-accent hover:underline" target="_blank" rel="noopener noreferrer">Инструкция по отказу</a></li>
                        </ul>
                    </div>
                    
                    <div class="p-4 bg-yellow-500/10 rounded-xl border border-yellow-500/20">
                        <p class="text-sm text-text-secondary">
                            <strong>Важно:</strong> Отключение технических cookies может привести к некорректной работе 
                            контактной формы и некоторых функций сайта. Аналитические cookies можно отключать без 
                            ущерба для функциональности.
                        </p>
                    </div>
                </div>
            </div>
            
            <div>
                <h2 class="text-xl font-bold mb-3">6. Правовая основа</h2>
                <p class="text-text-secondary">
                    Использование cookies регулируется:
                </p>
                <ul class="text-text-secondary space-y-2 mt-2 ml-4">
                    <li>— Федеральным законом № 152-ФЗ «О персональных данных» (для данных, которые могут быть отнесены к персональным)</li>
                    <li>— Правилами использования файлов cookie, утверждёнными Роскомнадзором</li>
                    <li>— Политикой конфиденциальности сайта code-doctor.ru</li>
                </ul>
            </div>
            
            <div>
                <h2 class="text-xl font-bold mb-3">7. Изменения в политике</h2>
                <p class="text-text-secondary">
                    Мы оставляем за собой право изменять данную политику использования cookies. 
                    Все изменения будут опубликованы на этой странице.
                </p>
                <p class="text-text-secondary mt-2">
                    При существенных изменениях мы разместим заметное уведомление на сайте 
                    или отправим уведомление непосредственно затронутым пользователям (если это возможно).
                </p>
            </div>
            
            <div class="pt-4 border-t border-white/10">
                <p class="text-text-secondary mb-2">
                    <strong>Контакты для вопросов о cookies:</strong>
                </p>
                <ul class="text-text-secondary text-sm space-y-1 ml-4">
                    <li>Email: <strong>web@code-doctor.ru</strong></li>
                    <li>Telegram: <strong>@artem_fullstack</strong></li>
                </ul>
                <p class="text-text-secondary text-sm mt-4">
                    <strong>Дата последнего обновления:</strong> 28 марта 2024 г.
                </p>
            </div>
        </div>
    </div>
</section>
@endsection