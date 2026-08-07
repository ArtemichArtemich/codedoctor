<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'slug' => 'services',
                'title' => 'Услуги',
                'h1' => 'Мои услуги',
                'content' => 'Содержание страницы услуг...',
                'meta_title' => 'Услуги Fullstack-разработчика | Артём',
                'meta_description' => 'Профессиональные услуги по разработке и доработке сайтов на OpenCart и других CMS',
            ],
            [
                'slug' => 'prices',
                'title' => 'Цены',
                'h1' => 'Стоимость разработки',
                'content' => 'Содержание страницы цен...',
                'meta_title' => 'Цены на разработку сайтов | Артём',
                'meta_description' => 'Актуальные цены на разработку и доработку сайтов. Прозрачное ценообразование.',
            ],
            [
                'slug' => 'about',
                'title' => 'Обо мне',
                'h1' => 'Обо мне',
                'content' => 'Содержание страницы обо мне...',
                'meta_title' => 'Обо мне | Fullstack-разработчик Артём',
                'meta_description' => 'Информация обо мне, моем опыте и подходах к разработке.',
            ],
            [
                'slug' => 'contacts',
                'title' => 'Контакты',
                'h1' => 'Контакты',
                'content' => 'Содержание страницы контактов...',
                'meta_title' => 'Контакты | Артём Fullstack-разработчик',
                'meta_description' => 'Свяжитесь со мной для обсуждения вашего проекта.',
            ],
        ];

        foreach ($pages as $page) {
            // Обновляем или создаем запись
            Page::updateOrCreate(
                ['slug' => $page['slug']],
                $page
            );
        }
        
        $this->command->info('Страницы успешно добавлены/обновлены!');
    }
}