<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ContactsChart;
use App\Filament\Widgets\LatestContacts;
use App\Filament\Widgets\StatsOverview;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.pages.dashboard';

    public function getWidgets(): array
    {
        return [
            StatsOverview::class,
            ContactsChart::class,
            LatestContacts::class,
        ];
    }
}