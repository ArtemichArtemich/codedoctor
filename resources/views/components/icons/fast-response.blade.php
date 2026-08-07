<svg class="{{ $class ?? 'w-8 h-8' }}" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
    <!-- Молния в круге -->
    <circle cx="16" cy="16" r="10" stroke="currentColor" stroke-width="1.5" fill="none"/>
    
    <!-- Молния -->
    <path d="M14 10L20 14L16 18L22 22" 
          stroke="var(--color-accent, #F6C945)" 
          stroke-width="2.5" 
          fill="none" 
          stroke-linecap="round" 
          stroke-linejoin="round"/>
    
    <!-- Часы/таймер -->
    <circle cx="16" cy="16" r="7" 
            stroke="var(--color-accent2, #63D1A5)" 
            stroke-width="1" 
            fill="none" 
            stroke-dasharray="2 1"/>
    
    <!-- Стрелка часов -->
    <line x1="16" y1="16" x2="19" y2="13" 
          stroke="var(--color-accent2, #63D1A5)" 
          stroke-width="1.5" 
          stroke-linecap="round"/>
</svg>