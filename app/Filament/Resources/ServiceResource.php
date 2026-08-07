<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ViewAction;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static ?string $navigationGroup = 'Контент';

    protected static ?string $navigationLabel = 'Услуги';

    protected static ?string $modelLabel = 'Услуга';

    protected static ?string $pluralModelLabel = 'Услуги';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Service')
                    ->tabs([
                        Tab::make('Основное')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Section::make('Основная информация')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('title')
                                            ->label('Название')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Str::slug($state))),
                                        
                                        TextInput::make('slug')
                                            ->label('URL-адрес')
                                            ->required()
                                            ->unique(ignoreRecord: true)
                                            ->maxLength(255)
                                            ->helperText('Автоматически генерируется из названия'),
                                        
                                        TextInput::make('h1')
                                            ->label('Заголовок H1')
                                            ->maxLength(255)
                                            ->helperText('Если не заполнено, используется название'),
                                        
                                        TextInput::make('short_description')
                                            ->label('Краткое описание')
                                            ->maxLength(255)
                                            ->columnSpanFull()
                                            ->helperText('Для превью в списке услуг'),
                                        
                                        RichEditor::make('description')
                                            ->label('Описание')
                                            ->toolbarButtons([
                                                'bold', 'italic', 'link', 'bulletList', 'orderedList', 'h2', 'h3'
                                            ])
                                            ->columnSpanFull(),
                                        
                                        RichEditor::make('content')
                                            ->label('Полное содержание')
                                            ->toolbarButtons([
                                                'bold', 'italic', 'link', 'bulletList', 'orderedList', 
                                                'h2', 'h3', 'blockquote', 'codeBlock', 'table'
                                            ])
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                        
                        Tab::make('Медиа')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Section::make('Изображения')
                                    ->schema([
                                        Forms\Components\FileUpload::make('image')
                                            ->label('Основное изображение')
                                            ->image()
                                            ->disk('public')
                                            ->directory('services/main')
                                            ->visibility('public')
                                            ->imageEditor()
                                            ->imageEditorAspectRatios([
                                                '16:9',
                                                '4:3',
                                                '1:1',
                                            ])
                                            ->maxSize(2048)
                                            ->columnSpan(1),
                                        
                                        Forms\Components\FileUpload::make('icon')
                                            ->label('Иконка (SVG)')
                                            ->image()
                                            ->disk('public')
                                            ->directory('services/icons')
                                            ->visibility('public')
                                            ->acceptedFileTypes(['image/svg+xml', 'image/png', 'image/webp'])
                                            ->maxSize(1024)
                                            ->helperText('Желательно SVG или небольшой PNG/WEBP')
                                            ->columnSpan(1),
                                        
                                        Forms\Components\FileUpload::make('images')
                                            ->label('Галерея изображений')
                                            ->multiple()
                                            ->image()
                                            ->disk('public')
                                            ->directory('services/gallery')
                                            ->visibility('public')
                                            ->imageEditor()
                                            ->imageEditorAspectRatios([
                                                '16:9',
                                                '4:3',
                                                '1:1',
                                            ])
                                            ->maxSize(5120)
                                            ->reorderable()
                                            ->columnSpanFull(),
                                    ])->columns(2),
                            ]),
                        
                        Tab::make('Характеристики')
                            ->icon('heroicon-o-list-bullet')
                            ->schema([
                                Section::make('Особенности')
                                    ->schema([
                                        Repeater::make('features')
                                            ->label('Ключевые особенности')
                                            ->schema([
                                                TextInput::make('title')
                                                    ->label('Название')
                                                    ->required(),
                                                Textarea::make('description')
                                                    ->label('Описание')
                                                    ->rows(2),
                                            ])
                                            ->columns(2)
                                            ->collapsible()
                                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null),
                                    ]),
                                
                                Section::make('Цена')
                                    ->schema([
                                        TextInput::make('price_from')
                                            ->label('Цена от')
                                            ->placeholder('от 50 000 ₽')
                                            ->maxLength(255),
                                    ]),
                                
                                Section::make('Технологии')
                                    ->schema([
                                        TagsInput::make('technologies')
                                            ->label('Используемые технологии')
                                            ->placeholder('Новая технология')
                                            ->splitKeys(['Tab', 'Enter'])
                                            ->reorderable()
                                            ->helperText('Например: OpenCart, Laravel, PHP, MySQL'),
                                    ]),
                            ]),
                        
                        Tab::make('Дополнительно')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Section::make('FAQ')
                                    ->schema([
                                        Repeater::make('faq')
                                            ->label('Часто задаваемые вопросы')
                                            ->schema([
                                                TextInput::make('question')
                                                    ->label('Вопрос')
                                                    ->required(),
                                                Textarea::make('answer')
                                                    ->label('Ответ')
                                                    ->rows(3)
                                                    ->required(),
                                            ])
                                            ->columns(1)
                                            ->collapsible()
                                            ->itemLabel(fn (array $state): ?string => $state['question'] ?? null),
                                    ]),
                                
                                Section::make('Связанные кейсы')
                                    ->schema([
                                        TagsInput::make('cases')
                                            ->label('Slug-и связанных кейсов')
                                            ->placeholder('slug кейса')
                                            ->splitKeys(['Tab', 'Enter'])
                                            ->helperText('Введите slug кейсов, которые относятся к этой услуге (например: artoftea, berkano)'),
                                    ]),
                            ]),
                        
                        Tab::make('SEO')
                            ->icon('heroicon-o-globe-alt')
                            ->schema([
                                Section::make('Мета-данные')
                                    ->schema([
                                        TextInput::make('meta_title')
                                            ->label('Meta Title')
                                            ->maxLength(255),
                                        
                                        Textarea::make('meta_description')
                                            ->label('Meta Description')
                                            ->maxLength(255)
                                            ->rows(3),
                                    ]),
                            ]),
                        
                        Tab::make('Настройки')
                            ->icon('heroicon-o-cog-8-tooth')
                            ->schema([
                                Section::make('Публикация')
                                    ->columns(2)
                                    ->schema([
                                        Toggle::make('is_active')
                                            ->label('Активна')
                                            ->default(true)
                                            ->onColor('success')
                                            ->offColor('danger'),
                                        
                                        TextInput::make('sort')
                                            ->label('Сортировка')
                                            ->numeric()
                                            ->default(0)
                                            ->helperText('Чем меньше число, тем выше позиция'),
                                    ]),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                ImageColumn::make('image')
                    ->label('Изо')
                    ->circular()
                    ->defaultImageUrl(url('/images/placeholder.png')),
                
                TextColumn::make('title')
                    ->label('Название')
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                
                ImageColumn::make('images')
                    ->label('Галерея')
                    ->circular()
                    ->stacked()
                    ->limit(2)
                    ->limitedRemainingText(size: 'sm')
                    ->defaultImageUrl(url('/images/placeholder.png')),
                
                TextColumn::make('price_from')
                    ->label('Цена от')
                    ->searchable()
                    ->toggleable(),
                
                ToggleColumn::make('is_active')
                    ->label('Активна')
                    ->sortable(),
                
                TextColumn::make('sort')
                    ->label('Сорт.')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                
                TextColumn::make('created_at')
                    ->label('Создана')
                    ->dateTime('d.m.Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Активность')
                    ->placeholder('Все услуги')
                    ->trueLabel('Активные')
                    ->falseLabel('Неактивные'),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make()
                    ->slideOver(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort', 'asc')
            ->reorderable('sort');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}