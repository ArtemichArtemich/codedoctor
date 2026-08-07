<svg class="{{ $class ?? 'w-8 h-8' }}" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
    <!-- Две соединенные шестеренки -->
    <circle cx="12" cy="16" r="5" stroke="currentColor" stroke-width="1.5" fill="none"/>
    <circle cx="20" cy="16" r="5" stroke="currentColor" stroke-width="1.5" fill="none"/>
    
    <!-- Зубья шестеренок -->
    <path d="M12 11L12 9M12 23L12 21M7 16L9 16M15 16L17 16" 
          stroke="currentColor" stroke-width="1.5"/>
    <path d="M20 11L20 9M20 23L20 21M25 16L23 16M15 16L17 16" 
          stroke="currentColor" stroke-width="1.5"/>
    
    <!-- Акцентное соединение -->
    <path d="M17 16L19 16" 
          stroke="var(--color-accent, #F6C945)" 
          stroke-width="3" 
          stroke-linecap="round"/>
    
    <!-- Общая ось -->
    <circle cx="16" cy="16" r="1" fill="var(--color-accent2, #63D1A5)" stroke="none"/>
</svg>