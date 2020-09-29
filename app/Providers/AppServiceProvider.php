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
//        dd(base_path('app\modules\v1\TestModule\Resources\Views'));
//        dd(resource_path('app\modules'));
//        dd($modularComponent->loadViewsFromModules());
//        \View::getFinder()->addLocation(base_path('app\modules\v1\TestModule\Resources\Views'));  //TODO REGISTERING BLADE TEMPLATES INSIDE MODULE
        $this->loadMigrationsFrom($modularComponent->loadMigrationFromModules()); //register migration from modules
    }
}
