<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Cache;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Настройки';

    protected static ?string $navigationLabel = 'Настройки сайта';

    protected static ?string $title = 'Настройки сайта';

    protected static string $view = 'filament.pages.settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'phone' => setting('phone', '+7 (999) 123-45-67'),
            'email' => setting('email', 'info@code-doctor.ru'),
            'telegram' => setting('telegram', '@codedoctor'),
            'github' => setting('github', 'codedoctor'),
            'default_meta_title' => setting('default_meta_title', 'Code Doctor - Веб-разработка на OpenCart'),
            'default_meta_description' => setting('default_meta_description', 'Профессиональная разработка и доработка интернет-магазинов на OpenCart. Fullstack веб-разработчик.'),
            'vk_url' => setting('vk_url', 'https://vk.com/codedoctor'),
            'telegram_url' => setting('telegram_url', 'https://t.me/codedoctor'),
            'github_url' => setting('github_url', 'https://github.com/codedoctor'),
            'logo' => setting('logo'),
            'favicon' => setting('favicon'),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Settings')
                    ->tabs([
                        Tab::make('Контактная информация')
                            ->icon('heroicon-o-phone')
                            ->schema([
                                Section::make('Контактные данные')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('phone')
                                            ->label('Телефон')
                                            ->placeholder('+7 (999) 123-45-67')
                                            ->helperText('В формате: +7 (999) 123-45-67')
                                            ->maxLength(20),
                                        
                                        TextInput::make('email')
                                            ->label('Email')
                                            ->email()
                                            ->placeholder('info@code-doctor.ru')
                                            ->helperText('Укажите контактный email'),
                                        
                                        TextInput::make('telegram')
                                            ->label('Telegram (ник)')
                                            ->placeholder('@codedoctor')
                                            ->prefix('@')
                                            ->helperText('Ваш ник в Telegram (без @ подставится автоматически)'),
                                        
                                        TextInput::make('github')
                                            ->label('GitHub (ник)')
                                            ->placeholder('codedoctor')
                                            ->helperText('Ваш ник на GitHub'),
                                    ]),
                            ]),
                        
                        Tab::make('SEO')
                            ->icon('heroicon-o-magnifying-glass')
                            ->schema([
                                Section::make('Мета-данные по умолчанию')
                                    ->schema([
                                        TextInput::make('default_meta_title')
                                            ->label('Default Meta Title')
                                            ->required()
                                            ->maxLength(255)
                                            ->helperText('Заголовок по умолчанию для страниц, где не указан свой'),
                                        
                                        Textarea::make('default_meta_description')
                                            ->label('Default Meta Description')
                                            ->rows(3)
                                            ->maxLength(500)
                                            ->helperText('Описание по умолчанию для страниц, где не указано свое (рекомендуется 150-160 символов)'),
                                    ]),
                            ]),
                        
                        Tab::make('Социальные сети')
                            ->icon('heroicon-o-share')
                            ->schema([
                                Section::make('Ссылки на соцсети')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('vk_url')
                                            ->label('VK')
                                            ->url()
                                            ->placeholder('https://vk.com/codedoctor')
                                            ->helperText('Полная ссылка на страницу ВКонтакте'),
                                        
                                        TextInput::make('telegram_url')
                                            ->label('Telegram')
                                            ->url()
                                            ->placeholder('https://t.me/codedoctor')
                                            ->helperText('Полная ссылка на Telegram-канал или чат'),
                                        
                                        TextInput::make('github_url')
                                            ->label('GitHub')
                                            ->url()
                                            ->placeholder('https://github.com/codedoctor')
                                            ->helperText('Полная ссылка на GitHub-репозиторий или профиль'),
                                    ]),
                            ]),
                        
                        Tab::make('Логотип и фавикон')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Section::make('Загрузка изображений')
                                    ->columns(2)
                                    ->schema([
                                        FileUpload::make('logo')
                                            ->label('Логотип')
                                            ->image()
                                            ->directory('settings')
                                            ->visibility('public')
                                            ->imageEditor()
                                            ->maxSize(1024)
                                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'])
                                            ->helperText('Рекомендуемый размер: 200x50px. Форматы: JPG, PNG, WEBP, SVG'),
                                        
                                        FileUpload::make('favicon')
                                            ->label('Favicon')
                                            ->image()
                                            ->directory('settings')
                                            ->visibility('public')
                                            ->imageEditor()
                                            ->maxSize(512)
                                            ->acceptedFileTypes(['image/x-icon', 'image/png', 'image/svg+xml'])
                                            ->helperText('Рекомендуемый размер: 32x32px. Форматы: ICO, PNG, SVG'),
                                    ]),
                            ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        
        foreach ($data as $key => $value) {
            \App\Models\Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value ?? '']
            );
        }
        
        Cache::forget('site-settings');
        
        Notification::make()
            ->title('Настройки сохранены')
            ->success()
            ->send();
    }
}