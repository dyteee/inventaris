<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
    public function boot(): void
    {
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');

        // Blade directive for Indonesian Date format: e.g. "1 Feb 2026"
        Blade::directive('indodate', function ($expression) {
            return "<?php echo {$expression} ? \Carbon\Carbon::parse({$expression})->locale('id')->translatedFormat('j M Y') : '-'; ?>";
        });

        // Blade directive for Indonesian Date with time: e.g. "1 Feb 2026 14:30"
        Blade::directive('indodatetime', function ($expression) {
            return "<?php echo {$expression} ? \Carbon\Carbon::parse({$expression})->locale('id')->translatedFormat('j M Y H:i') : '-'; ?>";
        });

        // Blade directive for Indonesian number format: e.g. "1.250"
        Blade::directive('indoint', function ($expression) {
            return "<?php echo number_format((float)({$expression} ?? 0), 0, ',', '.'); ?>";
        });
    }
}
