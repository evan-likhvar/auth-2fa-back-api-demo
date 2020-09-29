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
        $modularComponent->registerViews();//register components blade views from modules
        $this->loadMigrationsFrom($modularComponent->loadMigrationFromModules()); //register migration from modules
    }
}
