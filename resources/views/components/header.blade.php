<header class="sticky top-0 z-50 bg-white/90 backdrop-blur-sm border-b border-gray-100">
    <nav class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <!-- Логотип и имя -->
            <div class="flex items-center space-x-2">
                <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-white font-bold">
                    А
                </div>
                <div>
                    <div class="font-semibold text-lg">Артём</div>
                    <div class="text-sm text-gray-500">Code Doctor — техническая помощь интернет-магазинам: диагностика, исправление ошибок, доработка OpenCart, интеграции, аналитика и поддержка.</div>
                </div>
            </div>
            
            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('services') }}" class="text-gray-700 hover:text-primary transition">Услуги</a>
                <a href="{{ route('cases') }}" class="text-gray-700 hover:text-primary transition">Кейсы</a>
                <a href="{{ route('prices') }}" class="text-gray-700 hover:text-primary transition">Стоимость</a>
                <a href="{{ route('about') }}" class="text-gray-700 hover:text-primary transition">Обо мне</a>
                
                <!-- Кнопки -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('contacts') }}" 
                       class="px-4 py-2 border border-primary text-primary rounded-lg hover:bg-primary/5 transition">
                        Заказать разработку
                    </a>
                    <a href="{{ route('cases') }}" 
                       class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition">
                        Кейсы
                    </a>
                </div>
            </div>
            
            <!-- Mobile menu button -->
            <button class="md:hidden p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </nav>
</header>