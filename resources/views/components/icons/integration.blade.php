<svg class="{{ $class ?? 'w-6 h-6' }}" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <!-- Соединённые круги -->
    <circle cx="9" cy="12" r="4" stroke="currentColor" stroke-width="1.5" fill="none"/>
    <circle cx="15" cy="12" r="4" stroke="currentColor" stroke-width="1.5" fill="none"/>
    
    <!-- Акцентное соединение -->
    <path d="M13 12L11 12" 
          stroke="var(--color-accent, #F6C945)" 
          stroke-width="2" 
          stroke-linecap="round"/>
    
    <!-- Соединительные точки -->
    <circle cx="9" cy="12" r="1" fill="var(--color-accent2, #63D1A5)" stroke="none"/>
    <circle cx="15" cy="12" r="1" fill="var(--color-accent2, #63D1A5)" stroke="none"/>
</svg>