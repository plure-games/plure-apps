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
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }
}
