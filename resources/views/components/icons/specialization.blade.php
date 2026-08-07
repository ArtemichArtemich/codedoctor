<svg class="{{ $class ?? 'w-8 h-8' }}" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
    <!-- Концентрические круги -->
    <circle cx="16" cy="16" r="10" stroke="currentColor" stroke-width="1.5" stroke-opacity="0.7"/>
    <circle cx="16" cy="16" r="6" stroke="currentColor" stroke-width="1.5" stroke-opacity="0.7"/>
    
    <!-- Акцентная точка-цель -->
    <circle cx="16" cy="16" r="3" fill="none" stroke="var(--color-accent, #F6C945)" stroke-width="2"/>
    <circle cx="16" cy="16" r="1" fill="var(--color-accent, #F6C945)" stroke="none"/>
    
    <!-- Стрелка-указатель -->
    <path d="M22 10L26 6L30 10L26 14L22 10Z" 
          fill="var(--color-accent2, #63D1A5)" 
          stroke="none" 
          opacity="0.8"/>
</svg>