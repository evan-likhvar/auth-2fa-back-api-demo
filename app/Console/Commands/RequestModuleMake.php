<?php

namespace App\Console\Commands;

use components\ModularComponent;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

/**
 * Class RequestModuleMake
 * @package App\Console\Commands
 *
 * @property Filesystem $files
 * @property ModularComponent $modularComponent
 */
class RequestModuleMake extends Command
{
    protected $modularComponent;

    protected $files;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module-request {module} {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make request file for module';

    /**
     * RequestModuleMake constructor.
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
        $this->createRequest();
        return true;
    }

    /**
     * CCreate request model file for needle module
     */
    private function createRequest()
    {
        try {
            $module = trim($this->argument('module')); //module name
            $requestModel = Str::singular(class_basename(trim($this->argument('name')))); // Якщо Blogs то Blog
            $requestModel = ucfirst(Str::camel($requestModel));// request model name

            $path = $this->getRequestPath($module, $requestModel);

            if ($this->files->exists($path)) {
                $this->error("{$requestModel} is exist in {$path}");

                return false;
            }

            $this->makeDirectory($path);

            $stub = $this->files->get(base_path('resources/stubs/request.stub'));

            $stub = str_replace(
                ['DummyNamespace', 'DummyClass'],
                [
                    "{$this->modularComponent->baseNamespace}\\{$module}\\Http\\Requests",
                    $requestModel,
                ],
                $stub
            );
            $this->files->put($path, $stub);
            $this->info('Request created successfully.');
        } catch (\Exception $e) {
            $this->error($e->getMessage());
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
     * Get Request model path
     * @param $module
     * @param $requestModel
     * @return string
     */
    private function getRequestPath($module, $requestModel)
    {
        return $this->laravel['path'] . "/Modules/" . ModularComponent::MODULE_VERSION . "/{$module}/Http/Requests/{$requestModel}.php";
    }
}
