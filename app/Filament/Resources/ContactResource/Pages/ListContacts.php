<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContacts extends ListRecords
{
    protected static string $resource = ContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Для контактов обычно не нужна кнопка создания,
            // но если хотите - раскомментируйте:
            // Actions\CreateAction::make(),
        ];
    }
}