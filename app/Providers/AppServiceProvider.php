<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Filament\Tables\Table;
use Filament\Support\Facades\FilamentView;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Директива @viteImage
        Blade::directive('viteImage', function ($expression) {
            return "<?php echo App\Helpers\ImageHelper::image({$expression}); ?>";
        });
        
        // Директива @vitePicture
        Blade::directive('vitePicture', function ($expression) {
            return "<?php echo App\Helpers\ImageHelper::picture({$expression}); ?>";
        });

        // Используем событие рендеринга Filament
        FilamentView::registerRenderHook(
            'panels::body.start',
            fn (): string => $this->configureFilamentTables()
        );
    }

    protected function configureFilamentTables(): string
    {
        Table::configureUsing(function (Table $table): void {
            $table
                ->extremePaginationLinks()
                ->defaultPaginationPageOption(5)
                ->paginationPageOptions([5, 10, 25, 50])
                ->emptyStateHeading('Записей не найдено')
                ->emptyStateDescription('Попробуйте изменить параметры поиска');
        });

        return '';
    }
}