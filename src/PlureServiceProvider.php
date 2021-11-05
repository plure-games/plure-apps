<?php

namespace PlureGames\PlureApps;

use Illuminate\Support\ServiceProvider;

class PlureServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->app->make('PlureGames\PlureApps\Controllers\PlureBaseController');
        $this->app->bind('PlureGames\PlureApps\Traits\ExceptionsTrait');
        $this->app->bind('PlureGames\PlureApps\Models\App');
    }
}
