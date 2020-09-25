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
     * @return void
     */
    public function boot(ModularComponent $modularComponent)
    {
//        dd(__DIR__.'/../Modules/v1/test_modules');
//        dd($modularComponent->loadMigrationFromModules());
        $this->loadMigrationsFrom($modularComponent->loadMigrationFromModules());
//        $this->loadMigrationsFrom([
//            __DIR__.'..'.DIRECTORY_SEPARATOR.'Modules'.DIRECTORY_SEPARATOR.'v1'.DIRECTORY_SEPARATOR.'test_modules',
//            database_path().DIRECTORY_SEPARATOR.'migrations',
//        ]);
    }
}
