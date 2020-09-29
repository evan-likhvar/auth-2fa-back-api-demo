<?php

namespace App\Console\Commands;

use components\ModularComponent;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

/**
 * Class TestModuleMake
 * @package App\Console\Commands
 *
 * @property Filesystem $files
 * @property ModularComponent $modularComponent
 */
class TestModuleMake extends Command
{
    protected $files;

    protected $modularComponent;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module-test {module : Module name} {name : Test name}
                                                                    {--unit : Create unit test}
                                                                                     ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * TestModuleMake constructor.
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
        $module = trim($this->argument('module'));//module name

        if ($this->option('unit')) {
            $this->createUnitTest($module);

            return true;
        }

        $this->createFeatureTest($module);

        return true;
    }

    /**
     * Create unit test file
     * @param $module
     */
    protected function createUnitTest($module)
    {
        try {
            $testName = Str::singular(
                Str::studly(class_basename(trim($this->argument('name'))))
            );//test file name

            $path = $this->getTestPath($module, 'Unit', $testName);

            $this->makeDirectory($path);

            $stub = $this->files->get(base_path('resources/stubs/tests/unit-test.stub'));

            $stub = str_replace(
                ['DummyNamespace', 'DummyClass'],
                [
                    "{$this->modularComponent->baseNamespace}\\{$module}\\Tests\\Unit",
                    $testName,
                ],
                $stub
            );

            $this->files->put($path, $stub);
            $this->info('Unit test created successfully.');
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * Create feature test file
     * @param $module
     */
    protected function createFeatureTest($module)
    {
        try {
            $testName = Str::singular(
                Str::studly(class_basename(trim($this->argument('name'))))
            );//test file name

            $path = $this->getTestPath($module, 'Feature', $testName);

            $this->makeDirectory($path);

            $stub = $this->files->get(base_path('resources/stubs/tests/feature-test.stub'));

            $stub = str_replace(
                ['DummyNamespace', 'DummyClass'],
                [
                    "{$this->modularComponent->baseNamespace}\\{$module}\\Tests\\Feature",
                    $testName,
                ],
                $stub
            );

            $this->files->put($path, $stub);
            $this->info('Feature test created successfully.');
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
     * Get test file path
     * @param string $module
     * @param string $folder
     * @param string $testName
     * @return string
     */
    private function getTestPath(string $module, string $folder, string $testName)
    {
        return $this->laravel['path'] . "/Modules/" . $this->modularComponent::MODULE_VERSION . "/{$module}/Tests/{$folder}/{$testName}.php";
    }
}
