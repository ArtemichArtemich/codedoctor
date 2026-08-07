<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationGroup = 'Коммуникация';

    protected static ?string $navigationLabel = 'Заявки';

    protected static ?string $modelLabel = 'Заявка';

    protected static ?string $pluralModelLabel = 'Заявки';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Информация о заявке')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Имя')
                            ->required()
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('contact')
                            ->label('Контакт (телефон/email)')
                            ->required()
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('website')
                            ->label('Сайт')
                            ->url()
                            ->maxLength(255),
                        
                        Forms\Components\Textarea::make('message')
                            ->label('Сообщение')
                            ->rows(4)
                            ->columnSpanFull(),
                        
                        Forms\Components\Toggle::make('is_read')
                            ->label('Прочитано')
                            ->default(false)
                            ->onColor('success')
                            ->offColor('danger'),
                        
                        Forms\Components\TextInput::make('ip_address')
                            ->label('IP адрес')
                            ->maxLength(45)
                            ->disabled(),
                        
                        Forms\Components\TextInput::make('user_agent')
                            ->label('User Agent')
                            ->maxLength(500)
                            ->disabled(),
                        
                        Forms\Components\Toggle::make('privacy_agreed')
                            ->label('Согласие на обработку данных')
                            ->disabled(),
                    ])->columns(2),
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
                
                Tables\Columns\TextColumn::make('name')
                    ->label('Имя')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                
                Tables\Columns\TextColumn::make('contact')
                    ->label('Контакт')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Контакт скопирован'),
                
                Tables\Columns\TextColumn::make('website')
                    ->label('Сайт')
                    ->limit(30)
                    ->formatStateUsing(fn ($state) => $state ? parse_url($state, PHP_URL_HOST) : '-')
                    ->url(fn ($record) => $record->website, true)
                    ->icon('heroicon-o-link'),
                
                Tables\Columns\TextColumn::make('message')
                    ->label('Сообщение')
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->message)
                    ->toggleable(),
                
                Tables\Columns\IconColumn::make('is_read')
                    ->label('Прочитано')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->description(fn ($record) => $record->created_at->diffForHumans()),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('С даты'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('По дату'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
                
                Tables\Filters\TernaryFilter::make('is_read')
                    ->label('Статус')
                    ->placeholder('Все заявки')
                    ->trueLabel('Прочитанные')
                    ->falseLabel('Непрочитанные')
                    ->queries(
                        true: fn (Builder $query) => $query->where('is_read', true),
                        false: fn (Builder $query) => $query->where('is_read', false),
                    ),
            ])
            ->actions([
                Action::make('markAsRead')
                    ->label('Отметить прочитанным')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->action(function (Contact $record) {
                        $record->update(['is_read' => true]);
                        Notification::make()
                            ->title('Заявка отмечена как прочитанная')
                            ->success()
                            ->send();
                    })
                    ->visible(fn (Contact $record): bool => !$record->is_read),
                
                Tables\Actions\ViewAction::make()
                    ->slideOver()
                    ->mutateRecordDataUsing(function (array $data): array {
                        $data['is_read'] = true;
                        return $data;
                    })
                    ->after(function (Contact $record) {
                        if (!$record->is_read) {
                            $record->update(['is_read' => true]);
                        }
                    }),
                
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                BulkAction::make('markAsRead')
                    ->label('Отметить как прочитанные')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(function (Collection $records) {
                        $records->each(fn (Contact $record) => $record->update(['is_read' => true]));
                        Notification::make()
                            ->title('Заявки отмечены как прочитанные')
                            ->success()
                            ->send();
                    }),
                
                Tables\Actions\DeleteBulkAction::make(),
                
                Tables\Actions\BulkAction::make('export')
                    ->label('Экспорт в CSV')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function (Collection $records) {
                        $headers = ['ID', 'Имя', 'Контакт', 'Сайт', 'Сообщение', 'Прочитано', 'Дата'];
                        $callback = function() use ($records, $headers) {
                            $file = fopen('php://output', 'w');
                            fputcsv($file, $headers);
                            
                            foreach ($records as $record) {
                                fputcsv($file, [
                                    $record->id,
                                    $record->name,
                                    $record->contact,
                                    $record->website,
                                    $record->message,
                                    $record->is_read ? 'Да' : 'Нет',
                                    $record->created_at->format('d.m.Y H:i'),
                                ]);
                            }
                            
                            fclose($file);
                        };
                        
                        return response()->stream($callback, 200, [
                            'Content-Type' => 'text/csv',
                            'Content-Disposition' => 'attachment; filename="contacts-' . date('Y-m-d') . '.csv"',
                        ]);
                    }),
            ]);
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
            'index' => Pages\ListContacts::route('/'),
        ];
    }
}