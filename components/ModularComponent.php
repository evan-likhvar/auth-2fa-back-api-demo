<?php

namespace components;

use Route;

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
     * Register modules routes
     * @return bool
     */
    public function registerRoutes()
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
                $routePath = $this->path . $relativePath . "/Routes/web.php";

                if (file_exists($routePath)) {
                    Route::namespace("Modules\\$module\\$subModule\\Http\\Controllers")->group($routePath);
                }
            }
        }

        return true;
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
        $modules = $modulesCollection->get(self::MODULE_VERSION);

        foreach ($modules as $key => $moduleName) {
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
