<?php

namespace App\Console\Commands;

use components\ModularComponent;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

/**
 * Class SeedModuleMake
 * @package App\Console\Commands
 *
 * @property Filesystem $files
 * @property ModularComponent $modularComponent
 */
class SeedModuleMake extends Command
{
    protected $modularComponent;

    protected $files;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module-seed {module} {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make seed file for module';

    /**
     * Create a new command instance.
     *
     * SeedModuleMake constructor.
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
        $this->createSeed();
        return true;
    }

    private function createSeed()
    {
        try {
            $module = trim($this->argument('module')); //module name
            $seederModel = Str::singular(class_basename(trim($this->argument('name')))); // Якщо Blogs то Blog
            $seederModel = ucfirst(Str::camel($seederModel));// request model name

            $path = $this->getRequestPath($module, $seederModel);

            if ($this->files->exists($path)) {
                $this->error("{$seederModel} is exist in {$path}");

                return false;
            }

            $this->makeDirectory($path);

            $stub = $this->files->get(base_path('resources/stubs/seed.stub'));

            $stub = str_replace(
                ['DummyNamespace', 'DummyClass'],
                [
                    "{$this->modularComponent->baseNamespace}\\{$module}\\Database\\Seeds",
                    $seederModel,
                ],
                $stub
            );
            $this->files->put($path, $stub);
            $this->info('Seed created successfully.');
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
     * @param $seederModel
     * @return string
     */
    private function getRequestPath($module, $seederModel)
    {
        return $this->laravel['path'] . "/Modules/" . ModularComponent::MODULE_VERSION . "/{$module}/Database/Seeds/{$seederModel}.php";
    }
}
