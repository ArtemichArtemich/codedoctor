<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Vite;

class Picture extends Component
{
    /**
     * Создание компонента изображения
     */
    public function __construct(
        public string $src,          // Путь: 'hero/photo.jpg'
        public string $alt = '',
        public string $class = '',
        public string $style = '',
        public array $sizes = [400, 800, 1200], // Ширины для srcset
        public ?int $width = null,   // Явная ширина
        public ?int $height = null,  // Явная высота
        public bool $lazy = true,    // Ленивая загрузка
        public bool $webp = true,    // Генерировать WebP
    ) {}

    public function render()
    {
        return view('components.picture');
    }
    
    /**
     * Генерирует srcset для указанного формата
     */
    public function srcset(string $format = null): string
    {
        $srcset = [];
        
        foreach ($this->sizes as $size) {
            $path = "resources/images/{$this->src}";
            $query = [];
            
            if ($size) {
                $query['w'] = $size;
            }
            
            if ($format === 'webp') {
                $query['format'] = 'webp';
                $query['quality'] = '80';
            }
            
            if (!empty($query)) {
                $path .= '?' . http_build_query($query);
            }
            
            try {
                $url = Vite::asset($path);
                $srcset[] = "{$url} {$size}w";
            } catch (\Exception $e) {
                // Fallback для дев-режима
                $srcset[] = asset("storage/images/{$this->src}") . " {$size}w";
            }
        }
        
        return implode(', ', $srcset);
    }
}