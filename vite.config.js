import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/filament/admin/theme.css', // тема Filament
                'resources/js/app.js',       // Основной для всех страниц
                'resources/js/deferred.js'   // Отложенная загрузка
            ],
            refresh: true,
        }),
    ],
    build: {
        minify: 'terser',
        terserOptions: {
            compress: {
                drop_console: true,
            }
        },
        rollupOptions: {
            output: {
                assetFileNames: (assetInfo) => {
                    const ext = assetInfo.name.split('.').pop();
                    const name = assetInfo.name.split('.')[0];
                    const dir = assetInfo.name.split('/').slice(0, -1).join('/');
                    
                    // Для изображений сохраняем структуру папок
                    if (['png', 'jpg', 'jpeg', 'gif'].includes(ext)) {
                        if (dir) {
                            return `assets/images/${dir}/${name}-[hash][extname]`;
                        }
                        return `assets/images/${name}-[hash][extname]`;
                    }
                    
                    if (['woff2', 'woff', 'ttf'].includes(ext)) {
                        return `assets/fonts/[name]-[hash][extname]`;
                    }
                    
                    return `assets/[name]-[hash][extname]`;
                }
            }
        }
    },
});