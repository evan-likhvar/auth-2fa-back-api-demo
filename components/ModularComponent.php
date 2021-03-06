<?php

namespace components;

use Illuminate\Support\Facades\Route;

/**
 * Class ModularComponent
 *
 * @property array $modules
 * @property string $baseNamespace
 * @property string $path
 *
 * @package components
 */
class ModularComponent
{
    /** Modules version */
    public const MODULE_VERSION = 'v1';
    public const CONTROLLER_NAMESPACE = 'App';

    /** Modules array */
    public $modules;
    /** Base module namespace - app\Modules\v1 */
    public $baseNamespace;
    /** Base modules alias*/
    public $path;

    public function __construct()
    {
        $this->modules = config('modular.modules');
        $this->path = config('modular.path');
        $this->baseNamespace = config('modular.base_namespace');
    }

    /**
     * Register modules routes (web, api)
     *
     * @param string $routeView
     * @return bool
     */
    public function registerRoutes($routeView = 'web')
    {
        if (!$this->modules) {
            return false;
        }
        foreach ($this->modules as $module => $subModules) {
            foreach ($subModules as $key => $subModule) {
                if (is_string($key)) {
                    $subModule = $key;
                }
                $relativePath = '/' . $module . '/' . $subModule;
                $routePath = $this->path . $relativePath . "/Routes/{$routeView}.php";

                if (file_exists($routePath)) {
                    Route::namespace("Modules\\$module\\$subModule\\Http\\Controllers")->group($routePath);
                }
            }
        }

        return true;
    }

    /**
     * Register components blade views
     * @return array
     */
    public function registerViews()
    {
        $paths = [];
        if (!$this->modules) {
            return $paths;
        }

        $modulesCollection = collect($this->modules);
        $activeModules = $modulesCollection->get(self::MODULE_VERSION);
        foreach ($activeModules as $module) {
            \View::getFinder()->addLocation(base_path("App\\Modules\\" . self::MODULE_VERSION . "\\{$module}\\Resources\\Views"));
        }

    }

    /**
     * Return module migration paths
     * @return array
     */
    public function loadMigrationFromModules()
    {
        $paths = [];
        if (!$this->modules) {
            return $paths;
        }
        $modulesCollection = collect($this->modules);
        $activeModules = $modulesCollection->get(self::MODULE_VERSION);

        foreach ($activeModules as $key => $moduleName) {
            $paths[] = $this->path . DIRECTORY_SEPARATOR . self::MODULE_VERSION . DIRECTORY_SEPARATOR . $moduleName . DIRECTORY_SEPARATOR . 'Database' . DIRECTORY_SEPARATOR . 'Migrations';
        }

        return $paths;
    }

    /**
     * Get config modules
     * @return mixed
     */
    public function getModules()
    {
        return $this->modules[self::MODULE_VERSION];
    }
}
