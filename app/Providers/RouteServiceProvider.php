<?php

namespace App\Providers;

use components\ModularComponent;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';


    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapAuthRoutes();

        $this->mapWebModuleRoutes(); // register web modules routes
        $this->mapApiModuleRoutes(); // register api modules routes
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('rest-api')
            ->middleware(['api','api.responseHeaders'])
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    /**
     * Register api module routes
     *
     * @return void
     */
    protected function mapApiModuleRoutes()
    {
        $modular = new ModularComponent();

        Route::prefix($modular::MODULE_VERSION)
            ->middleware(['api', 'api.responseHeaders'])
            ->namespace($modular::CONTROLLER_NAMESPACE)
            ->group(function () use ($modular) {
                return $modular->registerRoutes('api');
            });
    }

    /**
     * Register web module routes
     *
     * @return void
     */
    protected function mapWebModuleRoutes()
    {
        $modular = new ModularComponent();
        Route::middleware('web')
            ->namespace($modular::CONTROLLER_NAMESPACE)
            ->group(function () use ($modular) {
                return $modular->registerRoutes('web');
            });
    }

    protected function mapAuthRoutes()
    {
        Route::prefix('rest-api')
            ->middleware(['api'])
            ->namespace($this->namespace)
            ->group(base_path('routes/auth.php'));
    }
}
