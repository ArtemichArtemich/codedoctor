<svg class="{{ $class ?? 'w-8 h-8' }}" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
    <!-- Файл с кодом -->
    <rect x="8" y="6" width="16" height="20" rx="2" stroke="currentColor" stroke-width="1.5"/>
    
    <!-- Строки кода -->
    <line x1="12" y1="12" x2="20" y2="12" stroke="currentColor" stroke-width="1.5" stroke-opacity="0.7"/>
    <line x1="12" y1="16" x2="18" y2="16" stroke="currentColor" stroke-width="1.5" stroke-opacity="0.7"/>
    <line x1="12" y1="20" x2="22" y2="20" stroke="currentColor" stroke-width="1.5" stroke-opacity="0.7"/>
    
    <!-- Акцентная рука-перчатка -->
    <path d="M22 24C22 26 20 28 18 28C16 28 14 26 14 24" 
          stroke="var(--color-accent, #F6C945)" 
          stroke-width="2" 
          fill="none"/>
    <path d="M18 24L20 22L22 24L20 26L18 24Z" 
          fill="var(--color-accent, #F6C945)" 
          stroke="none" 
          opacity="0.8"/>
</svg>