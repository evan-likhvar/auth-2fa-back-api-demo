<?php

namespace App\Console\Commands;

use components\ModularComponent;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

/**
 * Class CollectionModuleMake
 * @package App\Console\Commands
 *
 * @property Filesystem $files
 * @property ModularComponent $modularComponent
 */
class CollectionModuleMake extends Command
{
    protected $modularComponent;

    protected $files;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module-collection {module} {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create collection file for module';

    /**
     * Create a new command instance.
     *
     * CollectionModuleMake constructor.
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
        $this->createCollection();

        return true;
    }

    private function createCollection()
    {
        try {
            $module = trim($this->argument('module')); //module name
            $collectionModel = Str::singular(class_basename(trim($this->argument('name')))); // Якщо Blogs то Blog
            $collectionModel = ucfirst(Str::camel($collectionModel));// request model name

            $path = $this->getRequestPath($module, $collectionModel);
            $this->makeDirectory($path);

            $stub = $this->files->get(base_path('resources/stubs/collection-resource.stub'));

            $stub = str_replace(
                ['DummyNamespace', 'DummyClass'],
                [
                    "{$this->modularComponent->baseNamespace}\\{$module}\\Http\\Resources",
                    $collectionModel,
                ],
                $stub
            );
            $this->files->put($path, $stub);
            $this->info('Collection created successfully.');
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
     * @param $collectionModel
     * @return string
     */
    private function getRequestPath($module, $collectionModel)
    {
        return $this->laravel['path'] . "/Modules/" . ModularComponent::MODULE_VERSION . "/{$module}/Http/Resources/{$collectionModel}.php";
    }
}
