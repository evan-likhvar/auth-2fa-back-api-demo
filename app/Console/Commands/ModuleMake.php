<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use components\ModularComponent;

/**
 * Class ModuleMake
 * @package App\Console\Commands
 *
 * @property Filesystem $files
 * @property ModularComponent $moduleComponent
 * @property string $moduleName
 * @property string $resourceName
 */
class ModuleMake extends Command
{
    protected $files;

    protected $moduleComponent;

    /** Module name */
    private $moduleName;

    /** Resource file name */
    private $resourceName;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name : module name} {resourceName? : Resource file name}
                                        {--all : All items}
                                        {--model : Only Model}                           
                                        {--migration : Only migrate file}
                                        {--controller : Only Controller}
                                        {--request : Only request}
                                        {--seed : Only Seed}
                                        ';

//{--view : Only view}
//{--repository : Only view}
//{--mail : Only view}//
//{--test : Only view}
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make module';

    /**
     * Create a new command instance.
     *
     * @param Filesystem $files
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
        $this->moduleComponent = new ModularComponent();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->moduleName = trim($this->argument('name'));
        $this->resourceName = $this->setResourceName();

        if (!in_array($this->moduleName, $this->moduleComponent->getModules())) {
            $this->error('You must set your new component name to modular config! Path to config is ' . base_path('config\modular.php'));

            return false;
        }

        if ($this->option('all')) {
            $this->input->setOption('model', true);
            $this->input->setOption('migration', true);
            $this->input->setOption('controller', true);
            $this->input->setOption('request', true);
            $this->input->setOption('seed', true);
        }


        if ($this->option('model')) {
            if (!$this->checkResourceParam()) {
                return false;
            }
            $this->createModel();
        }

        if ($this->option('migration')) {
            if (!$this->checkResourceParam()) {
                return false;
            }
            $this->createMigration();
        }

        if ($this->option('controller')) {
            if (!$this->checkResourceParam()) {
                return false;
            }
            $this->createController();
        }

        if ($this->option('request')) {
            if (!$this->checkResourceParam()) {
                return false;
            }
            $this->createRequest();
        }

        if ($this->option('seed')) {
            if (!$this->checkResourceParam()) {
                return false;
            }
            $this->createSeed();
        }

        $this->files->makeDirectory($this->laravel['path'] . "/Modules/v1/{$this->moduleName}", 0777, true, true);

        return true;
    }

    /**
     * Example - php artisan make:module ModuleName\ModelName --model
     */
    private function createModel()
    {
        try {
            $model = ucfirst(Str::camel($this->resourceName));

            $this->call('make:model', [
                'name' => "App\\Modules\\v1\\{$this->moduleName}\\Models\\{$model}"
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
     * Check on required param for creating resource
     * @return bool
     */
    private function checkResourceParam()
    {
        if (!$this->resourceName) {
            $this->error('Param resourceName is required!');

            return false;
        }

        return true;
    }

    /**
     * Prepare resource name
     * @return string|null
     */
    private function setResourceName()
    {
        $resourceName = $this->argument('resourceName');
        if (!$resourceName) {
            return null;
        }

        $resourceName = Str::singular(class_basename(trim($resourceName))); // Якщо Blogs то Blog
        return ucfirst($resourceName);
    }
}
