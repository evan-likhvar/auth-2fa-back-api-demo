<?php

namespace App\Providers;

use components\ModularComponent;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @param ModularComponent $modularComponent
     * @return void
     */
    public function boot(ModularComponent $modularComponent)
    {
        $this->loadMigrationsFrom($modularComponent->loadMigrationFromModules());
    }
}
