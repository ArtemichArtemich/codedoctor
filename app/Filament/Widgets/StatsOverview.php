<?php

namespace App\Filament\Widgets;

use App\Models\Contact;
use App\Models\Project;
use App\Models\Page;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $contactsThisMonth = Contact::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        
        $contactsLastMonth = Contact::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();
        
        $trend = $contactsLastMonth > 0 
            ? round((($contactsThisMonth - $contactsLastMonth) / $contactsLastMonth) * 100, 1)
            : 100;

        return [
            Stat::make('Новых заявок за месяц', $contactsThisMonth)
                ->description($trend >= 0 ? "{$trend}% роста" : "{$trend}% снижения")
                ->descriptionIcon($trend >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($trend >= 0 ? 'success' : 'danger')
                ->chart([7, 3, 5, 8, 4, 6, $contactsThisMonth]),
            
            Stat::make('Просмотров сайта', '1,234')
                ->description('за последние 30 дней')
                ->descriptionIcon('heroicon-m-eye')
                ->color('warning')
                ->chart([150, 230, 180, 290, 320, 280, 310]),
            
            Stat::make('Активных кейсов', Project::where('is_active', true)->count())
                ->description('Всего ' . Project::count() . ' проектов')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('success'),
            
            Stat::make('Активных страниц', Page::where('is_active', true)->count())
                ->description('Всего ' . Page::count() . ' страниц')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('info'),
        ];
    }
}