<?php

namespace App\Console\Commands;

use components\ModularComponent;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

/**
 * Class ControllerModuleMake
 * @package App\Console\Commands
 *
 * @property Filesystem $files
 * @property ModularComponent $modularComponent
 */
class ControllerModuleMake extends Command
{
    protected $files;

    protected $modularComponent;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module-controller {module : Module name} {controller : Controller name} {model? : Controller model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make controller for module';

    /**
     * Create a new command instance.
     *
     * ControllerModuleMake constructor.
     * @param Filesystem $files
     * @param ModularComponent $modularComponent
     */
    public function __construct(Filesystem $files, ModularComponent $modularComponent)
    {
        parent::__construct();
        $this->files = $files;
        $this->modularComponent = $modularComponent;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->argument('model')) {
            $this->createModel();
        }

        $this->createControllerModel();
        return true;
    }

    /**
     * Create resource controller with related model
     */
    private function createControllerModel()
    {
        try {
            $module = trim($this->argument('module'));//module name
            $controller = Str::singular(
                Str::studly(class_basename(trim($this->argument('controller'))))
            );//controller name
            $model = $this->getModel(); //model name

            $path = $this->getControllerPath($module, $controller);

            $this->makeDirectory($path);

            $stub = $this->renderStub($module, $controller, $model);

            $this->files->put($path, $stub);
            $this->info('Controller created  successfully.');
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * Get controller content
     * @param $module
     * @param $controller
     * @param $model
     * @return mixed|string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    private function renderStub($module, $controller, $model)
    {
        if ($model) {// render controller stub with model
            $stub = $this->files->get(base_path('resources/stubs/controllers/resource-controller.model.stub'));

            $stub = str_replace(
                [
                    'DummyNamespace',
                    'DummyRootNamespace',
                    'DummyClass',
                    'DummyFullModelClass',
                    'DummyModelClass',
                    'DummyModelVariable'
                ],
                [
                    "{$this->modularComponent->baseNamespace}\\{$module}\\Http\\Controllers",
                    $this->laravel->getNamespace(),
                    $controller,
                    "{$this->modularComponent->baseNamespace}\\{$module}\\Models\\{$model}",
                    $model,
                    lcfirst($model)
                ],
                $stub
            );
        } else { // render controller stub without related model
            $stub = $this->files->get(base_path('resources/stubs/controllers/resource-controller.stub'));

            $stub = str_replace(
                ['DummyNamespace', 'DummyClass'],
                [
                    "{$this->modularComponent->baseNamespace}\\{$module}\\Http\\Controllers",
                    $controller,
                ],
                $stub
            );
        }

        return $stub;
    }


    /**
     * Create model file
     */
    private function createModel()
    {
        try {
            $module = trim($this->argument('module'));
            $model = $this->getModel();

            $this->call('make:model', [
                'name' => "{$this->modularComponent->baseNamespace}\\{$module}\\Models\\{$model}"
            ]);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    /**
     * @param string $path
     */
    private function makeDirectory(string $path)
    {
        $this->files->makeDirectory(dirname($path), 0777, true, true);
    }

    /**
     * @return string|null
     */
    private function getModel()
    {
        if (!$this->argument('model')) {
            return null;
        }
        $model = Str::singular(class_basename(trim($this->argument('model')))); // Якщо Blogs то Blog
        return ucfirst(Str::camel($model));
    }

    /**
     * Get controller path in current module
     * @param $module
     * @param $controller
     * @return string
     */
    private function getControllerPath($module, $controller)
    {
        return $this->laravel['path'] . "/Modules/" . $this->modularComponent::MODULE_VERSION . "/{$module}/Http/Controllers/{$controller}.php";
    }

}
