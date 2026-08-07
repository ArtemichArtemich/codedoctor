<svg class="{{ $class ?? 'w-8 h-8' }}" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
    <!-- График/диаграмма -->
    <rect x="10" y="12" width="4" height="10" stroke="currentColor" stroke-width="1.5" fill="none"/>
    <rect x="16" y="8" width="4" height="14" stroke="currentColor" stroke-width="1.5" fill="none"/>
    <rect x="22" y="6" width="4" height="16" stroke="currentColor" stroke-width="1.5" fill="none"/>
    
    <!-- Акцентная стрелка "вверх" -->
    <path d="M8 24L12 20L16 24" 
          stroke="var(--color-accent, #F6C945)" 
          stroke-width="2" 
          fill="none" 
          stroke-linecap="round"/>
    
    <!-- Прозрачное окно -->
    <rect x="6" y="6" width="20" height="20" rx="1" 
          stroke="var(--color-accent2, #63D1A5)" 
          stroke-width="1" 
          stroke-dasharray="2 2" 
          fill="none" 
          opacity="0.6"/>
</svg>