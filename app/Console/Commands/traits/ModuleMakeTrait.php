<?php

namespace App\Console\Commands\traits;

use Illuminate\Support\Str;

trait ModuleMakeTrait
{
    /**
     * Example - php artisan make:module ModuleName ResourceName --model
     *
     * Create model for module
     */
    private function createModel()
    {
        try {
            $model = ucfirst(Str::camel($this->resourceName));

            $this->call('make:model', [
                'name' => "{$this->moduleComponent->baseNamespace}\\{$this->moduleName}\\Models\\{$model}"
            ]);

        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    /**
     * Example - php artisan make:module ModuleName ResourceName --migration
     *
     * Create migration file
     * @return int
     */
    private function createMigration()
    {
        try {
            $model = Str::plural(class_basename($this->resourceName)); // Якщо Blog то Blogs

            return $this->call('make:module-migration', [
                'module' => $this->moduleName,
                'migrationName' => "create_{$model}_table",
                'table' => "$model"
            ]);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * Example - php artisan make:module ModuleName ResourceName --controller
     *
     * Create controller resource
     * @return int
     */
    private function createController()
    {
        try {
            return $this->call('make:module-controller', [
                'module' => $this->moduleName,
                'controller' => "{$this->resourceName}Controller",
            ]);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * Example - php artisan make:module ModuleName ResourceName --request
     *
     * Create request file for needle module
     * @return int
     */
    private function createRequest()
    {
        try {
            return $this->call('make:module-request', [
                'module' => $this->moduleName,
                'name' => "{$this->resourceName}Request",
            ]);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * Example - php artisan make:module ModuleName ResourceName --seed
     *
     * Create seed file for needle module
     * @return int
     */
    private function createSeed()
    {
        try {
            return $this->call('make:module-seed', [
                'module' => $this->moduleName,
                'name' => "{$this->resourceName}Seeder",
            ]);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * Example - php artisan make:module ModuleName ResourceName --resource
     *
     * Create collection resource file for needle module
     * @return int
     */
    private function createResource()
    {
        try {
            return $this->call('make:module-collection', [
                'module' => $this->moduleName,
                'name' => "{$this->resourceName}Resource",
            ]);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * Example - php artisan make:module ModuleName ResourceName --mail
     *
     * Create collection resource file for needle module
     * @return int
     */
    private function createMail()
    {
        try {
            return $this->call('make:module-mail', [
                'module' => $this->moduleName,
                'name' => "{$this->resourceName}Mail",
            ]);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * Example - php artisan make:module ModuleName ResourceName --test
     *
     * Create test file for needle module
     * @return int
     */
    private function createTest()
    {
        try {
            return $this->call('make:module-test', [
                'module' => $this->moduleName,
                'name' => "{$this->resourceName}Test",
            ]);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
