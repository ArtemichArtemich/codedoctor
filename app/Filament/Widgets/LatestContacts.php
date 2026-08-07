<?php

namespace App\Filament\Widgets;

use App\Models\Contact;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Carbon;

class LatestContacts extends BaseWidget
{
    protected static ?int $sort = 3;
    
    protected int | string | array $columnSpan = 'full';
    
    protected static ?string $heading = 'Последние заявки'; // Меняем заголовок

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Contact::query()
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Имя')
                    ->searchable()
                    ->weight('bold'),
                
                Tables\Columns\TextColumn::make('contact')
                    ->label('Контакт')
                    ->searchable()
                    ->copyable(),
                
                Tables\Columns\TextColumn::make('message')
                    ->label('Сообщение')
                    ->limit(40),
                
                Tables\Columns\IconColumn::make('is_read')
                    ->label('Прочитано')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата')
                    ->formatStateUsing(function ($state) {
                        $date = Carbon::parse($state);
                        
                        if ($date->isToday()) {
                            return 'Сегодня в ' . $date->format('H:i');
                        }
                        
                        if ($date->isYesterday()) {
                            return 'Вчера в ' . $date->format('H:i');
                        }
                        
                        return $date->locale('ru')->isoFormat('D MMMM YYYY, HH:mm');
                    })
                    ->description(function ($record) {
                        return $record->created_at->locale('ru')->diffForHumans();
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Просмотр') // Меняем View на Просмотр
                    ->icon('heroicon-o-eye')
                    ->slideOver()
                    ->modalHeading('Детали заявки')
                    ->modalWidth('lg')
                    ->form([
                        Tables\Columns\TextColumn::make('name')
                            ->label('Имя'),
                        Tables\Columns\TextColumn::make('contact')
                            ->label('Контакт'),
                        Tables\Columns\TextColumn::make('website')
                            ->label('Сайт'),
                        Tables\Columns\TextColumn::make('message')
                            ->label('Сообщение'),
                        Tables\Columns\TextColumn::make('created_at')
                            ->label('Дата создания'),
                    ])
                    ->fillForm(fn (Contact $record): array => [
                        'name' => $record->name,
                        'contact' => $record->contact,
                        'website' => $record->website,
                        'message' => $record->message,
                        'created_at' => $record->created_at->locale('ru')->isoFormat('D MMMM YYYY, HH:mm'),
                    ])
                    ->action(function (Contact $record) {
                        if (!$record->is_read) {
                            $record->update(['is_read' => true]);
                        }
                    }),
            ]);
    }
}