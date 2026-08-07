<svg class="{{ $class ?? 'w-8 h-8' }}" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
    <!-- Портфель -->
    <path d="M10 12H22V24H10V12Z" stroke="currentColor" stroke-width="1.5"/>
    <path d="M14 12V10C14 8.9 14.9 8 16 8C17.1 8 18 8.9 18 10V12" stroke="currentColor" stroke-width="1.5"/>
    
    <!-- Акцентная диаграмма роста -->
    <path d="M22 18L26 14L30 18" 
          stroke="var(--color-accent, #F6C945)" 
          stroke-width="2" 
          fill="none" 
          stroke-linecap="round"/>
    
    <!-- Деньги/график внутри -->
    <path d="M14 16L18 20" stroke="var(--color-accent2, #63D1A5)" stroke-width="1.5"/>
    <circle cx="16" cy="18" r="1.5" fill="var(--color-accent2, #63D1A5)" stroke="none"/>
</svg>