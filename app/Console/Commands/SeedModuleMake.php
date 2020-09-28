<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Str;

/**
 * Class SeedModuleMake
 * @package App\Console\Commands
 *
 * @property Filesystem $files
 */
class SeedModuleMake extends Command
{
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
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
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
            $requestModel = Str::singular(class_basename(trim($this->argument('name')))); // Якщо Blogs то Blog
            $requestModel = ucfirst(Str::camel($requestModel));// request model name

            $path = $this->getRequestPath($module, $requestModel);
            $this->makeDirectory($path);

            $stub = $this->files->get(base_path('resources/stubs/seed.stub'));

            $stub = str_replace(
                ['DummyNamespace', 'DummyClass'],
                [
                    "App\\Modules\\v1\\{$module}\\Database\\Seeds",
                    $requestModel,
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
     * @param $requestModel
     * @return string
     */
    private function getRequestPath($module, $requestModel)
    {
        return $this->laravel['path'] . "/Modules/v1/{$module}/Database/Seeds/{$requestModel}.php";
    }
}
