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
        $this->app->make('PlureGames\PlureApps\Database\Factories\AppFactory')->load(__DIR__ . '/database/factories');
        $this->app->bind('PlureGames\PlureApps\Database\Seeders\AppSeeder');
        $this->app->bind('PlureGames\PlureApps\Database\Seeders\DatabaseSeeder');
    }
}
