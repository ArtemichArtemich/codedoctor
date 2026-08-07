<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RedirectResource\Pages;
use App\Models\Redirect;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class RedirectResource extends Resource
{
    protected static ?string $model = Redirect::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrows-right-left';

    protected static ?string $navigationGroup = 'Настройки';

    protected static ?string $navigationLabel = 'Редиректы';

    protected static ?string $modelLabel = 'Редирект';

    protected static ?string $pluralModelLabel = 'Редиректы';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Настройки редиректа')
                    ->columns(2)
                    ->schema([
                        TextInput::make('from_url')
                            ->label('Откуда')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->placeholder('/old-page')
                            ->helperText('Начинайте с /, например: /old-page или /category/old'),
                        
                        TextInput::make('to_url')
                            ->label('Куда')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('/new-page')
                            ->helperText('Абсолютный или относительный URL'),
                        
                        Select::make('status_code')
                            ->label('Тип редиректа')
                            ->required()
                            ->options([
                                301 => '301 - Постоянный',
                                302 => '302 - Временный',
                            ])
                            ->default(301)
                            ->helperText('301 - страница перемещена навсегда, 302 - временно'),
                        
                        Toggle::make('is_active')
                            ->label('Активен')
                            ->default(true)
                            ->onColor('success')
                            ->offColor('danger'),
                        
                        TextInput::make('hits')
                            ->label('Количество срабатываний')
                            ->numeric()
                            ->default(0)
                            ->disabled()
                            ->dehydrated(false)
                            ->helperText('Обновляется автоматически'),
                    ]),
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
                
                TextColumn::make('from_url')
                    ->label('Откуда')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('URL скопирован')
                    ->weight('bold'),
                
                TextColumn::make('to_url')
                    ->label('Куда')
                    ->searchable()
                    ->copyable()
                    ->color('success'),
                
                TextColumn::make('status_code')
                    ->label('Код')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        '301' => 'success',
                        '302' => 'warning',
                        default => 'gray',
                    }),
                
                ToggleColumn::make('is_active')
                    ->label('Активен')
                    ->sortable(),
                
                TextColumn::make('hits')
                    ->label('Срабатываний')
                    ->numeric()
                    ->sortable()
                    ->color('info')
                    ->toggleable(),
                
                TextColumn::make('updated_at')
                    ->label('Изменен')
                    ->dateTime('d.m.Y')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status_code')
                    ->label('Тип редиректа')
                    ->options([
                        301 => '301 - Постоянный',
                        302 => '302 - Временный',
                    ]),
                
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Активность')
                    ->placeholder('Все редиректы')
                    ->trueLabel('Активные')
                    ->falseLabel('Неактивные'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('from_url', 'asc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRedirects::route('/'),
            'create' => Pages\CreateRedirect::route('/create'),
            'edit' => Pages\EditRedirect::route('/{record}/edit'),
        ];
    }
}