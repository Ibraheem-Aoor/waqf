<?php

namespace App\Providers;

use Filament\Support\Facades\FilamentColor;
use Illuminate\Support\ServiceProvider;
use Filament\Support\Colors\Color;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //log visitors in logs with thier unique  ip
            \Illuminate\Support\Facades\Request::macro('ip', function () {
                return \Illuminate\Support\Facades\Request::server('HTTP_X_FORWARDED_FOR')
                    ?: \Illuminate\Support\Facades\Request::server('REMOTE_ADDR');
            });

            \Illuminate\Support\Facades\Event::listen('kernel.handled', function ($request, $response) {
                \Illuminate\Support\Facades\Log::info('Visited', [
                    'ip' => $request->ip(),
                    'url' => $request->fullUrl(),
                    'method' => $request->method(),
                    'status' => $response->getStatusCode(),
                ]);
            });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
