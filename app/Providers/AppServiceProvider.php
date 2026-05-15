<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        \Illuminate\Support\Facades\Event::listen(
            'system.event',
            [\App\Listeners\SystemEventProcessor::class, 'handle']
        );

        \Illuminate\Support\Facades\Event::listen(
            'system.event.fast_lane',
            [\App\Listeners\SystemEventProcessor::class, 'handle']
        );
    }
}
