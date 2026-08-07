<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
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
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\Builder;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'Контент';

    protected static ?string $navigationLabel = 'Кейсы';

    protected static ?string $modelLabel = 'Кейс';

    protected static ?string $pluralModelLabel = 'Кейсы';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Project')
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
                                        
                                        TextInput::make('title_short')
                                            ->label('Короткое название')
                                            ->maxLength(255)
                                            ->placeholder('Для карточки кейса'),
                                        
                                        Select::make('category')
                                            ->label('Категория')
                                            ->options([
                                                'ecommerce' => 'Интернет-магазин',
                                                'corporate' => 'Корпоративный сайт',
                                                'landing' => 'Лендинг',
                                                'portal' => 'Портал',
                                                'other' => 'Другое',
                                            ])
                                            ->searchable(),
                                        
                                        Select::make('complexity')
                                            ->label('Сложность')
                                            ->options([
                                                'low' => 'Низкая',
                                                'medium' => 'Средняя',
                                                'high' => 'Высокая',
                                            ]),
                                        
                                        TextInput::make('price')
                                            ->label('Стоимость')
                                            ->placeholder('от 100 000 ₽')
                                            ->maxLength(255),
                                        
                                        TextInput::make('duration')
                                            ->label('Срок')
                                            ->placeholder('3 недели')
                                            ->maxLength(255),
                                        
                                        TextInput::make('client')
                                            ->label('Клиент')
                                            ->maxLength(255),
                                        
                                        TextInput::make('website')
                                            ->label('Сайт')
                                            ->url()
                                            ->maxLength(255)
                                            ->placeholder('https://example.com'),
                                        
                                        TagsInput::make('tags')
                                            ->label('Теги')
                                            ->placeholder('Новый тег')
                                            // ->separator(',')
                                            ->splitKeys(['Tab', 'Enter'])
                                            ->reorderable(),
                                    ]),
                                
                                Section::make('Задача и решение')
                                    ->schema([
                                        Textarea::make('task')
                                            ->label('Задача')
                                            ->required()
                                            ->rows(3)
                                            ->columnSpanFull(),
                                        
                                        RichEditor::make('solution_text')
                                            ->label('Описание решения')
                                            ->toolbarButtons([
                                                'bold',
                                                'italic',
                                                'link',
                                                'bulletList',
                                                'orderedList',
                                                'h2',
                                                'h3',
                                            ])
                                            ->columnSpanFull(),
                                        
                                        Repeater::make('solution_list')
                                            ->label('Пошаговое решение')
                                            ->schema([
                                                TextInput::make('step')->label('Шаг')->required(),
                                                Textarea::make('description')->label('Описание')->rows(2),
                                            ])
                                            ->columns(2)
                                            ->collapsible()
                                            ->itemLabel(fn (array $state): ?string => $state['step'] ?? null),
                                    ]),
                            ]),
                        
                        Tab::make('Технологии и результаты')
                            ->icon('heroicon-o-cog')
                            ->schema([
                                Section::make('Технологии')
                                    ->columns(2)
                                    ->schema([
                                        TagsInput::make('technologies')
                                            ->label('Использованные технологии')
                                            ->placeholder('Новая технология')
                                            // ->separator(',')
                                            ->splitKeys(['Tab', 'Enter'])
                                            ->reorderable()
                                            ->helperText('Например: PHP, Laravel, OpenCart, MySQL'),
                                        
                                        Select::make('has_logo')
                                            ->label('Логотип технологии')
                                            ->options([
                                                1 => 'Есть',
                                                0 => 'Нет',
                                            ])
                                            ->default(0),
                                    ]),
                                
                                Section::make('Результаты')
                                    ->schema([
                                        KeyValue::make('results')
                                            ->label('Ключевые результаты')
                                            ->keyLabel('Показатель')
                                            ->valueLabel('Значение')
                                            ->addButtonLabel('Добавить результат')
                                            ->reorderable(),
                                        
                                        KeyValue::make('details')
                                            ->label('Детали проекта')
                                            ->keyLabel('Характеристика')
                                            ->valueLabel('Значение')
                                            ->addButtonLabel('Добавить деталь')
                                            ->reorderable(),
                                        
                                        Textarea::make('result')
                                            ->label('Итог')
                                            ->rows(3)
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                        
                        Tab::make('Медиа')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Section::make('Изображения')
                                    ->schema([
                                        Forms\Components\FileUpload::make('logo')
                                            ->label('Логотип')
                                            ->image()
                                            ->disk('public')
                                            ->directory('projects/logos')
                                            ->visibility('public')
                                            ->imageEditor()
                                            ->imageEditorAspectRatios([
                                                '1:1',
                                                '16:9',
                                                null,
                                            ])
                                            ->maxSize(2048)
                                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'])
                                            ->columnSpan(1),
                                        
                                        Forms\Components\ColorPicker::make('logo_color')
                                            ->label('Цвет логотипа (для фона)')
                                            ->default('#10b981'),
                                        
                                        Forms\Components\FileUpload::make('images')
                                            ->label('Изображения проекта')
                                            ->multiple()
                                            ->image()
                                            ->disk('public')
                                            ->directory('projects/images')
                                            ->visibility('public')
                                            ->imageEditor()
                                            ->imageEditorAspectRatios([
                                                '16:9',
                                                '4:3',
                                                '1:1',
                                            ])
                                            ->maxSize(5120)
                                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                            ->reorderable()
                                            ->columnSpanFull(),
                                    ])->columns(2),
                            ]),
                        
                        Tab::make('Настройки')
                            ->icon('heroicon-o-cog-8-tooth')
                            ->schema([
                                Section::make('Публикация')
                                    ->columns(2)
                                    ->schema([
                                        Toggle::make('is_active')
                                            ->label('Активен')
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
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('title')
                    ->label('Название')
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                
                Tables\Columns\ImageColumn::make('logo')
                    ->label('Лого')
                    ->circular()
                    ->defaultImageUrl(url('/images/placeholder.png')),

                Tables\Columns\ImageColumn::make('images')
                    ->label('Изображения')
                    ->circular()
                    ->stacked()
                    ->limit(3)
                    ->limitedRemainingText(size: 'sm')
                    ->defaultImageUrl(url('/images/placeholder.png')),
                
                Tables\Columns\TextColumn::make('category')
                    ->label('Категория')
                    ->badge()
                    ->color('success')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'ecommerce' => 'Интернет-магазин',
                        'corporate' => 'Корпоративный',
                        'landing' => 'Лендинг',
                        'portal' => 'Портал',
                        default => $state,
                    }),
                
                Tables\Columns\TextColumn::make('client')
                    ->label('Клиент')
                    ->searchable()
                    ->toggleable(),
                
                ToggleColumn::make('is_active')
                    ->label('Активен')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('sort')
                    ->label('Сорт.')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создан')
                    ->dateTime('d.m.Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Обновлен')
                    ->dateTime('d.m.Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Категория')
                    ->options([
                        'ecommerce' => 'Интернет-магазин',
                        'corporate' => 'Корпоративный сайт',
                        'landing' => 'Лендинг',
                        'portal' => 'Портал',
                        'other' => 'Другое',
                    ]),
                
                SelectFilter::make('complexity')
                    ->label('Сложность')
                    ->options([
                        'low' => 'Низкая',
                        'medium' => 'Средняя',
                        'high' => 'Высокая',
                    ]),
                
                TernaryFilter::make('is_active')
                    ->label('Активность')
                    ->placeholder('Все записи')
                    ->trueLabel('Активные')
                    ->falseLabel('Неактивные'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->slideOver(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort', 'asc')
            ->reorderable('sort');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }

    // Добавь в конец класса ProjectResource
    protected function mutateFormDataBeforeSave(array $data): array
    {
        \Log::info('Tags before save:', [
            'original' => $data['tags'] ?? null,
            'type' => gettype($data['tags'] ?? null)
        ]);
        return $data;
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        \Log::info('Fill data:', [
            'images' => $data['images'] ?? null,
            'raw' => json_encode($data['images'] ?? null)
        ]);
        return $data;
    }
}