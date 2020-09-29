<?php

namespace App\Console\Commands\traits;

use Illuminate\Support\Str;

trait ModuleMakeTrait
{
    /**
     * Example - php artisan make:module ModuleName\ModelName --model
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
}
