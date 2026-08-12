<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Контент';

    protected static ?string $navigationLabel = 'Статьи';

    protected static ?string $modelLabel = 'Статья';

    protected static ?string $pluralModelLabel = 'Статьи';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?int $navigationSort = 30;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Article')
                    ->tabs([

                        /*
                         * -----------------------------------------------------
                         * Основное
                         * -----------------------------------------------------
                         */
                        Tab::make('Основное')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Section::make('Статья')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('title')
                                            ->label('Название статьи')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(
                                                function ($state, callable $set, callable $get) {
                                                    if (!$get('slug')) {
                                                        $set(
                                                            'slug',
                                                            \Illuminate\Support\Str::slug($state)
                                                        );
                                                    }

                                                    if (!$get('h1')) {
                                                        $set('h1', $state);
                                                    }
                                                }
                                            ),

                                        TextInput::make('slug')
                                            ->label('URL-адрес')
                                            ->required()
                                            ->unique(ignoreRecord: true)
                                            ->maxLength(255)
                                            ->helperText(
                                                'Например: kak-nayti-oshibku-500'
                                            ),

                                        TextInput::make('h1')
                                            ->label('H1')
                                            ->maxLength(255)
                                            ->helperText(
                                                'Если не хотите отдельный H1, оставьте название статьи.'
                                            )
                                            ->columnSpanFull(),

                                        Textarea::make('excerpt')
                                            ->label('Краткое описание')
                                            ->rows(4)
                                            ->maxLength(500)
                                            ->columnSpanFull()
                                            ->helperText(
                                                'Показывается в списке статей и превью.'
                                            ),

                                        RichEditor::make('content')
                                            ->label('Содержание статьи')
                                            ->required()
                                            ->toolbarButtons([
                                                'bold',
                                                'italic',
                                                'underline',
                                                'strike',
                                                'link',
                                                'bulletList',
                                                'orderedList',
                                                'h2',
                                                'h3',
                                                'h4',
                                                'blockquote',
                                                'codeBlock',
                                                'table',
                                            ])
                                            ->fileAttachmentsDisk('public')
                                            ->fileAttachmentsDirectory('articles/content')
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        /*
                         * -----------------------------------------------------
                         * Рубрика и теги
                         * -----------------------------------------------------
                         */
                        Tab::make('Рубрика')
                            ->icon('heroicon-o-tag')
                            ->schema([
                                Section::make('Классификация статьи')
                                    ->schema([
                                        Select::make('category')
                                            ->label('Категория')
                                            ->options(Article::categories())
                                            ->searchable()
                                            ->native(false)
                                            ->helperText(
                                                'Позже при необходимости вынесем категории в отдельный раздел админки.'
                                            ),

                                        TagsInput::make('tags')
                                            ->label('Теги')
                                            ->placeholder('Добавить тег')
                                            ->helperText(
                                                'Например: PHP, Python, OpenCart, HTTP, ошибки 500'
                                            ),
                                    ]),
                            ]),

                        /*
                         * -----------------------------------------------------
                         * Медиа
                         * -----------------------------------------------------
                         */
                        Tab::make('Медиа')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Section::make('Обложка')
                                    ->schema([
                                        FileUpload::make('image')
                                            ->label('Изображение статьи')
                                            ->image()
                                            ->disk('public')
                                            ->directory('articles/covers')
                                            ->visibility('public')
                                            ->imageEditor()
                                            ->imageEditorAspectRatios([
                                                '16:9',
                                                '4:3',
                                                '1:1',
                                            ])
                                            ->maxSize(3072)
                                            ->helperText(
                                                'Основная картинка для списка статей и самой статьи.'
                                            ),
                                    ]),
                            ]),

                        /*
                         * -----------------------------------------------------
                         * SEO
                         * -----------------------------------------------------
                         */
                        Tab::make('SEO')
                            ->icon('heroicon-o-magnifying-glass')
                            ->schema([
                                Section::make('Поисковая оптимизация')
                                    ->schema([
                                        TextInput::make('meta_title')
                                            ->label('Meta Title')
                                            ->maxLength(255)
                                            ->helperText(
                                                'Если не заполнено, позже будем использовать название статьи.'
                                            ),

                                        Textarea::make('meta_description')
                                            ->label('Meta Description')
                                            ->rows(4)
                                            ->maxLength(500)
                                            ->helperText(
                                                'Описание страницы для поисковой выдачи.'
                                            ),
                                    ]),
                            ]),

                        /*
                         * -----------------------------------------------------
                         * Публикация
                         * -----------------------------------------------------
                         */
                        Tab::make('Публикация')
                            ->icon('heroicon-o-cog-8-tooth')
                            ->schema([
                                Section::make('Статус')
                                    ->columns(2)
                                    ->schema([
                                        Toggle::make('is_active')
                                            ->label('Опубликована')
                                            ->default(false)
                                            ->onColor('success')
                                            ->offColor('danger')
                                            ->helperText(
                                                'Пока выключено — статья не должна отображаться на сайте.'
                                            ),

                                        DateTimePicker::make('published_at')
                                            ->label('Дата публикации')
                                            ->seconds(false)
                                            ->native(false)
                                            ->helperText(
                                                'Можно указать будущую дату для отложенной публикации.'
                                            ),

                                        TextInput::make('sort')
                                            ->label('Сортировка')
                                            ->numeric()
                                            ->default(0)
                                            ->minValue(0)
                                            ->helperText(
                                                'При необходимости можно использовать для ручного порядка.'
                                            ),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
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
                    ->label('')
                    ->disk('public')
                    ->square()
                    ->size(45),

                TextColumn::make('title')
                    ->label('Название')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                TextColumn::make('category')
                    ->label('Категория')
                    ->formatStateUsing(
                        fn (?string $state): string =>
                            Article::categories()[$state] ?? $state ?? '—'
                    )
                    ->badge()
                    ->sortable(),

                TextColumn::make('slug')
                    ->label('URL')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('URL скопирован')
                    ->toggleable(),

                ToggleColumn::make('is_active')
                    ->label('Опубликована')
                    ->sortable(),

                TextColumn::make('published_at')
                    ->label('Дата публикации')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->placeholder('Не указана'),

                TextColumn::make('updated_at')
                    ->label('Изменена')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Публикация')
                    ->placeholder('Все статьи')
                    ->trueLabel('Опубликованные')
                    ->falseLabel('Черновики'),

                SelectFilter::make('category')
                    ->label('Категория')
                    ->options(Article::categories()),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('published_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}