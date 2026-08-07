/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        // Добавляем пути для Filament
        "./vendor/filament/**/*.blade.php",
    ],
    
    safelist: [
        // Ваши существующие классы
        'bg-accent',
        'text-background',
        'hidden',
        'opacity-0',
        'opacity-100',
        'translate-y-2',
        'translate-y-0',
        // Добавляем классы для Filament
        'bg-primary-500',
        'bg-success-500',
        'bg-danger-500',
        'bg-warning-500',
        'bg-info-500',
        'text-white',
        'dark:text-white',
        'border-primary-500',
        'border-success-500',
        'border-danger-500',
        'border-warning-500',
        'border-info-500',
    ],
    
    theme: {
        extend: {
            colors: {
                background: '#0F1714',
                card: '#1B2B25',
                accent: '#F6C945',
                accent2: '#63D1A5',
                'text-primary': '#FFFFFF',
                'text-secondary': 'rgba(255,255,255,0.75)',
                'text-tertiary': 'rgba(255,255,255,0.35)',
                // Добавляем цвета Filament с вашим акцентом
                primary: {
                    50: '#f0fdf4',
                    100: '#dcfce7',
                    200: '#bbf7d0',
                    300: '#86efac',
                    400: '#4ade80',
                    500: '#10b981',
                    600: '#059669',
                    700: '#047857',
                    800: '#065f46',
                    900: '#064e3b',
                },
            },
            fontFamily: {
                sans: ['Inter', 'system-ui', 'sans-serif'],
            },
            container: {
                center: true,
                padding: '1rem',
                screens: {
                    '2xl': '1200px',
                },
            },
        },
    },
    
    plugins: [],
    
    corePlugins: {
        preflight: true,
        float: false,
        clear: false,
        skew: false,
        caretColor: false,
        fontVariantNumeric: false,
    },
}