@extends('layouts.app')

@section('title', 'Разработка и доработка OpenCart | Артём — Fullstack Developer')
@section('description', 'Профессиональная разработка и доработка интернет-магазинов на OpenCart. Кастомные модули, интеграции, оптимизация.')

@section('content')
<section class="py-20">
    <div class="container max-w-4xl">
        <h1 class="text-3xl md:text-4xl font-bold mb-6">Разработка и доработка OpenCart</h1>
        
        <div class="bg-card rounded-3xl p-8">
            <div class="prose prose-invert max-w-none">
                <p class="text-text-secondary text-lg mb-6">
                    Специализируюсь на разработке и доработке интернет-магазинов на платформе OpenCart. 
                    Работаю с проектами любой сложности: от исправления ошибок до создания кастомных модулей и интеграций.
                </p>
                
                <h2 class="text-2xl font-bold mb-4">Что я делаю:</h2>
                <ul class="text-text-secondary space-y-3 mb-8">
                    <li>— Доработка существующих модулей OpenCart</li>
                    <li>— Создание кастомных модулей под задачи бизнеса</li>
                    <li>— Интеграция с CRM, платёжными системами, службами доставки</li>
                    <li>— Оптимизация скорости работы магазина</li>
                    <li>— Исправление ошибок и багов после обновлений</li>
                    <li>— Доработка логики корзины и оформления заказа</li>
                    <li>— Настройка и кастомизация админ-панели</li>
                </ul>
                
                <h2 class="text-2xl font-bold mb-4">Почему именно OpenCart?</h2>
                <p class="text-text-secondary mb-6">
                    OpenCart — одна из самых популярных платформ для интернет-магазинов. Её преимущества: 
                    открытый исходный код, гибкость, большое сообщество разработчиков. Но именно гибкость 
                    требует глубокого понимания архитектуры для качественной доработки.
                </p>
                
                <h2 class="text-2xl font-bold mb-4">Как я работаю:</h2>
                <ol class="text-text-secondary space-y-3 mb-8">
                    <li>1. Анализ задачи и существующего кода</li>
                    <li>2. Оценка сроков и стоимости</li>
                    <li>3. Разработка с промежуточными отчётами</li>
                    <li>4. Тестирование на боевом сервере</li>
                    <li>5. Сдача работы и консультация по использованию</li>
                </ol>
                
                <div class="mt-10 pt-6 border-t border-white/10">
                    <p class="text-text-secondary mb-4">
                        Готов обсудить ваш проект по OpenCart. Расскажите, что нужно сделать — предложу оптимальное решение.
                    </p>
                    <a href="{{ route('home') }}#contacts" 
                       class="inline-block px-6 py-3 bg-accent text-background font-semibold rounded-xl hover:bg-accent/90 transition">
                        Обсудить проект
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection